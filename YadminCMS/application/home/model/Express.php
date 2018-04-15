<?php
/**
 * Created by PhpStorm.
 * User: lsyjq
 * Date: 2018/1/18
 * Time: 19:28
 */

namespace app\home\model;


use think\Model;

class Express extends Model
{
    public function addExpress($data){

        $express=new Express();
        $res=$express->save($data);
        return $res;

     }
    public function editExpress($id,$data){

        $res=Express::where($id)->update($data);
        return $res;
    }
    public function delExpress($id){
        $express=new Express();
        $res=$express->where($id)->delete();
        return $res;
    }
    public function getExpressList(){

        $sql="select e.id,operate_time as operatetime,goods as expressname ,number as expressnum,
        counts as expresscount ,recipients,consignor,real_name as editor,notes from esin_express as e LEFT JOIN esin_users AS u ON e.operate_person=u.id ORDER BY id DESC ";

        $res=Express::query($sql);
        return $res;

    }
    public function getRowByName($data){
        $sql="select operate_time as '操作时间',number as '快递单号',goods as '货物名称' ,
        counts as '数量' ,recipients AS  '寄件人',consignor AS '收件人',real_name as '操作人',notes AS  '备注' from esin_express as e LEFT JOIN esin_users AS u ON e.operate_person=u.id where e.id=:id ";

        $res=Express::query($sql,['id' => $data['id']]);
        return $res;
    }
}