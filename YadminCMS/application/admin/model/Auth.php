<?php
/**
 * Created by PhpStorm.
 * User: yuanjianqiu
 * Date: 2018/4/7
 * Time: 19:56
 */

namespace app\admin\model;


use think\Db;
use think\Model;

class Auth extends Model
{

    public function add(array $data){

       $insert="insert into esin_auth (auth_name,auth_pid,auth_c,auth_a)
       values('" .$data['auth_name']."','".$data['auth_pid']."','".$data['auth_c']."','".$data['auth_a']."')";

//        $insert="insert into esin_auth (auth_name,auth_pid,auth_c,auth_a)
//       values('权限管理','0','Auth','add')";

        Db::query($insert);

        $select = "select auth_id from esin_auth group by auth_id desc limit 1";

        $newId=Db::query($select)[0]['auth_id']; //返回值是一个包含auth_id的二维数组

//        return $newId;
        if($data['auth_pid']==0){
           //如果$data['auth_pid']==0 ，那么表示添加的属于1级，
            $auth_path=$newId;
            $auth_level=$data['auth_pid'];

            $upd="update esin_auth set auth_path = ".$auth_path.",auth_level = '".$auth_level."' where auth_id= '".$newId."'";

            return Db::execute($upd);



        }else{
            $p_path=$this->getParentPath($data['auth_pid']);

            $auth_path=$p_path.'-'.$newId;

            $auth_level=count(explode('-',$auth_path))-1;

            $upd="update esin_auth set auth_path = '".$auth_path."',auth_level = '".$auth_level."' where auth_id= '".$newId."'";


            return Db::execute($upd);
//
        }
    }
    public function selectAll(){
        $sql="select f.auth_id as id ,f.auth_name as a_name,s.auth_name as p_a_name,f.auth_pid as pid ,f.auth_c as controller ,f.auth_a as action,f.auth_path as path ,f.auth_level as level
              from esin_auth f left outer join esin_auth s
              on f.auth_pid = s.auth_id";

      return $this->query($sql);
    }
    public function delects(){

    }
    public function updates(){

    }


    /*
     * 查找父级的全路径
     * 返回父级的路径
     * */
    public function getParentPath($pid){

        $sql="select auth_path from esin_auth where auth_id =".$pid;

        $p_path=Db::query($sql);

        return $p_path[0]['auth_path'];
    }


    public function getFirstParentList(){

        $sql="select * from esin_auth where auth_pid = 0 ";

        $p_info=self::query($sql);

        return $p_info;
    }

    public function getChildrenList($pid){
       $sql="select * from esin_auth where auth_pid = ".$pid;

       $child_info=self::query($sql);

        return $child_info;
    }

}