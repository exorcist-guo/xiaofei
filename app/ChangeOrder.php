<?php

namespace App;

use App\Traits\BelongsToMember;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Model;

/**
 * App\ChangeOrder
 *
 * @property int $id
 * @property int $member_id
 * @property int $admin_id 操作员ID
 * @property int $type 1会员信息修改,2修改等级，3修改积分,4修改营业额
 * @property int $status 0待审核,1审核失败,2审核通过,3修改完成
 * @property string $content 内容
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ChangeOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ChangeOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ChangeOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ChangeOrder whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ChangeOrder whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ChangeOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ChangeOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ChangeOrder whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ChangeOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ChangeOrder whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ChangeOrder whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $audite_admin_id 审核员ID
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ChangeOrder whereAuditeAdminId($value)
 */
class ChangeOrder extends Model
{
    use BelongsToMember;
    protected $table = 'change_order';

    const TYPE_MAP = [
        1 => '会员信息修改',
        2 => '会员等级修改',
        3 => '会员积分修改',
        4 => '修改营业额',
        5 => '修改状态',
        6 => '修改上级',
        7 => '社区等级修改',
        8 => '社区等级防降级',
        9 => '消费券修改',
    ];

    const ASSET_TYPE = [
        3 => '积分',
        4 => '营业额',
        9 => '消费劵',
    ];

    const STATUS_MAP = [
        0 => '待审核',
        1 => '审核失败',
        2 => '审核通过',
        3 => '修改完成',
        4 => '修改失败',
    ];

    public function operator()
    {
        return $this->belongsTo(Administrator::class, 'admin_id', 'id');
    }

    public function scopeOperatorMember(Builder $query, $memberId)
    {
        $query->where('admin_id', $memberId);
    }

    public function audite()
    {
        return $this->belongsTo(Administrator::class, 'audite_admin_id', 'id');
    }

    public function scopeAuditeMember(Builder $query, $memberId)
    {
        $query->where('audite_admin_id', $memberId);
    }



    public static function adjustMemberLevel($user,$toLevel){
        $content = [
            'level_before' => $user->level,
            'level_after' => $toLevel
        ];
        $content = json_encode($content);
        $change_order = new ChangeOrder();
        $change_order->type = 2;
        $change_order->member_id = $user->id;
        $change_order->admin_id = ADMIN_ID;
        $change_order->audite_admin_id = 0;
        $change_order->status = 0;
        $change_order->content = $content;
        return $change_order->save();
    }

    public static function adjustMemberShopLevel($user,$toLevel){
        $content = [
            'level_before' => $user->level,
            'level_after' => $toLevel
        ];
        $content = json_encode($content);
        $change_order = new ChangeOrder();
        $change_order->type = 7;
        $change_order->member_id = $user->id;
        $change_order->admin_id = ADMIN_ID;
        $change_order->audite_admin_id = 0;
        $change_order->status = 0;
        $change_order->content = $content;
        return $change_order->save();
    }

    public static function adjustMemberStatus($user,$toLevel){
        $content = [
            'status_before' => $user->is_disabled,
            'status_after' => $toLevel
        ];
        $content = json_encode($content);
        $change_order = new ChangeOrder();
        $change_order->type = 5;
        $change_order->member_id = $user->id;
        $change_order->admin_id = ADMIN_ID;
        $change_order->audite_admin_id = 0;
        $change_order->status = 0;
        $change_order->content = $content;
        return $change_order->save();
    }

    public static function savePid($user,$p_user){
        $content = [
            'pid_before' => $user->pid,
            'pid_after' => $p_user->id
        ];
        $content = json_encode($content);
        $change_order = new ChangeOrder();
        $change_order->type = 6;
        $change_order->member_id = $user->id;
        $change_order->admin_id = ADMIN_ID;
        $change_order->audite_admin_id = 0;
        $change_order->status = 0;
        $change_order->content = $content;
        return $change_order->save();
    }

    public static function saveMember(Member $user,$data){
        $content = [];
        if($data['mobile'] != $user->mobile){
            $content['mobile'] = $data['mobile'];
        }
        if($data['real_name'] != $user->real_name){
            $content['real_name'] = $data['real_name'];
        }
        if($data['id_number'] != $user->id_number){
            $content['id_number'] = $data['id_number'];
        }
        if(!empty($data['password']) ){
            $content['password'] = $data['password'];
        }
        if(!empty($data['transaction_password'])){
            $content['transaction_password'] = $data['transaction_password'];
        }

        $content = json_encode($content);
        $change_order = new ChangeOrder();
        $change_order->type = 1;
        $change_order->member_id = $user->id;
        $change_order->admin_id = ADMIN_ID;
        $change_order->audite_admin_id = 0;
        $change_order->status = 0;
        $change_order->content = $content;
        return $change_order->save();

        return true;
    }

    public static function saveAsset(Member $user,$asset_type,$amount){
        $content = [
            'amount' => $amount
        ];
        $content = json_encode($content);
        $change_order = new ChangeOrder();
        $change_order->type = $asset_type;
        $change_order->member_id = $user->id;
        $change_order->admin_id = ADMIN_ID;
        $change_order->audite_admin_id = 0;
        $change_order->status = 0;
        $change_order->content = $content;
        return $change_order->save();

    }

    public static function getContentView($content,$type){
        $view = '';
        $content = json_decode($content,true);
        switch ($type){
            case 1:
                foreach ($content as $key => $val){
                    if($key == 'mobile'){
                        $view .= "手机号修改为:{$val}<br\>";
                    }
                    if($key == 'real_name'){
                        $view .= "姓名修改为:{$val}<br\>";
                    }
                    if($key == 'id_number'){
                        $view .= "身份证修改为:{$val}<br\>";
                    }
                    if($key == 'password'){
                        $view .= "登录密码修改为:{$val}<br\>";
                    }
                    if($key == 'transaction_password'){
                        $view .= "操作密码修改为:{$val}<br\>";
                    }
                }
                break;
            case 2:

                if(isset($content['level_before']) && isset($content['level_after'])){
                    $view = "原等级:【{$content['level_before']}】调整为等级【{$content['level_after']}】";

                }
                break;
            case 3:
                if(isset($content['amount'])){
                    if($content['amount']>0 ){
                        $view = "增加积分:". abs($content['amount']);
                    }else{
                        $view = "减少积分:". abs($content['amount']);
                    }

                }
                break;
            case 4:
                if(isset($content['amount'])){
                    if($content['amount']>0 ){
                        $view = "增加营业额:". abs($content['amount']);
                    }else{
                        $view = "减少营业额:". abs($content['amount']);
                    }
                }
                break;
            case 5:
                if(isset($content['status_before']) && isset($content['status_after'])){
                    $status_name = Member::IS_DISABLED_MAP;
                    $view = "申请会员状态【{$status_name[$content['status_before']]}】变更成【{$status_name[$content['status_after']]}】";
                }
                break;
            case 6:
                if(isset($content['pid_before']) && isset($content['pid_after'])){
                    $mobile_before = Member::whereId($content['pid_before'])->value('mobile');
                    $mobile_after = Member::whereId($content['pid_after'])->value('mobile');
                    $view = "上级{$mobile_before}变更成{$mobile_after}";
                }
                break;
            case 7:
                if(isset($content['level_before']) && isset($content['level_after'])){
                    $view = "社群原等级:【{$content['level_before']}】调整为等级【{$content['level_after']}】";

                }
                break;
            case 8:
                if(isset($content['status_before']) && isset($content['status_after'])){
                    $status_name = Member::LOCK_SHOP_LEVEL_MAP;
                    $view = "申请社群防降级【{$status_name[$content['status_before']]}】变更成【{$status_name[$content['status_after']]}】";
                }
                break;
            case 9:
                if(isset($content['amount'])){
                    if($content['amount']>0 ){
                        $view = "增加消费劵:". abs($content['amount']);
                    }else{
                        $view = "减少消费劵:". abs($content['amount']);
                    }

                }
                break;
            default:
                return false;

        }

        return  $view;

    }

}
