<?php
/**
 * Created by PhpStorm.
 * User: yuanjianqiu
 * Date: 2018/3/2
 * Time: 18:33
 */

namespace app\home\controller;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use think\Loader;

class Excel extends HomeBase
{
    /**
     *仓库所有数据导出
    **/
    public function  stockExcelExportAll(){

        $spreadsheet = new Spreadsheet();//实例化Spreadsheet类
        $objSheet=$spreadsheet->getActiveSheet();

        $data=Loader::model('Stock')->stockList();

//
//        print_r($data);
//        exit();
        //填充数据
        $index=0;
        $operatetime=$this->getCells($index);
        $typename=$this->getCells($index+1);
        $counts=$this->getCells($index+2);
        $company=$this->getCells($index+3);
        $useaddr=$this->getCells($index+4);
        $usedevice=$this->getCells($index+5);
        $linelength=$this->getCells($index+6);
        $realname=$this->getCells($index+7);
        $notes=$this->getCells($index+8);
        $objSheet->setCellValue('A1','操作时间')
                 ->setCellValue('B1','类型')
                 ->setCellValue('C1','数量')
                 ->setCellValue('D1','所属公司')
                 ->setCellValue('E1','所用位置')
                 ->setCellValue('F1','所用设备')
                 ->setCellValue('G1','长度')
                 ->setCellValue('H1','操作人')
                 ->setCellValue('I1','备份');
        $j=2;
        foreach ($data as $data_k => $data_v){
            $objSheet->setCellValue($operatetime.$j,$data_v['operatetime'])
                     ->setCellValue($typename.$j,$data_v['typename'])
                     ->setCellValue($counts.$j,$data_v['counts'])
                     ->setCellValue($company.$j,$data_v['company'])
                     ->setCellValue($useaddr.$j,$data_v['useaddr'])
                     ->setCellValue($usedevice.$j,$data_v['usedevice'])
                     ->setCellValue($linelength.$j,$data_v['linelength'])
                     ->setCellValue($realname.$j,$data_v['realname'])
                     ->setCellValue($notes.$j,$data_v['notes']);
            $j++;
        }

        $this->export($spreadsheet);

    }
    /**
     *仓库管理数据导出按时间
     **/
    public function stockExcelExportByTime(){
        $spreadsheet = new Spreadsheet();//实例化Spreadsheet类
        $objSheet=$spreadsheet->getActiveSheet();

        $data=Loader::model('Stock')->stockListByTime($_GET['starttime'],$_GET['endtime']);

//
//        print_r($data);
//        exit();
        //填充数据
        $index=0;
        $operatetime=$this->getCells($index);
        $typename=$this->getCells($index+1);
        $counts=$this->getCells($index+2);
        $company=$this->getCells($index+3);
        $useaddr=$this->getCells($index+4);
        $usedevice=$this->getCells($index+5);
        $linelength=$this->getCells($index+6);
        $realname=$this->getCells($index+7);
        $notes=$this->getCells($index+8);
        $objSheet->setCellValue('A1','操作时间')
            ->setCellValue('B1','类型')
            ->setCellValue('C1','数量')
            ->setCellValue('D1','所属公司')
            ->setCellValue('E1','所用位置')
            ->setCellValue('F1','所用设备')
            ->setCellValue('G1','长度')
            ->setCellValue('H1','操作人')
            ->setCellValue('I1','备份');
        $j=2;
        foreach ($data as $data_k => $data_v){
            $objSheet->setCellValue($operatetime.$j,$data_v['operatetime'])
                ->setCellValue($typename.$j,$data_v['typename'])
                ->setCellValue($counts.$j,$data_v['counts'])
                ->setCellValue($company.$j,$data_v['company'])
                ->setCellValue($useaddr.$j,$data_v['useaddr'])
                ->setCellValue($usedevice.$j,$data_v['usedevice'])
                ->setCellValue($linelength.$j,$data_v['linelength'])
                ->setCellValue($realname.$j,$data_v['realname'])
                ->setCellValue($notes.$j,$data_v['notes']);
            $j++;
        }

        $this->export($spreadsheet);

    }
    /**
     *设备管理数据导出
     **/
    public function machineExcelExportAll(){
        $spreadsheet = new Spreadsheet();//实例化Spreadsheet类
        $objSheet=$spreadsheet->getActiveSheet();

        $data=Loader::model('Machine')->getMachineList();
//        print_r($data);


        $index=0;
        $operation_date=$this->getCells($index);
        $device_from=$this->getCells($index+1);
        $company_id=$this->getCells($index+2);
        $asset_id=$this->getCells($index+3);
        $device_sn=$this->getCells($index+4);
        $device_type=$this->getCells($index+5);
        $device_state=$this->getCells($index+6);
        $ip_address=$this->getCells($index+7);
        $device_standard=$this->getCells($index+8);
        $up_shelves_date=$this->getCells($index+9);
        $down_shelves_date=$this->getCells($index+10);
//        $cabinet_id=$this->getCells($index+1);
        $cabinet_name=$this->getCells($index+11);
        $device_config=$this->getCells($index+12);
        $change_old_site=$this->getCells($index+13);
        $change_new_site=$this->getCells($index+14);
        $told_business_dept=$this->getCells($index+15);
        $real_name=$this->getCells($index+16);
        $notes=$this->getCells($index+17);


        $objSheet->setCellValue('A1','操作时间')
            ->setCellValue('B1','来源')
            ->setCellValue('C1','所属公司')
            ->setCellValue('D1','资产编号')
            ->setCellValue('E1','序列号')
            ->setCellValue('F1','设备类型')
            ->setCellValue('G1','设备状态')
            ->setCellValue('H1','IP地址')
            ->setCellValue('I1','设备规格')
            ->setCellValue('J1','上架时间')
            ->setCellValue('K1','下架时间')
            ->setCellValue('L1','所在机柜')
            ->setCellValue('M1','品牌型号配置')
            ->setCellValue('N1','修改老后台')
            ->setCellValue('O1','修改新后台')
            ->setCellValue('P1','通知商务')
            ->setCellValue('Q1','操作人')
            ->setCellValue('R1','备注');
        $j=2;
        foreach ($data as $data_k => $data_v){
            $objSheet->setCellValue($operation_date.$j,$data_v['operation_date'])
                ->setCellValue($device_from.$j,$data_v['device_from'])
                ->setCellValue($company_id.$j,$data_v['company_id'])
                ->setCellValue($asset_id.$j,$data_v['asset_id'])
                ->setCellValue($device_sn.$j,$data_v['device_sn'])
                ->setCellValue($device_type.$j,$data_v['device_type'])
                ->setCellValue($device_state.$j,$data_v['device_state'])
                ->setCellValue($ip_address.$j,$data_v['ip_address'])
                ->setCellValue($device_standard.$j,$data_v['device_standard'])
                ->setCellValue($up_shelves_date.$j,$data_v['up_shelves_date'])
                ->setCellValue($down_shelves_date.$j,$data_v['down_shelves_date'])
                ->setCellValue($cabinet_name.$j,$data_v['cabinet_name'])
                ->setCellValue($device_config.$j,$data_v['device_config'])
                ->setCellValue($change_old_site.$j,$data_v['change_old_site'])
                ->setCellValue($change_new_site.$j,$data_v['change_new_site'])
                ->setCellValue($told_business_dept.$j,$data_v['told_business_dept'])
                ->setCellValue($real_name.$j,$data_v['real_name'])
                ->setCellValue($notes.$j,$data_v['notes']);
            $j++;
        }

        $this->export($spreadsheet);
    }
    /**
     *仓库管理数据导出按时间
     **/
    public function machineExcelExportByTime(){
        $spreadsheet = new Spreadsheet();//实例化Spreadsheet类
        $objSheet=$spreadsheet->getActiveSheet();

        $data=Loader::model('Machine')->getMachineByTime($_GET['starttime'],$_GET['endtime']);
//        print_r($data);


        $index=0;
        $operation_date=$this->getCells($index);
        $device_from=$this->getCells($index+1);
        $company_id=$this->getCells($index+2);
        $asset_id=$this->getCells($index+3);
        $device_sn=$this->getCells($index+4);
        $device_type=$this->getCells($index+5);
        $device_state=$this->getCells($index+6);
        $ip_address=$this->getCells($index+7);
        $device_standard=$this->getCells($index+8);
        $up_shelves_date=$this->getCells($index+9);
        $down_shelves_date=$this->getCells($index+10);
//        $cabinet_id=$this->getCells($index+1);
        $cabinet_name=$this->getCells($index+11);
        $device_config=$this->getCells($index+12);
        $change_old_site=$this->getCells($index+13);
        $change_new_site=$this->getCells($index+14);
        $told_business_dept=$this->getCells($index+15);
        $real_name=$this->getCells($index+16);
        $notes=$this->getCells($index+17);


        $objSheet->setCellValue('A1','操作时间')
            ->setCellValue('B1','来源')
            ->setCellValue('C1','所属公司')
            ->setCellValue('D1','资产编号')
            ->setCellValue('E1','序列号')
            ->setCellValue('F1','设备类型')
            ->setCellValue('G1','设备状态')
            ->setCellValue('H1','IP地址')
            ->setCellValue('I1','设备规格')
            ->setCellValue('J1','上架时间')
            ->setCellValue('K1','下架时间')
            ->setCellValue('L1','所在机柜')
            ->setCellValue('M1','品牌型号配置')
            ->setCellValue('N1','修改老后台')
            ->setCellValue('O1','修改新后台')
            ->setCellValue('P1','通知商务')
            ->setCellValue('Q1','操作人')
            ->setCellValue('R1','备注');
        $j=2;
        foreach ($data as $data_k => $data_v){
            $objSheet->setCellValue($operation_date.$j,$data_v['operation_date'])
                ->setCellValue($device_from.$j,$data_v['device_from'])
                ->setCellValue($company_id.$j,$data_v['company_id'])
                ->setCellValue($asset_id.$j,$data_v['asset_id'])
                ->setCellValue($device_sn.$j,$data_v['device_sn'])
                ->setCellValue($device_type.$j,$data_v['device_type'])
                ->setCellValue($device_state.$j,$data_v['device_state'])
                ->setCellValue($ip_address.$j,$data_v['ip_address'])
                ->setCellValue($device_standard.$j,$data_v['device_standard'])
                ->setCellValue($up_shelves_date.$j,$data_v['up_shelves_date'])
                ->setCellValue($down_shelves_date.$j,$data_v['down_shelves_date'])
                ->setCellValue($cabinet_name.$j,$data_v['cabinet_name'])
                ->setCellValue($device_config.$j,$data_v['device_config'])
                ->setCellValue($change_old_site.$j,$data_v['change_old_site'])
                ->setCellValue($change_new_site.$j,$data_v['change_new_site'])
                ->setCellValue($told_business_dept.$j,$data_v['told_business_dept'])
                ->setCellValue($real_name.$j,$data_v['real_name'])
                ->setCellValue($notes.$j,$data_v['notes']);
            $j++;
        }

        $this->export($spreadsheet);

    }


    public function recordExcelExportAll(){
        $spreadsheet = new Spreadsheet();//实例化Spreadsheet类
        $objSheet=$spreadsheet->getActiveSheet();

        $data=Loader::model('Record')->getNoteList();
//        print_r($data);


        $index=0;
        $recordTime=$this->getCells($index);
        $recordType=$this->getCells($index+1);
        $seriesNumber=$this->getCells($index+2);
        $machineName=$this->getCells($index+3);
        $machineFrom=$this->getCells($index+4);
        $machineDestination=$this->getCells($index+5);
        $trackingnumber=$this->getCells($index+6);
        $companyName=$this->getCells($index+7);
        $machineInfo=$this->getCells($index+8);
        $machineStandard=$this->getCells($index+9);
        $machineCount=$this->getCells($index+10);
        $toldBusinessDept=$this->getCells($index+11);
        $realname=$this->getCells($index+12);
        $notes=$this->getCells($index+13);

        $objSheet->setCellValue('A1','登记时间')
            ->setCellValue('B1','登记类型')
            ->setCellValue('C1','资产编号')
            ->setCellValue('D1','机器类型')
            ->setCellValue('E1','来源')
            ->setCellValue('F1','去向')
            ->setCellValue('G1','快递单号')
            ->setCellValue('H1','所属公司')
            ->setCellValue('I1','机器配置')
            ->setCellValue('J1','机器规格')
            ->setCellValue('K1','数量')
            ->setCellValue('L1','通知商务')
            ->setCellValue('M1','操作人')
            ->setCellValue('N1','备注');

        $j=2;
        foreach ($data as $data_k => $data_v){
            $objSheet->setCellValue($recordTime.$j,$data_v['recordTime'])
                ->setCellValue($recordType.$j,$data_v['recordType'])
                ->setCellValue($seriesNumber.$j,$data_v['seriesNumber'])
                ->setCellValue($machineName.$j,$data_v['machineName'])
                ->setCellValue($machineFrom.$j,$data_v['machineFrom'])
                ->setCellValue($machineDestination.$j,$data_v['machineDestination'])
                ->setCellValue($trackingnumber.$j,$data_v['trackingnumber'])
                ->setCellValue($companyName.$j,$data_v['companyName'])
                ->setCellValue($machineInfo.$j,$data_v['machineInfo'])
                ->setCellValue($machineStandard.$j,$data_v['machineStandard'])
                ->setCellValue($machineCount.$j,$data_v['machineCount'])
                ->setCellValue($toldBusinessDept.$j,$data_v['toldBusinessDept'])
                ->setCellValue($realname.$j,$data_v['realname'])
                ->setCellValue($notes.$j,$data_v['notes']);

            $j++;
        }

        $this->export($spreadsheet);
    }

    public function recordExcelExportByTime(){
        $spreadsheet = new Spreadsheet();//实例化Spreadsheet类
        $objSheet=$spreadsheet->getActiveSheet();

        $data=Loader::model('Record')->getNoteListByTime($_GET['starttime'],$_GET['endtime']);
//        print_r($data);


        $index=0;
        $recordTime=$this->getCells($index);
        $recordType=$this->getCells($index+1);
        $seriesNumber=$this->getCells($index+2);
        $machineName=$this->getCells($index+3);
        $machineFrom=$this->getCells($index+4);
        $machineDestination=$this->getCells($index+5);
        $trackingnumber=$this->getCells($index+6);
        $companyName=$this->getCells($index+7);
        $machineInfo=$this->getCells($index+8);
        $machineStandard=$this->getCells($index+9);
        $machineCount=$this->getCells($index+10);
        $toldBusinessDept=$this->getCells($index+11);
        $realname=$this->getCells($index+12);
        $notes=$this->getCells($index+13);

        $objSheet->setCellValue('A1','登记时间')
            ->setCellValue('B1','登记类型')
            ->setCellValue('C1','资产编号')
            ->setCellValue('D1','机器类型')
            ->setCellValue('E1','来源')
            ->setCellValue('F1','去向')
            ->setCellValue('G1','快递单号')
            ->setCellValue('H1','所属公司')
            ->setCellValue('I1','机器配置')
            ->setCellValue('J1','机器规格')
            ->setCellValue('K1','数量')
            ->setCellValue('L1','通知商务')
            ->setCellValue('M1','操作人')
            ->setCellValue('N1','备注');

        $j=2;
        foreach ($data as $data_k => $data_v){
            $objSheet->setCellValue($recordTime.$j,$data_v['recordTime'])
                ->setCellValue($recordType.$j,$data_v['recordType'])
                ->setCellValue($seriesNumber.$j,$data_v['seriesNumber'])
                ->setCellValue($machineName.$j,$data_v['machineName'])
                ->setCellValue($machineFrom.$j,$data_v['machineFrom'])
                ->setCellValue($machineDestination.$j,$data_v['machineDestination'])
                ->setCellValue($trackingnumber.$j,$data_v['trackingnumber'])
                ->setCellValue($companyName.$j,$data_v['companyName'])
                ->setCellValue($machineInfo.$j,$data_v['machineInfo'])
                ->setCellValue($machineStandard.$j,$data_v['machineStandard'])
                ->setCellValue($machineCount.$j,$data_v['machineCount'])
                ->setCellValue($toldBusinessDept.$j,$data_v['toldBusinessDept'])
                ->setCellValue($realname.$j,$data_v['realname'])
                ->setCellValue($notes.$j,$data_v['notes']);

            $j++;
        }

        $this->export($spreadsheet);

    }


    /**
     * 数据Excel输入
    **/
    public function import(){

    }
    /**
     * 根据下标获取单元格所在列的位置
     * 生成A-Z的一个序列
    **/
    public function getCells($index){
        $arr=range('A','Z');
        return $arr[$index];
    }
    /**
     * 设置浏览器输出方式
    **/
    public function Browser_export($type,$filename){
        if($type=='xls'){
            header('Content-Type: application/vnd.ms-excel');
        }else{
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        }
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
    }
    public function export($spreadsheet){
        //输出输出
        $type='Xlsx';
        $filename=date('Y-m-d',time()).".xlsx";
        $writer = IOFactory::createWriter($spreadsheet, $type);
        $this->Browser_export($type,$filename);
        $writer->save("php://output");
    }

}