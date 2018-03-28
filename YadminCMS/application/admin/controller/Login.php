<?php
/**
 * Created by PhpStorm.
 * User: yuanjianqiu
 * Date: 2018/3/27
 * Time: 23:27
 */

namespace app\admin\controller;

use think\Controller;
use think\Loader;
use think\Session;

class Login extends Controller
{

    public function login(){

        $user=Loader::model('Users');



        if(!empty($_POST['username']) && !empty($_POST['password'])){

            $data['user_name'] = $_POST['username'];
            $data['user_password'] = $_POST['password'];
            $res = $user->getUserInfo($data);

            if ($res) {

                Session::set('username',$data['user_name']);
                $this->redirect('Index/index');

            } else {
                $msg="身份验证错误，请检查用户名密码";
                return $this->fetch('login',['errormsg' =>$msg]);
            }
        }else{
            $msg=null;
            return $this->fetch('login',['errormsg' =>$msg]);
        }
    }

    public function logout(){
        $msg=null;
        Session::delete('username');
        $this->redirect('login');
    }

}