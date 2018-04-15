<?php
/**
 * Created by PhpStorm.
 * User: lsyjq
 * Date: 2017/11/10
 * Time: 13:55
 */
namespace app\home\model;
use think\Model;
class Users extends Model
{
    public function getUserDatas($data){

        return $this::get(['user_name'=>$data['user_name'],'user_password'=>$data['user_password']]);
    }
    public function Users(){
        return 0;
    }
    public function requirementSelect(){
        $number=func_num_args();
        $arg_list=func_get_args();
        //需要修改一下写法，暂时先这么写着
        if($number>=1){
            return $this->field([$arg_list[0][0],$arg_list[0][1]])->select();
        }else{

        }
    }


}