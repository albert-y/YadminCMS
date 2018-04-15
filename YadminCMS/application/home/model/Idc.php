<?php
/**
 * Created by PhpStorm.
 * User: lsyjq
 * Date: 2017/11/30
 * Time: 19:23
 */

namespace app\home\model;

use think\Model;

class Idc extends Model
{
//  查询机房是否存在
    public function getIDC($data)
    {
        $result=$this->where($data)->select();
        return $result;
    }
//  添加机房
    public function setIDC($data){
       //  $sql="insert into esin_idc ('idc_name') VALUE ('"+$data['idc_name']+"')";
       $result=$this->save($data);
       // $result=Idc::query($sql);
        return $result;
    }
    //获取IDC列表
    public function getIDCList(){
        //$result=$this->select();
        $sql="SELECT id,idc_name AS idcname,abbreviation AS idcabbre FROM esin_idc  ORDER BY idc_name  ASC ";
        $result=Idc::query($sql);
        return $result;
    }
}