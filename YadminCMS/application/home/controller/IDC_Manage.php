<?php
/**
 * Created by PhpStorm.
 * User: lsyjq
 * Date: 2017/11/25
 * Time: 10:40
 */

namespace app\home\controller;


//use think\Controller;
use think\Loader;
use think\Request;


class IDC_Manage extends HomeBase
{
    //获得IDC列表
    public function  getIdcList(){
        $idc = Loader::model('Idc');
        $idclist = $idc->getIDCList();
        return json($idclist);
    }
    //添加机房
    public function idcAdd(){
        //判断是否权限
        if(1){
            //判断是否是POST提交,且值不为空 //判断值是否是规定格式
            if (Request::instance()->isGet() && $_GET['idcname']!=''){
                $idc = Loader::model('Idc');
                $data['idc_name']=$_GET['idcname'];
                //检查机房是否存在
                $res=$idc->getIDC($data);
                if($res){
                    $result = ['status' => '0', 'massage' => '该机房已经存在'];
                    return json($result);
                }else{
                    $res = $idc->setIDC($data);
                    if ($res) {
                        $result = ['status' => '1', 'massage' => '添加成功'];
                        return json($result);
                    } else {
                        $result = ['status' => '0', 'massage' => '出错了，请刷新页面再次录入!'];
                        return json($result);
                    }
                }

            } else{

                $result = ['status' => '0', 'massage' => '标注*为必填，请填写相应内容'];
                return json($result);
            }
        }else{
            $result = ['status' => '0', 'massage' => '您的权限不够，请联系管理员'];
            return json($result);
        }
    }


    //获得机柜列表
    public function  getCabinetList(){
        $cab = Loader::model('Cabinet');
        $cablist = $cab->getCabinetList();
        return json($cablist);
    }
//    添加机柜
    public function cabinetAdd(){
        //判断是否权限
        if(1){
            //判断是否是POST提交,且值不为空
            if (Request::instance()->isGet() && $_GET['idcname']!='' && $_GET['cabinetname'] !='' ){
                if ($_GET['idcname']==0){
                    $result = ['status' => '0', 'massage' => '请先选择机房'];
                    return json($result);
                }else{
                    $cabinet = Loader::model('Cabinet');
                    $cabinetdata['cabinet_name']=$_GET['cabinetname'];
                    $cabinetdata['idcid']=$_GET['idcname'];
                    //检查机柜是否存在
                    $res=$cabinet->getCabinet($cabinetdata);
                    if($res){

                        $result = ['status' => '0', 'massage' => '该机柜已经存在'];
                        return json($result);
                    }else{
                        $res = $cabinet->saveCabinet($cabinetdata);
                        if ($res) {
                            $result = ['status' => '1', 'massage' => '添加成功'];
                            return json($result);
                        } else {
                            $result = ['status' => '0', 'massage' => '出错了，请刷新页面再次录入!'];
                            return json($result);
                        }
                    }
                }
            } else{
                //判断值是否是规定格式
                $result = ['status' => '0', 'massage' => '标注*为必填，请填写相应内容'];
                return json($result);
            }
        }else{
            $result = ['status' => '0', 'massage' => '您的权限不够，请联系管理员'];
            return json($result);
        }

    }
    //批量添加机柜
    public function cabinetBatchAdd(){
        $cabinet_name=null;
        $fcount=0;//记录添加失败次数
        $scount=0;//记录添加成功次数
        //判断是否权限
        if(1){
            //判断是否是POST提交,且值不为空
            if (Request::instance()->isGet() && $_GET['idcbatch'] !='' && $_GET['cabinet-name-start'] !='' && $_GET['cabinet-name-end'] !='' && $_GET['cabinet-count'] !=''){
                //$result = ['status' => '0', 'massage' => '执行到这了'];
                //return json($result);

                $idc = Loader::model('Idc');

                //获取选择的机房信息 ->机房缩写
                $idcid['id']=$_GET['idcbatch'];
                $idcInfo=$idc->getIDC($idcid);

                // 分解上述数据进行组合
                $start=$_GET['cabinet-name-start'];
                $end=$_GET['cabinet-name-end'];
                $length=$_GET['cabinet-count'];
                if (ord($start)<=ord($end)){
                    for($i=ord($start);$i<=ord($end);$i++){
                        for($j=1;$j<=$length;$j++){
                            //$cabinet_name=null;
                            $cabinet_name=$idcInfo[0]['abbreviation'].'-'.chr($i).sprintf("%02d",$j);
                            $cabinetdata['idcid']=$_GET['idcbatch'];
                            $cabinetdata['cabinet_name']=$cabinet_name;
                            //检查机柜是否重复
                            $res=Loader::model('Cabinet')->getCabinet($cabinetdata);
                            if($res){
                                $fcount++;
                                continue;

                            }
                            else{

                                $res = Loader::model('Cabinet')->saveCabinet($cabinetdata);
                                $scount++;
                               // continue;
                            }
                        }
                    }
                    $result = ['status' => '1', 'massage' =>'开始='. ord($start).'end='.ord($end).'F'.$fcount.'S'.$scount.'机柜名='.$cabinet_name];
                    return json($result);
//
//                    $result = ['status' => '1', 'massage' => '添加完成，共成功添加'.$scount.'条，共有'.$fcount.'条添加失败'.$cabinetdata['cabinet_name']];
//                    return json($result);
                }
                else{
                    $result = ['status' => '0', 'massage' => '机柜起始位置不能小于机柜结束位置（A最小,Z最大）'];
                    return json($result);
                }
            }
            else{
                //判断值是否是规定格式
                $result = ['status' => '0', 'massage' => '标注*为必选项，请选择'];
                return json($result);
            }
        }else{
            $result = ['status' => '0', 'massage' => '您的权限不够，请联系管理员'];
            return json($result);
        }

    }

    //机房机柜机位三级联动
    //机房
    public function ajaxReturnIDC(){}
    //机柜
    public function ajaxReturnCab(){}
    //机位
    public function ajaxReturnRac(){}
}