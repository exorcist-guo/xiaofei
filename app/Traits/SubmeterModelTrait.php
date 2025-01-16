<?php


namespace App\Traits;




use App\Member;

trait SubmeterModelTrait
{
    //$type == 1 转化id为mdid
    public function __construct($suffix = '',$type = 0,$is_prior = 0)
    {
        if(!is_array($suffix)){
            if($is_prior == 0 && defined('USER_MDID') && USER_MDID){
                $this->setTable($this->getTable().'_'.USER_MDID);
            }else{
                if($suffix !== ''){
                    if($type){
                        $suffix = $suffix%Member::SUBNUM;
                    }
                    $this->setTable($this->getTable().'_'.$suffix);
                }
            }
        }

    }


    public static function setSuffix($suffix = '',$type = 0,$is_prior = 1)
    {
        return new static($suffix,$type,$is_prior);
    }

}
