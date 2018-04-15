<?php
/**
 * Created by PhpStorm.
 * User: lsyjq
 * Date: 2017/11/19
 * Time: 14:10
 */

namespace app\home\controller;

//use \think\Controller;

class GetUrl extends HomeBase
{
    public function home(){
        return view('Index/index');
    }
    //机器设备信息页面
    public function machine(){
    	return view('Machine/machine_list');
    }
    //机房设备进出登记添加页面
    public function machine_notes_add(){
    	return view('Machine/machine_notes_add');
    }
    //机房设备进出登记信息页面
    public function machine_notes_list(){
    	return view('Machine/machine_notes_list');
    }
    //设备上架页面
    public function machine_up_shelves(){
    	return view('Machine/machine_up_shelves');
    }
    //机房列表
    public function idc_list(){
        return view('IDC/idc_list');
    }
    //机柜页面
    public function cabinet(){
        return view('IDC/cabinet');
    }
    //服务器编辑
    public function machineEdit(){
        return view('Machine/machine_edit');
    }
    //服务器详情
    public function machineInfo(){
        return view('Machine/machine_info');
    }
    //添加设备类型
    public function addDeviceType(){
        return view('Machine/adddevicetype');
    }
    //设备类型页面
    public function deviceTypeList(){
        return view('Machine/devicetype_list');
    }
    //添加库存
    public function addStock(){
        return view('Stock/addstock');
    }

    //添加类型
    public function addModelNum(){
        return view('Stock/addModelNum');
    }
    //添加库存类型
    public function addStockType(){
        return view('Stock/addstocktype');
    }
    //库存查询
    public function StockList(){
        return view('Stock/stocknote');
    }
    //成品网线
    public function lineList(){
        return view('Stock/line');
    }
    //网络配件
    public function partsList(){
        return view('Stock/parts');
    }
    //快递信息
    public function expressList(){
        return view('Express/express');
    }

    //添加分享
    public function addAssetShare(){
        return view('Share/addassetshare');
    }
    //添加分享
    public function addArticleShare(){
        return view('Share/addarticleshare');
    }

}