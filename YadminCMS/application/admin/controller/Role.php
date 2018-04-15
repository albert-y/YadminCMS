<?php
/**
 * Created by PhpStorm.
 * User: yuanjianqiu
 * Date: 2018/4/7
 * Time: 13:55
 */

namespace app\admin\controller;


use think\Controller;
use think\Loader;

class Role extends  Controller
{
    public function index(){

        $roleData=$this->getRole();

        $auth =new Auth();
        $firtParentNameList=$auth->getParentInfo();

        $this->assign([
            'list'=>$roleData,
            'parentlist'=>$firtParentNameList
        ]);

       // $this->fetch('Role/index');
        return view('Role/index');
    }
    private function getRole(){
        $roleObj=Loader::model('Role');
        return $roleData=$roleObj->getRole();

    }




}
