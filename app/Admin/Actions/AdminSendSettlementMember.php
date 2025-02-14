<?php

namespace App\Admin\Actions;


use App\Exceptions\BizException;
use App\Jobs\ChangeOrderJob;
use App\Model\SettlementMember;
use App\PostSaveMember;
use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;

use Encore\Admin\Admin;
use Illuminate\Support\Facades\Redis;



class AdminSendSettlementMember extends Action
{

    protected $selector = '.post-admin-send-settlement-member';

    public function handle(Request $request)
    {

        try{

            $redis_key = 'admin_send_settlement_member';
            if(!Redis::set($redis_key, 1, 'ex', 30, 'nx')) {
                throw new BizException('操作太频繁');
            }
            $post_member_status = $request->input('post_member_status');
            $jiesuan_id = $request->input('jiesuan_id');
            $data = SettlementMember::where('bonus_settlement_id',$jiesuan_id)
//                ->where('status',0)
                ->first();
            if(empty($data)){
                throw new BizException('结算ID未找到，请确认结算ID是否正确');
            }

            if($data->status == 1){
                $redis_send = 'command:bonus-settlement-send';
                Redis::set($redis_send,$jiesuan_id);
                $msg = '发放任务添加成功';
            }else{
                throw new BizException('没有待发放的数据');
            }



            Redis::expire($redis_key,2);
            return $this->response()->success($msg)->refresh();
        }catch (\Exception $e){
            Redis::expire($redis_key,2);
            return $this->response()->error($e -> getMessage());
        }

    }

    public function get_file_type($filename){
        $type = substr($filename, strrpos($filename, ".")+1);
        return $type;
    }

    /**
     * 按钮名称
     * @return string
     */
    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-default post-admin-send-settlement-member">执行发放</a>
HTML;
    }

    /**
     * 表单
     */
    public function form()
    {

        $this->text('jiesuan_id', '结算ID')
            ->help('执行成功无法取消，请先确认数据是否正确')
        ;


    }


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
         let html = `<div class='tips' style='color: red;font-size: 18px;'>发放时间取决于数据量，请耐心等待！<img src="data:image/gif;base64,R0lGODlhEAAQAPQAAP///1VVVfr6+np6eqysrFhYWG5ubuPj48TExGNjY6Ojo5iYmOzs7Lq6utjY2ISEhI6OjgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh/hpDcmVhdGVkIHdpdGggYWpheGxvYWQuaW5mbwAh+QQJCgAAACwAAAAAEAAQAAAFUCAgjmRpnqUwFGwhKoRgqq2YFMaRGjWA8AbZiIBbjQQ8AmmFUJEQhQGJhaKOrCksgEla+KIkYvC6SJKQOISoNSYdeIk1ayA8ExTyeR3F749CACH5BAkKAAAALAAAAAAQABAAAAVoICCKR9KMaCoaxeCoqEAkRX3AwMHWxQIIjJSAZWgUEgzBwCBAEQpMwIDwY1FHgwJCtOW2UDWYIDyqNVVkUbYr6CK+o2eUMKgWrqKhj0FrEM8jQQALPFA3MAc8CQSAMA5ZBjgqDQmHIyEAIfkECQoAAAAsAAAAABAAEAAABWAgII4j85Ao2hRIKgrEUBQJLaSHMe8zgQo6Q8sxS7RIhILhBkgumCTZsXkACBC+0cwF2GoLLoFXREDcDlkAojBICRaFLDCOQtQKjmsQSubtDFU/NXcDBHwkaw1cKQ8MiyEAIfkECQoAAAAsAAAAABAAEAAABVIgII5kaZ6AIJQCMRTFQKiDQx4GrBfGa4uCnAEhQuRgPwCBtwK+kCNFgjh6QlFYgGO7baJ2CxIioSDpwqNggWCGDVVGphly3BkOpXDrKfNm/4AhACH5BAkKAAAALAAAAAAQABAAAAVgICCOZGmeqEAMRTEQwskYbV0Yx7kYSIzQhtgoBxCKBDQCIOcoLBimRiFhSABYU5gIgW01pLUBYkRItAYAqrlhYiwKjiWAcDMWY8QjsCf4DewiBzQ2N1AmKlgvgCiMjSQhACH5BAkKAAAALAAAAAAQABAAAAVfICCOZGmeqEgUxUAIpkA0AMKyxkEiSZEIsJqhYAg+boUFSTAkiBiNHks3sg1ILAfBiS10gyqCg0UaFBCkwy3RYKiIYMAC+RAxiQgYsJdAjw5DN2gILzEEZgVcKYuMJiEAOwAAAAAAAAAAAA=="><\/div>`
         $('.modal-header').append(html)
process.then(actionResolverss).catch(actionCatcherss);
SCRIPT;
    }


}
