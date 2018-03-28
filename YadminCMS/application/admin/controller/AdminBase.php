<?php
/**
 * Created by PhpStorm.
 * User: yuanjianqiu
 * Date: 2018/2/20
 * Time: 10:48
 */
namespace app\admin\controller;
use think\Controller;
use think\Session;


class AdminBase extends Controller{

    public function _initialize(){
        if(Session::get('username')==null){
            $this->redirect('Login/login');
        }
    }

}
