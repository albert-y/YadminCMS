<?php
/**
 * Created by PhpStorm.
 * User: lsyjq
 * Date: 2018/1/6
 * Time: 18:00
 */

namespace app\home\model;

use think\Model;
class Stocktype extends Model
{
    public function allType(){

    }
    public function fristParentType(){
       $sql="select * from esin_stocktype where parent_id=0";
        return Stocktype::query($sql);
    }
    public function childrenType($data){
        $sql="select * from esin_stocktype where parent_id=:parent_id";
        return Stocktype::query($sql,['parent_id'=>$data['parent_id']]);
    }
    public function addType($data){
        $stty=new Stocktype();
        return $stty->save($data);
    }
}