<?php
/**
 * Created by PhpStorm.
 * User: yuanjianqiu
 * Date: 2018/2/23
 * Time: 18:13
 */

namespace app\home\controller;


use think\Loader;

class Auth extends HomeBase
{
    public function  addAuth(){
        return view('add');
    }
    public function getModelNameList(){
        $auth=Loader::model('Auth');
        $res=$auth->getModel();
        if($res){
            return json($res);
        }else{
            echo "程序错误";
        }
    }
    public function getModelChildren(){

        $auth=Loader::model('Auth');
        $res=$auth->getModelChildren($_POST['modelnum']);

        //print_r($res);
        return json($res);
    }

}