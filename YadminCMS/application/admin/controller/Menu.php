<?php
/**
 * Created by PhpStorm.
 * User: yuanjianqiu
 * Date: 2018/3/26
 * Time: 19:53
 */

namespace app\admin\controller;


class Menu extends AdminBase
{
       public function index(){
           return $this->redirect('Users/add');
       }
}