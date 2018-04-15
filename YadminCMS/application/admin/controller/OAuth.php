<?php
/**
 * Created by PhpStorm.
 * User: yuanjianqiu
 * Date: 2018/4/4
 * Time: 20:38
 */

namespace app\admin\controller;


class OAuth extends AdminBase
{
    public function index(){

        return view('Users/oauth');
    }
}