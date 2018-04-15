<?php
/**
 * Created by PhpStorm.
 * User: lsyjq
 * Date: 2018/1/16
 * Time: 1:39
 */

namespace app\home\controller;
//use think\Controller;
use think\Loader;

class Express extends HomeBase
{
    public function  expressList(){
        $res=Loader::model('Express')->getExpressList();

       return json($res);

    }
    public function  addExpress(){
        if(1){
           if (request()->isPost() && $_POST['expressnum'] !='' && $_POST['expressname'] !='' && $_POST['expresscount'] !=''
               && $_POST['recipients'] !='' && $_POST['consignor'] !=''){

               $data['number']=$_POST['expressnum'];
               $data['goods']=$_POST['expressname'];
               $data['counts']=$_POST['expresscount'];
               $data['recipients']=$_POST['recipients'];
               $data['consignor']=$_POST['consignor'];
               $data['notes']=$_POST['notes'];
               $data['operate_time']=date('Y-m-d',time());
               $data['operate_person']=67;

               $res=Loader::model('Express')->addExpress($data);

               if($res){
                   return json($msg=['status'=>1,'message'=>'添加成功']);

               }else{
                   return json($msg=['status'=>1,'message'=>'添加失败']);

               }

           }else{
            return json($msg=['status'=>2,'message'=>'您提交的数据不合法']);
           }
        }else{
            return json($msg=['status'=>0,'message'=>'您的权限不够，请联系管理员']);
        }


    }
    public function  editExpress(){
        $id['id']=$_POST['id'];

        $data['number']=(int)$_POST['expressnum'];
        $data['goods']=$_POST['expressname'];
        $data['counts']=(int)$_POST['expresscount'];
        $data['recipients']=$_POST['recipients'];
        $data['consignor']=$_POST['consignor'];
        $data['notes']=$_POST['notes'];
        $data['operate_time']=date('Y-m-d',time());
        $data['operate_person']=64;

        $res=Loader::model('Express')->editExpress($id,$data);
        if($res){
            return json($msg=['status'=>1,'message'=>'修改成功']);
        }else{
            return json($msg=['status'=>2,'message'=>'修改失败']);
        }
    }
    public function  delExpress(){
        $id['id']=$_POST['sid'];

        $res=Loader::model('Express')->delExpress($id);
        if($res){
            return json($msg=['status'=>1,'message'=>'删除成功']);
        }else{
            return json($msg=['status'=>2,'message'=>'删除失败']);
        }

    }
    public function  detailedExpress(){
        $data['id']=$_POST['sid'];
        $res=Loader::model('Express')->getRowByName($data);

        return json($res[0]);
    }
}