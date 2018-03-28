<?php
/**
 * Created by PhpStorm.
 * User: lsyjq
 * Date: 2017/11/3
 * Time: 0:13
 */

namespace app\admin\controller;

use think\Loader;
use think\Request;
use think\Db;


class Users extends  AdminBase
{

    protected $user;
    /*
     * 用户列表
     * */
    public function index(){

    }
    /*
     * 添加用户
     * */
    public function  add(){

    }
    /*
     * 添加用户提交
     * */
    public function addPost(){

    }
    /*
     *用户信息修改
     * */
    public function edit(){

    }
    /*
     * 用户信息修改提交
     * */
    public function editPost(){

    }
    /*
     * 用户删除
     * */
    public function delete(){

    }
    public function addEmployee(){
        if(Request::instance()->isPost()){
            if(empty($_POST['username']) && empty($_POST['realname']) && empty($_POST['password']) && empty($_POST['type'])){
                $result=['status'=>0,'massage'=>'用户名和密码不能为空'];
                return json($result);
            }
            else{
                $user=Loader::model('Users');
                $data['user_name']=$_POST['username'];
                $data['user_password']=$_POST['password'];
                $data['real_name']=$_POST['realname'];

                $res=$user->validateAddUser($data);
                if(!$res){
                    $data['user_type']=$_POST['type'];
                    $data['add_time']=date('Y-m-d H:i:s',time());
                    $res=$user->add($data);
                    if($res){
                        $ajx=['status'=>1,'massage'=>'保存成功'];
                        return json($ajx);
                    }else{
                        echo "fail";
                    }
                }else{

                    $ajx=['status'=>2,'massage'=>'已存在该员工的信息，如果存在重名情况请更换其他密码'];
                    //dump($ajx);die();
                    return json($ajx);
                }
            }
        }else{
           echo "拒绝了您的请求";
        }

    }
    public function editUser(){
        $user=Loader::editUser();

    }
    public function getUserList(){
        $list=Db::table('esin_users')
            ->field("id,user_name as 'username',real_name as 'realname',user_password as 'password',last_login_time as 'logintime' ,last_login_ip as 'loginip', user_type as 'usertype' , status as 'status' , add_time as 'addtime'")
            ->paginate(10);
//        dump($list);
        $count=Db::table('esin_users')->count();
        return $this->fetch('Index/index',[
            'list'=>$list,
            'count'=>$count
        ]);

    }
    public function deleteUser(){

        if(Request::instance()->isGet()){
            if(is_null($_GET)){
                return  $data['status']='203';
            }else{
                $user=Loader::model('Users');
                $data['id']=(int)$_GET['id'];
                $result=$user->deleteUser($data);
              //  dump(json($data['status']='200'));
                $ajx=['status'=>0,'massage'=>'success'];
                return json($ajx);
            }
        }else{

        }
    }

}