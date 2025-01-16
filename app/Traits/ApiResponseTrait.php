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
//        var_dump($msg);
        $md5_msg = md5($msg);
        if($msg && !Lang::has('auto.'.$md5_msg)){
            $lang_path = base_path().DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR.'zh-CN'.DIRECTORY_SEPARATOR.'auto.php';
            $auto = File::get($lang_path);
            $str = "'%s'=>'%s',".PHP_EOL."];";
            $str = sprintf($str,$md5_msg,$msg);
            $auto = str_replace('];', $str, $auto);
            File::put($lang_path,$auto);
        }else{
            $msg = Lang::get('auto.'.$msg);
        }

        return response()->json(compact('msg', 'code', 'data'));
    }
}
