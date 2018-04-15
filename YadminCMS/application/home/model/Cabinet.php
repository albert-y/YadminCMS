<?php
/**
 * Created by PhpStorm.
 * User: lsyjq
 * Date: 2017/11/30
 * Time: 19:23
 */

namespace app\home\model;

use think\Model;

class Cabinet extends Model
{
    //  查询机柜是否存在
    public function getCabinet($data){
        //  $sql="insert into esin_idc ('idc_name') VALUE ('"+$data['idc_name']+"')";
        $result=$this->where($data)->select();
        // $result=Idc::query($sql);
        return $result;
    }
//  添加机柜
    public function saveCabinet($data){
        $cabModel= new Cabinet();
        $result=$cabModel->save($data);
        unset($cabModel);
        return $result;
    }
    //获取Cabinet列表
    public function getCabinetList(){
        //$result=$this->select();
        $sql="SELECT c.id,cabinet_name AS cabinetname,i.idc_name AS idcname FROM esin_cabinet AS c JOIN esin_idc AS i ON c.idcid=i.id  ORDER BY i.idc_name ASC ,cabinet_name ASC";
        $result=Cabinet::query($sql);
        return $result;
    }
    public function getCabinetID($data){
        $cab=new Cabinet();
        $result=$cab->field('id')->where($data)->select();
        return $result;
    }
}