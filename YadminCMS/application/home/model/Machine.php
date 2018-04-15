<?php
/**
 * Created by PhpStorm.
 * User: lsyjq
 * Date: 2017/11/30
 * Time: 19:23
 */

namespace app\home\model;

use think\Model;

class Machine extends Model
{
    //    查询某个属性值 后期可以把查询序列号 IP的方法取消
    public function getMachineFieldValue($data)
    {
        $result=$this->where($data)->select();
        return $result;
    }
    //    查询某个属性值 后期可以把查询序列号 IP的方法取消
    public function getRowByName($data)
    {
        $result= Machine::query('select asset_id AS "资产编号" ,device_sn AS "序列号" ,c.cabinet_name AS "所在机柜", 
                        device_from AS "来源",
                        (CASE device_destination  WHEN "0" THEN "库房" WHEN "1" THEN "客户带走" WHEN "2" THEN "其他" END) AS "设备下架去向",
                        company_id AS "所属公司",
                        device_config AS "配置",ip_address AS "IP",d.typename AS "设备类型",
                        (CASE device_state WHEN "0" THEN "已上架" WHEN "1" THEN "已下架" ELSE "库存" END) AS "状态",
                        device_standard AS "规格",
                        up_shelves_date AS "上架时间",
                        down_shelves_date AS "下架时间",
                        (CASE change_old_site WHEN "0" THEN "未录" WHEN "1" THEN "已录" END) AS "老后台",
                        (CASE change_new_site WHEN "0" THEN "未录" WHEN "1" THEN "已录" END) AS "新后台",
                        (CASE told_business_dept WHEN "0" THEN "未通知" WHEN "1" THEN "已通知" END) AS "商务",
                        u.real_name AS "操作人",notes AS "备注" 
                        from esin_machine AS m 
                        LEFT JOIN esin_users AS u ON m.editor_id=u.id 
                        LEFT JOIN esin_cabinet AS c ON m.cabinet_id=c.id 
                        LEFT JOIN esin_devicetype AS d ON m.device_type=d.id where m.id=:id', ['id' => $data['id']]);
        return $result;
    }
    //    查询序列号
    public function getAssetSN($data)
    {
        $result=$this->where($data)->select();
        return $result;
    }
    //    查询IP 由于IP重用性 此处需要修改 只查上架中的IP
    public function getIpAddress($data)
    {
        $result=$this->where($data)->select();
        return $result;
    }
    //  上架  有问题带排查
    public function addUpShelves($data){
        // $sql="insert into esin_machine (asset_id,device_idc_id,cabinet_id,device_from)"++" '";
        $result=$this->save($data);
      //  $result=1;
        return $result;
    }
    public function getMachineList(){
        //$result=$this->select();
        $sql="SELECT m.id, asset_id, m.cabinet_id,device_sn, device_from, company_id, device_config,ip_address,
              (CASE  device_state WHEN  '0' THEN '已上架' WHEN '1' THEN '已下架' ELSE '库存' END) AS device_state,
              dtype.typename AS device_type, device_standard, up_shelves_date, down_shelves_date, change_old_site, change_new_site, told_business_dept, notes, operation_date, cabinet_name, real_name 
              FROM esin_machine AS m 
              LEFT JOIN esin_users AS u ON m.editor_id=u.id 
              LEFT JOIN esin_cabinet AS c ON m.cabinet_id=c.id 
              LEFT JOIN esin_devicetype AS dtype ON m.device_type=dtype.id
              ORDER BY up_shelves_date DESC ";
        $result=Machine::query($sql);
        return $result;
    }
    //单条删除设备数据
    public  function delMachine($data){
        $machine=new Machine();
        $res=$machine->where($data)->delete();
        return $res;

    }
    //修改设备数据
    public function updateMachine($id,$data){

        $res=Machine::where($id)->update($data);
        return $res;

    }
    //按时间查询machine数据
    public function getMachineByTime($start,$end){
        $sql="SELECT m.id, asset_id, m.cabinet_id,device_sn, device_from, company_id, device_config,ip_address,(CASE device_state WHEN '0' THEN '已上架' WHEN '1' THEN '已下架' ELSE '库存' END) AS device_state,dtype.typename AS device_type, device_standard, up_shelves_date, down_shelves_date, change_old_site, change_new_site, told_business_dept, notes, operation_date, cabinet_name, real_name FROM esin_machine AS m LEFT JOIN esin_users AS u ON m.editor_id=u.id LEFT JOIN esin_cabinet AS c ON m.cabinet_id=c.id LEFT JOIN esin_devicetype AS dtype ON m.device_type=dtype.id WHERE operation_date BETWEEN '".$start."' AND '".$end."' ORDER BY up_shelves_date DESC";
        $result=Machine::query($sql);
        return $result;
    }
}