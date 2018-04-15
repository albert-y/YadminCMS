<?php
/**
 * Created by PhpStorm.
 * User: yuanjianqiu
 * Date: 2018/4/4
 * Time: 20:35
 * 管理员管理类
 */

namespace app\admin\controller;


class Admin extends AdminBase
{
    public function index(){
        return view('index');
    }
}