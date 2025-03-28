<?php


namespace App\Traits;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;

trait ApiResponseTrait
{
    protected function success($msg = '', $data = [])
    {
        return $this->message($msg, $data, 0);
    }

    protected function error($msg = '', $data = [], $code = 1)
    {

        return $this->message($msg, $data, $code);
    }

    protected function message($msg, $data = [], $code = 0)
    {
        $msg_arr = [];
        if(is_array($msg)){
            $msg_arr = $msg;
            $msg = $msg['msg'];
        }
        if($msg && !Lang::has('auto.'.$msg)){
            $lang_path = base_path().DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR.'zh-CN'.DIRECTORY_SEPARATOR.'auto.php';
            $auto = File::get($lang_path);
            $str = "'%s'=>'%s',".PHP_EOL."];";
            $str = sprintf($str,$msg,$msg);
            $auto = str_replace('];', $str, $auto);
            File::put($lang_path,$auto);
        }else{
            $msg = Lang::get('auto.'.$msg,$msg_arr);
        }

        return response()->json(compact('msg', 'code', 'data'));
    }
}
