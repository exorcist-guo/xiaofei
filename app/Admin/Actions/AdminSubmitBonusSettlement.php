<?php

namespace App\Admin\Actions;

use App\Exceptions\BizException;

use App\Jobs\PostMemberJob;
use App\Model\BonusSettlement;
use App\PostMember;
use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;

use Encore\Admin\Admin;
use Illuminate\Support\Facades\Redis;



class AdminSubmitBonusSettlement extends Action
{

    protected $selector = '.admin-submit-bonus-settlement';

    public function handle(Request $request)
    {

        try{
            $redis_key = 'admin-submit-bonus-settlement';
            if(!Redis::set($redis_key, 1, 'ex', 30, 'nx')) {
                throw new BizException('操作太频繁');
            }
            $start_time = $request->input('start_time');
            $end_time = $request->input('end_time');
            $day_time = date('Y-m-d');
            if($start_time == $day_time || $end_time == $day_time){
                throw new BizException('不能结算当天的');
            }
            if($start_time > $end_time || $start_time > $day_time ){
                throw new BizException('结算时间有误');
            }
            $last_jie = BonusSettlement::orderByDesc('id')->first();
            if($last_jie->status < 20){
                throw new BizException('有未完成结算');
            }
            $bonus_settlement = new BonusSettlement();
            $bonus_settlement->status = 1;
            $bonus_settlement->admin_id = ADMIN_ID;
            $bonus_settlement->start_time = $start_time.' 00:00:00';
            $bonus_settlement->end_time = $end_time.' 23:59:59';
            $bonus_settlement->status = 0;
            $is_jie = BonusSettlement::whereDate('end_time', '>=',$start_time)->first();
            if($is_jie){
                throw new BizException('该时间段已结算');
            }
            $bonus_settlement->save();

            return $this->response()->success('提交成功等待结算')->refresh();
        }catch (\Exception $e){
            Redis::expire($redis_key,2);
            return $this->response()->error($e -> getMessage());
        }

    }

    public function form()
    {
        $this->date('start_time', '开始时间')->rules('required');
        $this->date('end_time', '结束时间')->rules('required');

    }

//    public function dialog()
//    {
//        $this->confirm('确定结算奖金？');
//    }

    /**
     * 按钮名称
     * @return string
     */
    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-default admin-submit-bonus-settlement">结算奖金</a>
HTML;
    }

    /**
     * 表单
     */


    /**
     * 上传等待
     * @return string
     */
    public function handleActionPromise()
    {
        $resolve = <<<SCRIPT
var actionResolverss = function (data) {
            $('.modal-footer').show()
            $('.tips').remove()
            var response = data[0];
            var target   = data[1];

            if (typeof response !== 'object') {
                return $.admin.swal({type: 'error', title: 'Oops!'});
            }

            var then = function (then) {
                if (then.action == 'refresh') {
                    $.admin.reload();
                }

                if (then.action == 'download') {
                    window.open(then.value, '_blank');
                }

                if (then.action == 'redirect') {
                    $.admin.redirect(then.value);
                }
            };

            if (typeof response.html === 'string') {
                target.html(response.html);
            }

            if (typeof response.swal === 'object') {
                $.admin.swal(response.swal);
            }

            if (typeof response.toastr === 'object') {
                $.admin.toastr[response.toastr.type](response.toastr.content, '', response.toastr.options);
            }

            if (response.then) {
              then(response.then);
            }
        };

        var actionCatcherss = function (request) {
            $('.modal-footer').show()
            $('.tips').remove()

            if (request && typeof request.responseJSON === 'object') {
                $.admin.toastr.error(request.responseJSON.message, '', {positionClass:"toast-bottom-center", timeOut: 10000}).css("width","500px")
            }
        };
SCRIPT;

        Admin::script($resolve);

        return <<<SCRIPT
         $('.modal-footer').hide()
         let html = `<div class='tips' style='color: red;font-size: 18px;'>奖金结算时间较长。。。<img src="data:image/gif;base64,R0lGODlhEAAQAPQAAP///1VVVfr6+np6eqysrFhYWG5ubuPj48TExGNjY6Ojo5iYmOzs7Lq6utjY2ISEhI6OjgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh/hpDcmVhdGVkIHdpdGggYWpheGxvYWQuaW5mbwAh+QQJCgAAACwAAAAAEAAQAAAFUCAgjmRpnqUwFGwhKoRgqq2YFMaRGjWA8AbZiIBbjQQ8AmmFUJEQhQGJhaKOrCksgEla+KIkYvC6SJKQOISoNSYdeIk1ayA8ExTyeR3F749CACH5BAkKAAAALAAAAAAQABAAAAVoICCKR9KMaCoaxeCoqEAkRX3AwMHWxQIIjJSAZWgUEgzBwCBAEQpMwIDwY1FHgwJCtOW2UDWYIDyqNVVkUbYr6CK+o2eUMKgWrqKhj0FrEM8jQQALPFA3MAc8CQSAMA5ZBjgqDQmHIyEAIfkECQoAAAAsAAAAABAAEAAABWAgII4j85Ao2hRIKgrEUBQJLaSHMe8zgQo6Q8sxS7RIhILhBkgumCTZsXkACBC+0cwF2GoLLoFXREDcDlkAojBICRaFLDCOQtQKjmsQSubtDFU/NXcDBHwkaw1cKQ8MiyEAIfkECQoAAAAsAAAAABAAEAAABVIgII5kaZ6AIJQCMRTFQKiDQx4GrBfGa4uCnAEhQuRgPwCBtwK+kCNFgjh6QlFYgGO7baJ2CxIioSDpwqNggWCGDVVGphly3BkOpXDrKfNm/4AhACH5BAkKAAAALAAAAAAQABAAAAVgICCOZGmeqEAMRTEQwskYbV0Yx7kYSIzQhtgoBxCKBDQCIOcoLBimRiFhSABYU5gIgW01pLUBYkRItAYAqrlhYiwKjiWAcDMWY8QjsCf4DewiBzQ2N1AmKlgvgCiMjSQhACH5BAkKAAAALAAAAAAQABAAAAVfICCOZGmeqEgUxUAIpkA0AMKyxkEiSZEIsJqhYAg+boUFSTAkiBiNHks3sg1ILAfBiS10gyqCg0UaFBCkwy3RYKiIYMAC+RAxiQgYsJdAjw5DN2gILzEEZgVcKYuMJiEAOwAAAAAAAAAAAA=="><\/div>`
         $('.modal-header').append(html)
process.then(actionResolverss).catch(actionCatcherss);
SCRIPT;
    }


}
