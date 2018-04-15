<?php
/**
 * Created by PhpStorm.
 * User: yuanjianqiu
 * Date: 2018/3/9
 * Time: 19:58
 */

namespace app\home\model;

use think\Model;

class Auth extends Model
{
      public function getModel(){
          $sql="select auth_id,auth_name  from esin_auth WHERE auth_pid = 0";
          $data=Auth::query($sql);
          return $data;
      }
      public function getModelChildren($pid){
          $sql="select auth_id,auth_name from esin_auth WHERE auth_pid ='".$pid."'";
          $data=Auth::query($sql);
          return $data;
      }
}