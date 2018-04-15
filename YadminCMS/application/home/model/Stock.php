<?php
/**
 * Created by PhpStorm.
 * User: lsyjq
 * Date: 2018/1/6
 * Time: 18:00
 */

namespace app\home\model;

use think\Db;
use think\Model;
class Stock extends Model
{
    public function addStock($data){
        $stock=new Stock();
        $res=$stock->save($data);
        return $res;
    }
    public function delStock($data){
        $stock=new Stock();
        $res=$stock->where($data)->delete();
        return $res;
    }
    public function stockList(){
        $sql="SELECT s.id,operate_time AS operatetime,typename,goods_count AS counts,goods_company AS company ,
        goods_useaddr AS useaddr ,goods_usedevice AS usedevice ,goods_linelength AS linelength ,real_name AS  realname, notes 
        FROM esin_stock AS s 
        LEFT JOIN esin_users AS u ON s.editor_id=u.id  
        LEFT JOIN esin_stocktype AS st ON s.goods_type=st.id ORDER BY operatetime DESC ";
        $result=Stock::query($sql);
        return $result;
    }
    public function editStock($id,$data){
        $res=Stock::where($id)->update($data);
        return $res;
    }
    public function classifyList($data){
        $sql="SELECT s.id,operate_time AS operatetime,typename,goods_count AS counts,goods_company AS company ,
        goods_useaddr AS useaddr ,goods_usedevice AS usedevice ,goods_linelength AS linelength ,real_name AS  realname, notes 
        FROM esin_stock AS s 
        LEFT JOIN esin_users AS u ON s.editor_id=u.id  
        LEFT JOIN esin_stocktype AS st ON s.goods_type=st.id where st.parent_id in (select st.id FROM esin_stocktype as st WHERE parent_id=:pid)";
        $result=Stock::query($sql,['pid'=>$data['pid']]);
        return $result;
    }

    public function getRowByName($data){
        $sql="SELECT operate_time AS '时间',typename AS '类型',goods_count AS '数量',goods_company AS '公司' ,
        goods_useaddr AS '所用位置' ,goods_usedevice AS '所用设备' ,goods_linelength AS '长度' ,real_name AS  '操作人', notes AS '备注'
        FROM esin_stock AS s 
        LEFT JOIN esin_users AS u ON s.editor_id=u.id  
        LEFT JOIN esin_stocktype AS st ON s.goods_type=st.id where s.id=:id";
        $result=Stock::query($sql,['id' => $data['id']]);
        return $result;
    }
    public function stockListByTime($start,$end){
        $sql="SELECT s.id,operate_time AS operatetime,typename,goods_count AS counts,goods_company AS company ,
        goods_useaddr AS useaddr ,goods_usedevice AS usedevice ,goods_linelength AS linelength ,real_name AS  realname, notes 
        FROM esin_stock AS s 
        LEFT JOIN esin_users AS u ON s.editor_id=u.id  
        LEFT JOIN esin_stocktype AS st ON s.goods_type=st.id WHERE operate_time BETWEEN '".$start."' and '".$end."' ORDER BY operatetime DESC ";
        $result=Stock::query($sql);
        return $result;
    }
}