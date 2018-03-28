<?php
/**
 * Created by PhpStorm.
 * User: lsyjq
 * Date: 2017/11/3
 * Time: 18:02
 */
namespace app\admin\model;
use think\Model;
use think\Db;
class Users extends Model
{
    public function  add($data){
//        $sql="insert into users  (user_name,user_password,user_type) value('++','++'")"
        $res=$this->save($data);
        return $res;
    }
    public function editPwd($identify){

    }
    public function editInfo($data){

    }
    public function getUserList(){
        $sql="select id,user_name as 'username',real_name as 'realname',user_password as 'password',last_login_time as 'logintime' ,last_login_ip as 'loginip', user_type as 'usertype' , status as 'status' , add_time as 'addtime' from esin_users";
        return Users::query($sql);
    }
    public function getUserInfo($data){


        return $res=Users::where($data)->select();
    }
    public function validateAddUser($data){
       //$sql="select id from esin_users where user_name='"+$data['user_name']+"' and user_password= '"+$data['user_password']+"'";
       // return Users::query($sql);

        return $this->field('id')->where($data)->select();
    }
    public function deleteUser($data){
        return Users::where('id','=',$data['id'])->delete();
    }
    //慎用
    public function deleteAllUser(){

    }

}