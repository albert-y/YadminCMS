<?php
/**
 * Created by PhpStorm.
 * User: yuanjianqiu
 * Date: 2018/4/5
 * Time: 20:37
 */

namespace app\admin\model;


use think\Model;

class Role extends Model
{
    public function getRole(){

        $sql='select * from esin_role';

         return self::query($sql);
    }

}