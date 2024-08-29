<?php

namespace App;

use App\Exceptions\BizException;
use App\Model\ShopNumber;
use App\Traits\SubmeterModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;


/**
 * App\Member
 *
 * @property int $id
 * @property int $pid
 * @property int $deep
 * @property string|null $path
 * @property int $level
 * @property int $shop_level
 * @property int $lock_shop_level 0 自动升降级 1不自动
 * @property string $mobile
 * @property string $number 账号
 * @property float $integral 积分
 * @property float $all_integral 全部积分
 * @property float $pv 业绩
 * @property float $divvy_pv 分红业绩
 * @property float $dikouquan 抵扣券数量
 * @property int $pid_shop_member_id 上级社区
 * @property int $shop_member_id 所属社区
 * @property string $avatar 图像
 * @property int $certificate_type 证件类型
 * @property string $real_name 真实姓名
 * @property string $id_number 身份证号
 * @property int $certificate_image 证件照
 * @property int $is_active 是否激活
 * @property int $nation 国家
 * @property string $lang 语言
 * @property string $password
 * @property string $last_ip
 * @property string|null $last_login
 * @property int $is_disabled
 * @property string|null $disabled_at
 * @property string|null $transaction_password
 * @property int $is_set_transaction_password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereAllIntegral($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereCertificateImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereCertificateType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereDeep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereDikouquan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereDisabledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereDivvyPv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereIdNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereIntegral($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereIsDisabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereIsSetTransactionPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereLastIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereLastLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereLockShopLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereNation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member wherePid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member wherePidShopMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member wherePv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereShopLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereShopMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereTransactionPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Member extends Authenticatable
{
//    use SubmeterModelTrait;
    protected $table = 'members';
//    protected $hidden = ['password','transaction_password'];

    //分表数量
    const SUBNUM = 20;

    const IS_DISABLED_MAP = [
        0 => '正常',
        1 => '锁定',
        9 => '删除',
    ];

    const LOCK_SHOP_LEVEL_MAP = [
        0 => '启用',
        1 => '禁用'
    ];

    public function zuhao()
    {
        return $this->belongsTo(ShopNumber::class, 'shop_member_id', 'member_id');
    }


    public function setPassword($password)
    {
        $this->password = \Hash::make($password);
        return $this->save();
    }

    public static function getNations()
    {
        return [
            1 => __('map.china'), //中国
            2 => __('map.korea'), //韩国

        ];
    }

    public static function getLangList()
    {
        return [
            ['id' => 'zh-CN','name' => '中文'],
            ['id' => 'en','name' => 'English'],
            ['id' => 'ko','name' => '한국어'],
        ];
    }


    public static function getNtlw()
    {
        return [
          1 => __('map.passport'),  //护照
          2 => 'ID',
          3 => __('map.mobile'),
          4 => __('map.rests'),
        ];
    }


    //9 已删除
    public static function findByMobile($mobile)
    {
        return Member::where('mobile', $mobile)->where('is_disabled','<',9)->first();
    }

    public function setParent($inviteUser)
    {
        if($this->pid != 0) {
            throw new BizException('不能重置邀请码');
        }

        if(!$inviteUser) {
            throw new BizException('找不到邀请人');
        }

        if($this->id == $inviteUser->id) {
            throw new BizException('不能自己邀请自己');
        }

        $pid = $inviteUser->getKey();

        return $pid;
    }

    public function verifyPassword($password)
    {
        return \Hash::check($password, $this->password);
    }

    public static function getTradeNo($head = 'ZY'){
        list($msec, $sec) = explode(' ', microtime());
        $a = mt_rand(10, 99999)  . substr($msec, 2, 5);
        $num = time() + $a + substr(str_shuffle(str_repeat('123456789', 5)), 0, 10);

        return $head.date('md').$num;
    }

    public static function createMemberNumber($member_id)
    {
        $redis_key = 'zuohao'.date('ymd').'m'.$member_id;
        $redis_num_key = 'zuohao_list_cache';

        $zuohao = Redis::hget($redis_num_key,$member_id);
        if(empty($redis_num)){
            $zuohao = ShopNumber::whereMemberId($member_id)->value('number');
            if(empty($zuohao)){
                $member_id = 0;
                $zuohao = '1000';
            }
            Redis::hset($redis_num_key,$member_id,$zuohao);
        }

        Redis::INCR($redis_key);
        $num = Redis::get($redis_key);
        Redis::expire($redis_key,86400);
        $number = date('ymd').$zuohao;
        if($num == 1){
            $m_number = Member::where('number','like',$number.'%')->value('number');
            if($m_number){
                $num = substr($m_number,9) + 1;
                Redis::set($redis_key,$num);
            }
        }
        $num = str_pad($num,3,'0',STR_PAD_LEFT);
        $number .= $num;
        return $number;
    }

    public function setTradePassword($password)
    {
        $this->transaction_password = Hash::make($password);
        $this->is_set_transaction_password = 1;
        return $this->save();
    }

    public static function getAllSpreadUids(int $uid ,$type = 0){
        $uids = [$uid];
        if($type){
            $uids = [];
        }

        do{
            $uid = Member::whereId($uid)->value('pid');
            if(!$uid) break;
            $uids[] = $uid;
        }while($uid);
        return $uids;
    }

    public static function isIdCard($idcard='') {
        $idcard= strtoupper($idcard);
        $regx      = "/(^\d{15}$)|(^\d{17}([0-9]|X)$)/";
        $arr_split = array();
        if (!preg_match($regx, $idcard)) {
            return false;
        }
//检查15位
        if (15 == strlen($idcard)){
            $regx = "/^(\d{6})+(\d{2})+(\d{2})+(\d{2})+(\d{3})$/";
            @preg_match($regx, $idcard, $arr_split);
//检查生日日期是否正确
            $dtm_birth = "19" . $arr_split[2] . '/' . $arr_split[3] . '/' . $arr_split[4];
            if (!strtotime($dtm_birth)) {
                return false;
            } else {
                return true;
            }

//检查18位
        } else {
            $regx = "/^(\d{6})+(\d{4})+(\d{2})+(\d{2})+(\d{3})([0-9]|X)$/";
            @preg_match($regx, $idcard, $arr_split);
            $dtm_birth = $arr_split[2] . '/' . $arr_split[3] . '/' . $arr_split[4];
            //检查生日日期是否正确
            if (!strtotime($dtm_birth)){
                return false;
            } else {
//检验18位身份证的校验码是否正确。
//校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10。
                $arr_int = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
                $arr_ch  = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
                $sign    = 0;
                for ($i = 0; $i < 17; $i++) {
                    $b = (int) $idcard[$i];
                    $w = $arr_int[$i];
                    $sign += $b * $w;
                }
                $n       = $sign % 11;
                $val_num = $arr_ch[$n];
                if ($val_num != substr($idcard, 17, 1)) {
                    return false;
                }else {
                    return true;
                }
            }
        }
    }
}
