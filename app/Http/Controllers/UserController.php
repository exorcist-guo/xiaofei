<?php

namespace App\Http\Controllers;

use App\Auth\JwtUserProvider;
use App\Exceptions\BizException;
use App\LoginLog;
use App\Member;
use App\PushOrder;
use App\Services\VerifyService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use think\api\Client;

class UserController extends Controller
{
    use ApiResponseTrait;

    public function promotion(){

    }

    public function getConfig()
    {
        $data = [
            'nation' => Member::getNations(),
            'lang' => Member::getLangList()
        ];
        return $this->success('success', $data);
    }
    public function team(Request $request){
        $user = \Auth::user();
        $count = Member::wherePid($user->id)->count();
        $page = $request->input('page', 1);
        $limit = 15;

        $list = Member::wherePid($user->id)->orderByDesc('id') ->forPage($page, $limit)
            ->get()
            ->map(function(Member $user){
                $data =  $user->only(['id','pv','number','created_at']);
                $data['created_at'] = date('Y-m-d H:i', $user->created_at->timestamp);
                return $data;
            })
        ;
        $data = [
            'count' => $count,
            'list' => $list
        ];
        return $this->success('success', $data);

    }

    public function info(Request $request){
        $user = \Auth::user();
        $data = \Arr::only($user->toArray(), ['id', 'shop_level','level','mobile','number','integral','all_integral','pv','dikouquan','dikouquan_k','is_set_transaction_password']);
        $data['mobile'] = substr_replace($data['mobile'], '****', 3, 4);
//        $data['is_real'] = $user->real_name?1:0;
//        $data['is_mobile'] = $user->mobile?1:0;
        $data['is_real'] = 1;
        $data['is_mobile'] = 1;
        if($user->is_disabled > 0){
            if($user->is_disabled == 1){
                return $this->error('账号已冻结');
            }
            return $this->error('账号错误');
        }
        return $this->success('操作成功', $data);
    }

    public function bindMobile(Request $request){
        $rules = [
            'mobile' => [
                'required',
                'not_exists:members,mobile'
            ],

//            'verify' => [
//                'required',
//                sprintf("verify_code:%s,register", $request->input('mobile'))
//            ],

        ];
        $messages = [
            'required' => '请完善信息',
            'mobile.not_exists' => '手机已注册',
            'verify_code' => '验证码错误',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);


        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        try {
            $user = \Auth::user();
            if($user->mobile){
                throw new BizException('该账号已有手机号');
            }
            $mobile = $request->input('mobile');
            $user->mobile = $mobile;
            $user->save();
            return $this->success('绑定成功');
        } catch (BizException $bizException) {
            \DB::rollBack();
            return $this->error($bizException->getMessage());
        }
    }

    public function realName(Request $request){
        try{

            $rules = [
                'name' => [
                    'required'
                ],
                'id_number' => [
                    'required'
                ],
            ];

            $messages = [
                'required' => '请完善信息',
            ];


            $validator = \Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return $this->error($validator->errors()->first());
            }
            $user = \Auth::user();
            $redis_key = 'lock_real_name'.$user->id;
            if(!Redis::set($redis_key, 1, 'ex',30, 'nx')) {
                return $this->error('请求太频繁');
            }

            if($user->real_name){
                Redis::expire($redis_key,3);
                return $this->error('已经认证过');
            }
            $id_number = $request->input('id_number');
            if(!Member::isIdCard($id_number)){
                throw new BizException('身份证号有误');
            }

            $client = new Client("c5a3e886-63b2-484a-993f-f0a5d15f6cac");
            $user->real_name = $request->input('name');
            $user->id_number = $id_number;
            $key_limit = 'real_name_limit';
            if (Redis::get($key_limit) >= 5) {
                throw new BizException('2小时内失败次数过多操作被拒绝');
            }
            $result = $client->telecomQuery()
                ->withIdcard($user->id_number)
                ->withRealname($user->real_name)
                ->withMobile($user->mobile)
                ->withProvince(1)
                ->request();
            Redis::incrby($key_limit, 1);
            Redis::expire($key_limit, 2 * 60 * 60);
            if(isset($result['data']['res']) && $result['data']['res'] != 1){
                throw new BizException('信息不匹配');
            }

            $user->save();
//            PushOrder::pushMember($user);

            Redis::expire($redis_key,3);
            return $this->success('认证成功', []);
        }catch (BizException $e){
            Redis::expire($redis_key,3);
            return $this->error($e->getMessage());
        }

    }

    public function passwordLogin(Request $request)
    {
        try {
            $rules = [
                'mobile' => [
                    'required'
                ],
                'password' => [
                    'required'
                ],
            ];
            $messages = [
                'required' => __('messages.required'),
            ];

            $mobile = $request->input('mobile');
            $key = "user_login:fail:" . $mobile;


            if (Redis::get($key) >= 5) {
                //登录失败次数超过5次
//                throw new BizException(__('messages.sbjj'));
            }

            $validator = \Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return $this->error($validator->errors()->first());
            }
            $user = Member::where('mobile',$mobile)
//                ->orWhere('number',$mobile)
                ->orWhere('id_number',$mobile)->first();
            if (!$user || $user->is_disabled > 8) {
                throw new BizException(__('messages.user_not_found').'1');
            }

            if($user->is_disabled) {
                throw new BizException(__('messages.fenghao'));
            }

            if (!$user->verifyPassword($request->input('password'))) {
                $current = Redis::incrby($key, 1);
                Redis::expire($key, 2 * 60 * 60); //
                throw new BizException(__('messages.user_not_found').'2');
            }
            $ip = VerifyService::getClientIp();

            $token = JwtUserProvider::getToken($user->id);
            $user->last_login = date('Y-m-d H:i:s');
            $user->last_ip = $ip;
            $user->save();
//            Member::setSuffix($user->id,1)->where('id',$user->id)->update(['last_login'=>$user->last_login]);
            $is_real = $user->real_name ? 1:0;
            $is_mobile = $user->mobile ? 1:0;
            $log = new LoginLog();
            $log->member_id = $user->id;
            $log->ip = $ip;
            $log->save();

            return $this->success('success', compact('token','is_real','is_mobile'));
        } catch (BizException $e) {
            return $this->error($e->getMessage());
        }
    }


    public function forgetPassword(Request  $request){
        $rules = [
            'mobile' => 'required|exists:members,mobile',
            'verify' => [
                'required',
                sprintf("verify_code:%s,password", $request->input('mobile'))
            ],
            'password' => 'required|between:6,12',
        ];

        $messages = [
            'required' => __('messages.required'),
            'exists' => __('messages.user_not_exist'),
            'verify.verify_code' => __('messages.code_error'),
            'password.between' => '密码长度必须为6~12位',
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        try {
            \DB::beginTransaction();
            $password = $request->input('password');
            $user = Member::findByMobile($request->input('mobile'));



            $success = $user->setPassword($password);

            if ($success) {
                \DB::commit();
                return $this->success('密码修改成功');
            } else {
                \DB::rollBack();
            }
        } catch (BizException $bizException) {
            \DB::rollBack();
            return $this->error($bizException->getMessage());
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error($e);
            return $this->error($e->getMessage());
        }

        return $this->error('操作失败');
    }


    //注册
    public function register(Request $request)
    {
        $rules = [
            'mobile' => [
                'required',
                'not_exists:members,mobile'
            ],
            'invite_mobile' => [
                'required',
            ],
//            'verify' => [
//                'required',
//                sprintf("verify_code:%s,register", $request->input('mobile'))
//            ],
//            'certificate_type' => [
//                'required',
//            ],
            'nation' => [
                'required',
            ],
//            'mobile_nation' => [
//                'required',
//            ],
//            'lang' => [
//                'required',
//            ],
            'name' => [
                'required',
            ],
//            'id_number' => [
//                'required',
//            ],

            'password' => [
                'required',
                'between:6,12'
            ],
        ];
        $messages = [
            'required' => '请完善信息',
            'required.nation' => '国家不能为空',
            'required.lang' => '语言不能为空',
            'mobile.not_exists' => '账号已注册',
            'invite_mobile.exists' => '邀请人不存在',
            'verify_code' => '验证码错误',
            'password.between' => '密码长度必须为6到12个字符',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);


        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        try {
            \DB::beginTransaction();
            $mobile = $request->input('mobile');
            $password = $request->input('password');
            $inviteCode = $request->input('invite_mobile');

//            $certificate_type = $request->input('certificate_type');
            $nation = $request->input('nation');
//            $mobile_nation = $request->input('mobile_nation');
            $lang = $request->input('lang');
            $name = $request->input('name');
//            $id_number = $request->input('id_number');



            /** @var Member $parent */
            $inviteCode = strtolower($inviteCode);
            $parent = Member::where('mobile',$inviteCode)
                ->orWhere('number',$inviteCode)
                ->first();
            if(empty($parent)){
                throw new BizException('邀请人不存在');
            }

            $pid = $parent->id;
            $pid_shop_member_id = $parent->pid_shop_member_id;

            $data = [
                'mobile' => $mobile,
                'level' => 0,
                'shop_level' => 0,
                'password' => \Hash::make($password),
                'pid' => $pid,
                'pid_shop_member_id' => $pid_shop_member_id,
                'number' => Member::getTradeNo(),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),

//                'certificate_type' => $certificate_type,
                'nation' => $nation,
//                'mobile_nation' => $mobile_nation,
                'lang' => $lang,
                'name' => $name,
//                'id_number' => $id_number,
                'deep' => $parent->deep + 1,
                'path' => $parent->path . '/' . $pid.'/',
            ];
            $id = DB::table('members')->insertGetId($data);
            if (!$id) {
                throw new BizException('保存用户信息失败');
            }
           /*
            $suffix =  $id%Member::SUBNUM;
            $data['id'] = $id;
            $id = DB::table('members_'.$suffix)->insertGetId($data);
            if (!$id) {
                throw new BizException('保存用户信息失败');
            }
           */

            \DB::commit();
            return $this->success('注册成功');
        } catch (BizException $bizException) {
            \DB::rollBack();
            return $this->error($bizException->getMessage());
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::channel('user')->error('注册失败，请联系管理员', [$e->getMessage(), $mobile]);
            return $this->error('注册失败，请联系管理员');
        }
    }

    public function sendVerify(Request $request)
    {
        try {

            if (\Auth::user() && \Auth::user()->getKey()) {
                /** @var Member $Member */
                $Member = $request->user();
                $sendTo = $Member->mobile;
                if (!$sendTo) {
                    throw new BizException('手机号码或邮箱为必填');
                }

            }


            $type = $request->input('type', 'verifyCode');
            if($type == 'bind'){
                $sendTo = $request->input('mobile');
                $user = Member::findByMobile($sendTo);
                if($user){
                    throw new BizException('该手机号已注册账号');
                }
            }


            $check = app('captcha')->check_api($request->input('captcha'),$request->input('key'),'math');
            if(!$check){
                throw new BizException('图形验证码错误');
            }

            if (!$type) {
                throw new BizException('参数缺失');
            }

            $code = random_int(100000, 999999);

            if (!VerifyService::send($sendTo, $code, $type)) {
                throw new BizException('发送失败');
            }

            return $this->success('验证码发送成功');
        } catch (BizException $bizException) {
            return $this->error($bizException->getMessage());
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->error($e->getMessage());
        }
    }


    public function sendVerifyGuest(Request $request)
    {
        $rules = [
            'mobile' => 'required',
            'key' => 'required',
            'captcha' => 'required',
        ];
        $messages = [
            'required' => '请完善信息',
            'captcha_api' => '图形验证码错误',
        ];

        $check = app('captcha')->check_api($request->input('captcha'),$request->input('key'),'math');
        if(!$check){
            throw new BizException('图形验证码错误');
        }
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        try {
            $sendTo = $request->input('mobile');

            if (!$sendTo) {
                throw new BizException('手机号码为必填');
            }

            $type = $request->input('type', 'verifyCode');

            if (!$type) {
                throw new BizException('参数缺失');
            }

            if (!in_array($type, ['register', 'password'])) {
                throw new BizException('非法参数');
            }

            $code = random_int(100000, 999999);
//            $code = 888888;
                        $key = sprintf("%s_%s", $type , $sendTo);

                        $success = Redis::set($key, $code, 'ex', 180);

            if (!VerifyService::send($sendTo, $code, $type)) {
                throw new BizException('发送失败');
            }

            return $this->success('验证码发送成功');
        } catch (BizException $bizException) {
            return $this->error($bizException->getMessage());
        } catch (\Exception $e) {
            \Log::error($e);
            return $this->error($e->getMessage());
        }
    }

    /**
     * 设置交易密码
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function setTradePassword(Request $request)
    {
        /** @var Member $user */
        $user = $request->user();
        $rules = [
            'password' => 'required|between:6,6',
        ];

        if($user->is_set_transaction_password == 1) {
            $rules['verify'] =  [
                'required',
                sprintf("verify_code:%s,trade_password", $user->mobile)
            ];
        }

        $messages = [
            'required' => '请完善信息',
            'verify.verify_code' => '验证码错误',
            'password.between' => '密码长度必须为6',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        try {
            \DB::beginTransaction();
            $password = $request->input('password');

            $success = $user->setTradePassword($password);

            if ($success) {
                \DB::commit();
                return $this->success('操作成功');
            } else {
                \DB::rollBack();
            }
        } catch (BizException $bizException) {
            \DB::rollBack();
            return $this->error($bizException->getMessage());
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error($e);
            return $this->error($e->getMessage());
        }

        return $this->error('操作失败');
    }


    public function captcha(Request $request, Response $response)
    {
//        Captcha::create();
        return $this->success('', [
            'url' => app('captcha')->create('math', true)
        ]);
    }


}
