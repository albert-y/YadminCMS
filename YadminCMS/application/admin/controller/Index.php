<?php
/**
 * Created by PhpStorm.
 * User: lsyjq
 * Date: 2017/11/1
 * Time: 22:05
 */
namespace app\admin\controller;



class Index extends AdminBase
{

    public function index()
    {
        return view('Index/index');
    }
    public function getDefault(){
        return view('Main/default');
    }



}