<?php
/**
 * Created by PhpStorm.
 * User: lsyjq
 * Date: 2017/11/14
 * Time: 19:52
 */
namespace app\home\controller;
//use think\Controller;
use think\Loader;
use think\Request;

class Stock extends HomeBase
{

    public function stockEdit(){
        if(1){
            if(request()->isPost()){
                $id['id']=(int)$_POST['id'];

                $data['operate_time']=date('Y-m-d',time());
                $data['goods_count']=(int)$_POST['counts'];
                $data['goods_company']=$_POST['company'];
                $data['goods_usedevice']=$_POST['usedevice'];
                $data['goods_linelength']=$_POST['linelength'];
                $data['goods_useaddr']=$_POST['useaddr'];
                $data['notes']=$_POST['notes'];
                $data['editor_id']=67;

                $res =Loader::model('Stock')->editStock($id,$data);
                if($res){
                    return json($jsdata=['message'=>'修改成功']);
                }
            }else{
                return json($jsdata=['message'=>'服务器拒绝了您请求']);
            }

        }else{
            return json($jsdata=['message'=>'权限不够，联系管理员']);
        }

    }
    public function stockDelete(){
      if(1){
          if(Request::instance()->isPost() && $_POST['sid'] != ""){
             $data['id'] =$_POST['sid'];
             $res=Loader::model('Stock')->delStock($data);
              if($res){
                  return json($jsondata=['status'=>1,'message'=>'删除成功']);
              }else{
                  return json($jsondata=['status'=>0,'message'=>'删除失败']);
              }
          }else{
              return json($jsondata=['status'=>2,'message'=>'请求不合法']);
          }

      }else{
          return json($jsondata=['status'=>3,'message'=>'您的权限不够，请联系管理员']);
      }

    }
    public function stockList(){
        $res=Loader::model('Stock')->stockList();
        return json($res);
    }

    public function lineList(){
        $data=['pid'=>1];
        $res=Loader::model('Stock')->classifyList($data);
        return json($res);
    }
    public function partskList(){
        $data=['pid'=>2];
        $res=Loader::model('Stock')->classifyList($data);
        return json($res);
    }


    public function stockDetailed(){
        $data['id'] =$_POST['sid'];
        $res=Loader::model('Stock')->getRowByName($data);
        return json($res[0]);
    }



    public function getModelNum(){
        $data=['parent_id'=>$_POST['typeid']];
        $res=Loader::model('Stocktype')->childrenType($data);
        return json($res);
    }
    public function getStockType(){
          $data=Loader::model('Stocktype')->fristParentType();
          return json($data);
    }



    public function addStock($data){

        $res=Loader::model('Stock')->addStock($data);

        if($res){
            return json($jsondata=['status'=>1,'message'=>'添加成功']);
        }else{
            return json($jsondata=['status'=>0,'message'=>'添加失败']);
        }
    }
    public function addLine(){

        if(Request::instance()->isPost()
            && $_POST['modelnum']!=''   && $_POST['usedevice'] !=''
            && $_POST['count'] !=''     && $_POST['company'] !=''
            && $_POST['length'] !=''    && $_POST['useaddr'] !=''
        ){
            $data['operate_time']=date('Y-m-d',time());
            $data['goods_type']=$_POST['modelnum'];
            $data['goods_count']=(int)$_POST['count'];
            $data['goods_company']=$_POST['company'];
            $data['goods_usedevice']=$_POST['usedevice'];
            $data['goods_linelength']=$_POST['length'];
            $data['goods_useaddr']=$_POST['useaddr'];
            $data['notes']=$_POST['notes'];
            $data['editor_id']=67;
            return $this->addStock($data);
        }else{
            return json($jsondata=['status'=>0,'message'=>"您的请求不合法"]);
        }

    }
    public function addParts(){
        if(Request::instance()->isPost()
            && $_POST['modelnum']!=''   && $_POST['usedevice'] !=''
            && $_POST['count'] !='' && $_POST['company'] !=''
        ){
            $data['operate_time']=date('Y-m-d',time());
            $data['goods_type']=$_POST['modelnum'];
            $data['goods_count']=(int)$_POST['count'];
            $data['goods_company']=$_POST['company'];
            $data['goods_usedevice']=$_POST['usedevice'];
            $data['notes']=$_POST['notes'];
            $data['editor_id']=67;

            return $this->addStock($data);
        }else{
            return json($jsondata=['message'=>"您的请求不合法"]);
        }
    }
    public function addStockType(){
        if(Request::instance()->isPost() && $_POST['type'] !="" && $_POST['modelnum'] !=""){
           $data['parent_id']=$_POST['type'];
           $data['typename']=$_POST['modelnum'];

           $res= Loader::model('Stocktype')->addType($data);

            if($res){
                return json($jsondata=['status'=>1,'message'=>'添加成功']);
            }else{
                return json($jsondata=['status'=>0,'message'=>'添加失败']);
            }
        }else{
            return json($jsondata=['message'=>'您的请求不合法']);
        }
    }

}