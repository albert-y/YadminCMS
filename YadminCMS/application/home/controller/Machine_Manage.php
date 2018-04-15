<?php
/**
 * Created by PhpStorm.
 * User: lsyjq
 * Date: 2017/11/14
 * Time: 19:31
 */
namespace app\home\controller;

use think\Loader;
use think\Request;

class Machine_Manage extends HomeBase
{
    /************************************  Record ***************************************/
   //  获取记录表信息返回给前台
   public function machineNoteList(){
       $notes = Loader::model('Record');
       $noteslist = $notes->getNoteList();
       return json($noteslist);
   }
   //    硬件登记
   public function machineNotesAdd()
   {
       if (Request::instance()->isPost()) {

           if ($_POST['recordTime'] !='' && $_POST['recordType'] !='' &&
               $_POST['machineName'] !=''  &&
               $_POST['machineStandard'] !=''  &&
               $_POST['machineCount'] !='' && $_POST['toldBusinessDept'] !=''  &&
               $_POST['creatorid'] !=''  && $_POST['machineInfo'] !=''  &&
               $_POST['companyName'] !=''
           ) {
   //      问题1：数据表record中来源去向是两个字段，前段提交的数据是一个字段
   //      问题2：在不修改表单数据的情况下，ajax多次请求没有判断是否重复添加再次添加了数据，
               $record = Loader::model('Record');
            //   $data['record_date'] =$_POST['recordTime'];
               $data['record_date'] = date('Y-m-d', strtotime($_POST['recordTime']));
               $data['record_type'] = (int)$_POST['recordType'];
               $data['device_from'] = $_POST['machineFrom'];
               $data['device_destination'] = $_POST['machineDestination'];
               $data['device_name'] = $_POST['machineName'];
               $data['device_sn'] = $_POST['seriesNumber'];
               $data['company_id'] = $_POST['companyName'];
               $data['device_standard'] = $_POST['machineStandard'];
               $data['device_count'] = (int)$_POST['machineCount'];
               $data['told_business_dept'] = (int)$_POST['toldBusinessDept'];
               $data['editor_id'] = (int)$_POST['creatorid'];
               $data['device_config'] = $_POST['machineInfo'];
               $data['notes'] = $_POST['notes'];

              $res = $record->addMachineNote($data);

               if ($res) {
                   $result = ['message' => '添加成功!'];
                   return json($result);
               } else {
                   $result = ['message' => '出错了，请刷新页面再次录入!'];
                   return json($result);
               }

           } else {
               $result = ['status' => 0, 'message' => '标注*为必填，请填写相应内容'];
               return json($result);
           }
       } else {
           $result = ['static' => 0, 'message' => '服务器拒绝了您的请求!'];
           return json($result);
       }

   }

   public function machineNotesDeleteByTime()
   {

   }

   //    硬件表验证序列号是否存在 bootstrapValidate romote ajax提交 返回值true为没有重复通过 false重复不通过
   public function validateDeviceSN()
   {
       $record = Loader::model('Record');
       $data['device_sn'] = $_POST['seriesNumber'];
       $res = $record->getDeviceSN($data);
       if ($res) {
           $result = ['valid' => "false"];
           return json($result);
       } else {
           $result = ['valid' => "true"];
           return json($result);
       }

   }

   public function machineNotesEdit()
   {
       $ID['id']=$_POST['id'];

       if($_POST['recordType']=="迁入"){

           $data['record_type']=0;
       }elseif ($_POST['recordType']=="迁出"){

           $data['record_type']=1;

       }else{

           return $jsondata = ['message'=>"只能输入迁入或者迁出"];

       }
       if($_POST['toldBusinessDept']=="已通知"){
           $data['told_business_dept']=1;
       }elseif ($_POST['toldBusinessDept']=="未通知"){
           $data['told_business_dept']=0;
       }else{
           return $jsondata=['message'=>"只能输入已通知或者未通知"];
       }
       $data['device_sn']=$_POST['seriesNumber'];
       $data['device_from']=$_POST['machineFrom'];
       $data['device_destination']=$_POST['machineDestination'];
       $data['trackingnumber']=$_POST['trackingnumber'];
       $data['company_id']=$_POST['companyName'];
       $data['device_name']=$_POST['machineName'];
       $data['device_standard']=$_POST['machineStandard'];
       $data['device_count']=$_POST['machineCount'];
       $data['device_config']=$_POST['machineInfo'];
       $data['notes']=$_POST['notes'];

       $res=Loader::model("Record")->updateRecord($ID,$data);

       if($res){
           $jsondata=['message'=>"修改成功"];
       }else{
           $jsondata=['message'=>"修改失败"];
       }
       // $jsondata=['message'=>$a];
       return  json($jsondata);

   }

   public function machineNotesDelete(){
       //权限
       if(1){
           //验证form表单的合法性
           if(Request::instance()->isGet() && $_GET['mid'] != ''){
               $machine=Loader::model('Record');
               $mdata['id']=$_GET['mid'];
               $res=$machine->delNotes($mdata);
               if($res){
                   return json($data=['status'=>'1','message'=>'删除成功']);
               }else{
                   echo "model函数执行出错";
               }

           }else{
               return json($data=['status'=>'0','message'=>'您的请求不合法，请重试']);
           }
       }else{
           return json($data=['status'=>'0','message'=>'您的权限不够，请联系管理员']);
       }

   }

   public function machineNotesDetailed(){
        $rec=Loader::model('Record');
        $data['id'] = (int)$_POST['mid'];
//            $data['id'] = 4;
        $res=$rec->getRowByName($data);
//            dump($res[0]);die();
        return json($res[0]);
    }

/****************Machine**************** Machine ******************Machine****************/
    //验证资源编号是否重复
   public function validateMachineNumber()
    {

        $record = Loader::model('Machine');
        $data['asset_id'] = $_POST['asset_id'];
        $res = $record->getAssetSN($data);
        if ($res) {
            $result = ['valid' => "false"];
            return json($result);
        } else {
            $result = ['valid' => "true"];
            return json($result);
        }

    }
    //验证IP是否重复
   public function validateIP()
    {

        $record = Loader::model("Machine");
        $data['ip_address'] = $_POST['IP'];
        $res = $record->getIpAddress($data);
        if ($res) {
            $result = ['valid' => "false"];
            return json($result);
        } else {
            $result = ['valid' => "true"];
            return json($result);
        }

    }
    //机器上架
   public function machineUpShelves()
    {
         
        if (Request::instance()->isPost()) {
            // 检查字段是否为空

            if($_POST['update'] !=''
                && $_POST['machineFrom'] !=''
                && $_POST['companyName'] !=''
                && $_POST['machineType'] !=''
                && $_POST['asset_id'] !=''
                && $_POST['cabinet'] !=''
                && $_POST['IP'] !=''
                && $_POST['machineStandard'] !=''
                && $_POST['oldsite'] !=''
                && $_POST['newsite'] !=''
                && $_POST['toldBusinessDept'] !=''
                && $_POST['creatorid'] !=''
                && $_POST['machineInfo'] !=''
            ){
                //              问题1：数据表record中来源去向是两个字段，前段提交的数据是一个字段
//              问题2：在不修改表单数据的情况下，ajax多次请求没有判断是否重复添加再次添加了数据，
                $data['up_shelves_date'] = date('Y-m-d',strtotime($_POST['update']));
                $data['device_from'] = $_POST['machineFrom'];
                $data['company_id'] = $_POST['companyName'];
                $data['device_type'] = (int)$_POST['machineType'];//服务器等等
                $data['device_sn'] = $_POST['seriesNumber'];
                $data['asset_id'] = $_POST['asset_id'];
                $data['change_old_site'] = (int)$_POST['oldsite'];
                $data['change_new_site'] =(int) $_POST['newsite'];
                $data['cabinet_id'] = (int)$_POST['cabinet'];
//                $data['lattice'] = $_POST['rack'];
                $data['ip_address'] = $_POST['IP'];
                $data['device_standard'] = $_POST['machineStandard'];
                $data['told_business_dept'] = (int)$_POST['toldBusinessDept'];
                $data['editor_id'] = (int)$_POST['creatorid'];
                $data['device_config'] = $_POST['machineInfo'];
                $data['notes'] = $_POST['notes'];

                $data['device_state'] = 0;
                $data['operation_date'] = date('Y-m-d H:i:s', time());

                $machine = Loader::model('Machine');
                $res = $machine -> addUpShelves($data);
                if ($res) {
                    $result = ['message' => '添加成功!'];
                    return json($result);
                }
                else {
                    $result = ['message' => '出错了，请刷新页面再次录入!'];
                    return json($result);
                }
            }
            else {
                $result = ['status' => 0, 'message' => '标注*/为必填，请填写相应内容'];
                //$result = ['massage' => 'ok'];
                return json($result);
            }
        } else {
            $result = ['static' => 0, 'message' => '服务器拒绝了您的请求!'];
            return json($result);
        }

    }
    //所有设备表
   public function machineList(){
    $Machine = Loader::model('Machine');
      $machineListJson=$Machine->getMachineList();
        return json($machineListJson);
    }
    //设备删除
   public function machineDelete(){
        //权限
        if(1){
            //验证form表单的合法性
            if(Request::instance()->isGet() && $_GET['mid'] != ''){
                $machine=Loader::model('Machine');
                $mdata['id']=$_GET['mid'];
                $res=$machine->delMachine($mdata);
                if($res){
                    return json($data=['status'=>'1','message'=>'删除成功']);
                }else{
                    echo "model函数执行出错";
                }

            }else{
               return json($data=['status'=>'0','message'=>'您的请求不合法，请重试']);
            }
        }else{
            return json($data=['status'=>'0','message'=>'您的权限不够，请联系管理员']);
        }

    }
    //设备信息修改
   public function machineEdit(){

        $ID['id']=$_POST['id'];
        $data['asset_id']=$_POST['asset_id'];
        $data['device_sn']=$_POST['device_sn'];
        $data['device_config']=$_POST['device_config'];
        $data['ip_address']=$_POST['ip_address'];
        //做数据处理 $data['id']=$_POST['machine_type'];
        $dty=Loader::model('Devicetype');
        $cab=Loader::model('Cabinet');
        $mac=Loader::model('Machine');

        $macType['typename']=$_POST['device_type'];
        //$macType['typename']='交换机';
        $dtyid=$dty->getDeviceTypeID($macType);
        $data['device_type']=(int)$dtyid[0]['id'];


        //做数据处理 $data['id']=$_POST['machine_type'];
        $cabdata['cabinet_name']=$_POST['cabinet_name'];
        $cabID=$cab->getCabinetID($cabdata);
        $data['cabinet_id']=(int)$cabID[0]['id'];
        //$data['real_name']=$_POST['real_name'];
        $data['device_standard']=$_POST['device_standard'];
        $res=$mac->UpdateMachine($ID,$data);
        if($res){
            $jsondata=['message'=>"修改成功"];
        }else{
            $jsondata=['message'=>"修改失败"];
        }
        //$jsondata=['message'=>$a];
        return  json($jsondata);

    }
    //设备详情
   public function machineDetailed(){
        $mac=Loader::model('Machine');
        $data['id'] = (int)$_POST['mid'];
//        $data['id'] = 4;
        $res=$mac->getRowByName($data);
//        dump($res[0]);die();
        return json($res[0]);
    }

//修改上架设备表
//    public function upShelvesEdit()
//    {
//
//    }
//
////    删除上架设备表信息
//    public function upShelvesDelete()
//    {
//
//    }
//
////   上架信息表
//    public function upShelvesList()
//    {
//
//
//    }
   // 下架
   public function downShelves()
   {
       $ID['id']=$_POST['id'];
       $data['device_destination']=(int)$_POST['device_destination'];
       $data['down_shelves_date']=date("Y-m-s",time());
       $data['notes']=$_POST['notes'];
       $data['device_state']=1;
       $mac=Loader::model('Machine');
      // return json($json=['message'=>$_POST['notes']]);
       $res=$mac->updateMachine($ID,$data);
       if($res){
           return json($json=['message'=>'已完成下架记录']);
       }else{
           return json($json=['message'=>'修改下架记录失败']);
       }

   }

   public function addDeviceType(){
       if(Request::instance()->isGet() && $_POST['devicetype'] != ''){
           $data['typename']=$_POST['devicetype'];
           $DT=Loader::model('DeviceType');
           $res=$DT->addDeviceType($data);
           if($res){
               return json($jsondata=['message'=>'添加成功']);
           }else{
               return json($jsondata=['message'=>'添加失败']);
           }
       }else{
           return json($jsondata=['message'=>'提交的数据不合法']);
       }

   }


   //获取设备类型
   public function getDeviceType()
   {
       $dty=Loader::model('Devicetype');
       $dtyListJson=$dty->getDeviceTypeList();
       return json($dtyListJson);

   }
    //获取设备注
   public function getMachineNotes(){
        $mac=Loader::model('Machine');
        $data['id'] = (int)$_POST['mid'];
        $res=$mac->getMachineFieldValue($data);
        $json=['notes'=>$res[0]['notes']];
        return json($json);
    }


}