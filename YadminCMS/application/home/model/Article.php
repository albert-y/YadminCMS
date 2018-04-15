<?php
/**
 * Created by PhpStorm.
 * User: yuanjianqiu
 * Date: 2018/1/24
 * Time: 13:21
 */

namespace app\home\model;

use think\Model;
use think\Paginator;

class Article extends Model
{

    public function addArticle($data)
    {

        $article=new Article();
        return $article->save($data);

    }

    public function getArticlePage($data)
    {
        $sql="select a.id,title,operate_time AS operatetime,content,classify,real_name as operater from esin_article  as a LEFT JOIN esin_users as u ON  a.operate_person=u.id WHERE a.id=:id";

        $res=Article::query($sql,['id'=>$data['id']]);

        return $res;
    }
}