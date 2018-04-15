<?php
/**
 * Created by PhpStorm.
 * User: yuanjianqiu
 * Date: 2018/2/24
 * Time: 16:44
 */

namespace app\admin\controller;


use think\Loader;

class Auth extends Admin
{

    /*
     * 权限管理
     * */
        public function index(){
            return view('Auth/index');
        }
      /*
       * 权限添加提交 有问题 || && 运算出错了
       * */
        public  function add(){
            if(isset($_POST)){
                if( empty($_POST['authname']) ||
                    empty($_POST['controllername']) ||
                    empty($_POST['funcname'])){

                    $ajaxmesg=['status'=>'0','message'=>"以上内容不能为空"];

                    return json($ajaxmesg);

                }else{
                    $data['auth_name'] = $_POST['authname'];
                    $data['auth_pid']  = $_POST['parentname'];
                    $data['auth_c']    = $_POST['controllername'];
                    $data['auth_a']    = $_POST['funcname'];



                    $res=Loader::model("Auth")->add($data);

                    if($res){
                        $ajaxmesg=['status'=>'1','message'=>'添加成功, o(≥v≤)o~~好棒 '];
                        return json($ajaxmesg);
                    }else{
                        $ajaxmesg=['status'=>'0','message'=>"╯﹏╰ 粉无奈~~ 添加失败了"];

                        return json($ajaxmesg);
                    }
                }
            }
        }


        public function getAuthList(){

            $data=Loader::model('Auth')->selectAll();
            if($data){
                return json($data);
            }else{
                unset($data);
                $data=['status'=>'0'];
                return json($data);
            }

        }


        public function authDel(){
            $ajaxmesg=['status'=>'0','message'=>$_POST['id']];

            return json($ajaxmesg);
        }

        public function getParentInfo(){

            $auth =Loader::model('Auth');

            return $firtParentNameList=$auth->getFirstParentList();
        }
        public function getChildrenList(){

            $auth = Loader::model('Auth');


            $data=$auth->getChildrenList($_POST['pid']);

            return json($data);
        }
}