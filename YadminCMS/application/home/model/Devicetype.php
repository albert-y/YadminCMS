<?php
/**
 * Created by PhpStorm.
 * User: lsyjq
 * Date: 2017/12/22
 * Time: 11:03
 */

namespace app\home\model;

use \think\Model;
class Devicetype extends Model
{
    //查询设备类型表
    public function  getDeviceTypeList(){
        $sql="select id,typename from esin_devicetype";
        $res=Devicetype::query($sql);
        return $res;
    }
//    根据设备类型名查询设备类型ID
    public function getDeviceTypeID($data){
       // $dty=new Devicetype();
        $result=$this->where($data)->select();
        return $result;
    }
    //添加设备类型
    public function addDeviceType($data){
        $result=$this->save($data);
        return $result;


    }
    public function delDeviceType(){

    }
}