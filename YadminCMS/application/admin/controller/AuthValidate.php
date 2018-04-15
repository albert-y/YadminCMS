<?php
/**
 * Created by PhpStorm.
 * User: yuanjianqiu
 * Date: 2018/4/8
 * Time: 14:31
 */

namespace app\admin\controller;


class AuthValidate
{
    /*
     * 获取当前操作类
     * */
    public  function getClassName(){

         $this->ClassName=get_class();
    }
    /*
     * 获取当前类操作方法
     * */
    public  function getFunctionAll($className){

         $this->FuncInClass=get_class_methods($className);

    }



}