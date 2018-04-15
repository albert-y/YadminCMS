<?php
/**
 * Created by PhpStorm.
 * User: lsyjq
 * Date: 2018/1/22
 * Time: 23:14
 */

namespace app\home\model;


use think\Model;

class Asset extends Model{

    public function uploadFile($data){

        $res=Asset::save($data);

        return $res;
    }
    public function deleteFile($data){

        $res=Asset::save($data);

        return $res;
    }
    public function selectFile(){
//
//        $sql="select a.id,file_url as fileurl,file_name as filename,file_title as filetitle,file_postfix as postfix,classify,operate_time as uploadtime,real_name as operater from esin_asset as a LEFT JOIN esin_users as u ON  a.operate_person=u.id ORDER BY  operate_time DESC";
//
//        $res=Asset::query($sql);
//
//        return $res;
    }

}