<?php

namespace App\Admin\Actions\Post;

use App\Exceptions\BizException;
use App\Imports\CommonImport;
use App\Jobs\PostMemberJob;
use App\Jobs\PostSaveMemberJob;
use App\PostMember;
use App\PostSaveMember;
use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;

use Encore\Admin\Admin;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;


class ImportSaveMemberPost extends Action
{

    protected $selector = '.import-save-member-action';

    public function handle(Request $request)
    {
        ini_set('max_execution_time', '0');
        $Filesystem = new Filesystem;
        $file_path = 'uploads/post/savemember';
        $Filesystem->deleteDirectory($file_path);
        try{
            $is_pici = PostSaveMember::whereIn('status',[0,3,4,6])->first();
            if($is_pici){
                throw new BizException('有'.PostSaveMember::STATUS_MAP[$is_pici->status].'会员没处理');
            }

            // $request ...
            $file = $request-> file('file');


            $result = Excel::toArray( new CommonImport(),$file);
//            var_dump($result);
            $posr_member  = PostSaveMember::orderByDesc('id')->first();
            if($posr_member){
                $pici  = $posr_member->pici + 1;
            }else{
                $pici = 1;
            }
            $result = $result[0];
            $titles = $result[0];
            $title_map = PostSaveMember::TITLE_MAP;
            if($titles[0] != '账号'){
                throw new BizException('首列必须是账号');
            }

            if(empty($title_map[$titles[1]])){
                throw new BizException('不支持'.$titles[1].'修改');
            }else{
                $type = $title_map[$titles[1]];
            }




            foreach ($result as $key => $val){
                if($key > 0 && isset($val[1])){
                    $data = [
                        'status' => '0',
                        'pici' => $pici,
                        'admin_id' => ADMIN_ID,
                        'type' => $type,
                        'val' => $val,
                    ];
                    PostSaveMemberJob::dispatch($data);
                }
            }
            return $this->response()->success('数据导入成功')->refresh();
        }catch (\Exception $e){
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
        <a class="btn btn-sm btn-default import-save-member-action">导入文件</a>
HTML;
    }

    /**
     * 表单
     */
    public function form()
    {
        $this
            ->file('file', '请选择文件')
            ->options(['showPreview' => false,
                'allowedFileExtensions'=>['xlsx'],
                'showUpload'=>true
            ]);
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
         let html = `<div class='tips' style='color: red;font-size: 18px;'>导入时间取决于数据量，请耐心等待结果不要关闭窗口！<img src="data:image/gif;base64,R0lGODlhEAAQAPQAAP///1VVVfr6+np6eqysrFhYWG5ubuPj48TExGNjY6Ojo5iYmOzs7Lq6utjY2ISEhI6OjgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh/hpDcmVhdGVkIHdpdGggYWpheGxvYWQuaW5mbwAh+QQJCgAAACwAAAAAEAAQAAAFUCAgjmRpnqUwFGwhKoRgqq2YFMaRGjWA8AbZiIBbjQQ8AmmFUJEQhQGJhaKOrCksgEla+KIkYvC6SJKQOISoNSYdeIk1ayA8ExTyeR3F749CACH5BAkKAAAALAAAAAAQABAAAAVoICCKR9KMaCoaxeCoqEAkRX3AwMHWxQIIjJSAZWgUEgzBwCBAEQpMwIDwY1FHgwJCtOW2UDWYIDyqNVVkUbYr6CK+o2eUMKgWrqKhj0FrEM8jQQALPFA3MAc8CQSAMA5ZBjgqDQmHIyEAIfkECQoAAAAsAAAAABAAEAAABWAgII4j85Ao2hRIKgrEUBQJLaSHMe8zgQo6Q8sxS7RIhILhBkgumCTZsXkACBC+0cwF2GoLLoFXREDcDlkAojBICRaFLDCOQtQKjmsQSubtDFU/NXcDBHwkaw1cKQ8MiyEAIfkECQoAAAAsAAAAABAAEAAABVIgII5kaZ6AIJQCMRTFQKiDQx4GrBfGa4uCnAEhQuRgPwCBtwK+kCNFgjh6QlFYgGO7baJ2CxIioSDpwqNggWCGDVVGphly3BkOpXDrKfNm/4AhACH5BAkKAAAALAAAAAAQABAAAAVgICCOZGmeqEAMRTEQwskYbV0Yx7kYSIzQhtgoBxCKBDQCIOcoLBimRiFhSABYU5gIgW01pLUBYkRItAYAqrlhYiwKjiWAcDMWY8QjsCf4DewiBzQ2N1AmKlgvgCiMjSQhACH5BAkKAAAALAAAAAAQABAAAAVfICCOZGmeqEgUxUAIpkA0AMKyxkEiSZEIsJqhYAg+boUFSTAkiBiNHks3sg1ILAfBiS10gyqCg0UaFBCkwy3RYKiIYMAC+RAxiQgYsJdAjw5DN2gILzEEZgVcKYuMJiEAOwAAAAAAAAAAAA=="><\/div>`
         $('.modal-header').append(html)
process.then(actionResolverss).catch(actionCatcherss);
SCRIPT;
    }


}
