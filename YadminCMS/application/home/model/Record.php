<?php
/**
 * Created by PhpStorm.
 * User: lsyjq
 * Date: 2017/11/18
 * Time: 14:43
 */

namespace app\home\model;
use think\Model;

class Record extends Model
{

//    查询序列号
    public function getDeviceSN($data)
    {
        $result=$this->where($data)->select();
        return $result;
    }
//    添加硬件记录
    public function addMachineNote($data){
        $result=$this->save($data);
        return $result;
    }
    //查询record所有值
    //获取记录表信息
    public function getNoteList()
    {
        $sql="select r.id,(CASE record_type WHEN '0' THEN '迁入' WHEN '1' THEN '迁出' END) as 'recordType',
              record_date as 'recordTime',
              device_from as 'machineFrom' ,
              device_destination as 'machineDestination' ,
              trackingnumber as 'trackingnumber' ,
              company_id as 'companyName',
              device_name as 'machineName' ,
              device_config as 'machineInfo' ,
              device_sn as 'seriesNumber' ,
              device_standard as 'machineStandard' ,
              device_count as 'machineCount' ,
               (CASE  told_business_dept WHEN  '0' THEN '未通知' WHEN '1' THEN '已通知' END) as 'toldBusinessDept' ,
              real_name as 'realname',
              notes as 'notes'
              from esin_record AS r  LEFT JOIN esin_users AS u ON r.editor_id=u.id ORDER BY id desc";
        return Record::query($sql);
    }
    //删除硬件登记
    public function delNotes($data){
        $rec=new Record();
        $res=$rec->where($data)->delete();
        return $res;

    }
    //获取record表单行的值
    public function getRowByName($data)
    {
        $result= Record::query('select device_sn AS "序列号",(CASE record_type WHEN "0" THEN "迁入" WHEN "1" THEN "迁出" END ) AS "进出类型" ,
                        record_date AS "登记时间" ,device_from AS "来源",device_destination AS "去向",trackingnumber AS "快递单号",
                        company_id AS "所属公司",device_name AS "物品名称",
                        device_config AS "物品型号",
                        device_standard AS "规格",
                        device_count AS "数量",
                        (CASE told_business_dept WHEN "0" THEN "未通知" WHEN "1" THEN "已通知" END) AS "商务",
                        u.real_name AS "操作人",notes AS "备注" 
                        from esin_record AS r 
                        LEFT JOIN esin_users AS u ON r.editor_id=u.id 
                        where r.id=:id', ['id' => $data['id']]);
        return $result;
    }

    //修改设备数据
    public function updateRecord($id,$data){

        $res=Record::where($id)->update($data);
        return $res;

    }
    public function getNoteListByTime($start,$end)
    {
        $sql="select r.id,(CASE record_type WHEN '0' THEN '迁入' WHEN '1' THEN '迁出' END) as 'recordType',
              record_date as 'recordTime',
              device_from as 'machineFrom' ,
              device_destination as 'machineDestination' ,
              trackingnumber as 'trackingnumber' ,
              company_id as 'companyName',
              device_name as 'machineName' ,
              device_config as 'machineInfo' ,
              device_sn as 'seriesNumber' ,
              device_standard as 'machineStandard' ,
              device_count as 'machineCount' ,
               (CASE  told_business_dept WHEN  '0' THEN '未通知' WHEN '1' THEN '已通知' END) as 'toldBusinessDept' ,
              real_name as 'realname',
              notes as 'notes'
              from esin_record AS r  LEFT JOIN esin_users AS u ON r.editor_id=u.id WHERE record_date BETWEEN '".$start."' and '".$end."' ORDER BY id desc";
        return Record::query($sql);
    }
}



