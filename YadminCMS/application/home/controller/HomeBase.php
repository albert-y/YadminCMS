<?php
/**
 * Created by PhpStorm.
 * User: yuanjianqiu
 * Date: 2018/2/20
 * Time: 10:53
 */

namespace app\home\controller;

use think\Controller;
use think\Session;


class HomeBase extends Controller
{

    public function _initialize(){
        if(Session::get('username')==null){
            $this->redirect('Users/login');
        }else{

        }
    }


}