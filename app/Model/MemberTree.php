<?php

namespace App\Model;

use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Model\MemberTree
 *
 * @property int $id
 * @property int $pid
 * @property int $deep
 * @property string|null $path
 * @property int $level
 * @property int $shop_level
 * @property int $lock_shop_level 0 自动升降级 1不自动
 * @property string|null $shop_level_time 社群时间
 * @property int|null $group_number 组号
 * @property string $mobile
 * @property string $number 账号
 * @property float $integral 积分
 * @property float $all_integral 全部积分
 * @property float $pv 业绩
 * @property float $divvy_pv 已结算业绩
 * @property float|null $divvy_pv_t 特殊已结算业绩，只对自己有效
 * @property float $dikouquan 抵扣券数量
 * @property float $dikouquan_k 可用抵扣券
 * @property int $pid_shop_member_id 上级社区
 * @property int $shop_member_id 所属社区
 * @property string $avatar 图像
 * @property int $certificate_type 证件类型
 * @property string $real_name 真实姓名
 * @property string $id_number 身份证号
 * @property string $certificate_image 证件照
 * @property int $is_active 是否激活
 * @property int $nation 国家
 * @property string $lang 语言
 * @property string|null $mobile_nation
 * @property string $password
 * @property string $last_ip
 * @property string|null $last_login
 * @property int $is_disabled
 * @property string|null $disabled_at
 * @property string|null $transaction_password
 * @property int $is_set_transaction_password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $is_chuxiao 0 不发放促销  1 发放促销
 * @property string|null $chuxiao_time 激活时间
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\MemberTree[] $children
 * @property-read int|null $children_count
 * @property-read \App\Model\MemberTree $parent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereAllIntegral($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereCertificateImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereCertificateType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereChuxiaoTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereDeep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereDikouquan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereDikouquanK($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereDisabledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereDivvyPv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereDivvyPvT($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereGroupNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereIdNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereIntegral($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereIsChuxiao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereIsDisabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereIsSetTransactionPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereLastIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereLastLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereLockShopLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereMobileNation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereNation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree wherePid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree wherePidShopMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree wherePv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereShopLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereShopLevelTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereShopMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereTransactionPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberTree whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MemberTree extends Model
{
    use ModelTree;

    protected $table = 'members';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('pid');
        $this->setOrderColumn('id');
        $this->setTitleColumn('number');
    }
}
