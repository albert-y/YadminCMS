<?php
/**
 * Created by PhpStorm.
 * User: lsyjq
 * Date: 2018/1/22
 * Time: 23:13
 */

namespace app\home\controller;

//use think\Controller;
use think\Loader;
use think\Request;
use think\Db;
use think\File;


class Share extends HomeBase
{

    public function uploadFile(){
        $msg='';
        $file= request()->file('file');

        if($file && $_POST['filename'] !='' && $_POST['classify'] !=''){

            //validate()上传验证 1048576字节=1M 这里设置为100Mb move()保存位置
            $info=$file->validate(['size'=>1048576*1000,'ext'=>'pdf,doc,docx,ppt,pptx,xls,xlsx,zip,txt,7z,rar'])->move(ROOT_PATH.'public'.DS.'uploadfile');

            if($info){// 成功上传后 获取上传信息

                // 输出文件后缀
                $filepostfix= $info->getExtension();

                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                $fileurl= $info->getSaveName();

                // 输出 42a79759f284b767dfcb2a0197904287.jpg
                $filename=$info->getFilename();

                $data['file_url']=$fileurl;
                $data['file_name']=$filename;
                $data['file_postfix']=$filepostfix;
                $data['file_title']=$_POST['filename'];
                $data['classify']=$_POST['classify'];
                $data['operate_time']=date('Y-m-d H:i:s',time());
                $data['operate_person']=67;

                $res=Loader::model('Asset')->uploadFile($data);

                if($res){
                    $msg="上传成功";
                    return $this->fetch('Share/addassetshare',[
                        'msg'=>$msg
                    ]);
//                   $this->success('上传成功','GetUrl/addAssetShare');
                }else{
                    $msg="上传失败";
                    return $this->fetch('Share/addassetshare',[
                        'msg'=>$msg
                    ]);
                }
               // return json($msg=['status'=>1,'message'=>'success']);
            }else{
                // 上传失败获取错误信息
                $msg=$file->getError();
                return $this->fetch('Share/addassetshare',[
                    'msg'=>$msg
                ]);
            }

        }else{
            $msg="*标注不能为空";
            return view('Share/addassetshare',[
                'msg'=>$msg
            ]);

        }
    }

    public function selectServerFile(){
        $list=Db::table('esin_asset')
            ->alias('a')
            ->field('a.id,file_url as fileurl,file_name as filename,file_title as filetitle,file_postfix as postfix,classify,operate_time as uploadtime,real_name as operater')
            ->join('esin_users u','a.operate_person=u.id','left')
            ->where('classify','服务器')
            ->paginate(10);
        $count=Db::table('esin_asset')->where('classify','服务器')->count();
        return $this->fetch('serverfile',[
            'list'=>$list,
            'count'=>$count

        ]);
    }
    public function selectNetworkFile(){
        $list=Db::table('esin_asset')
            ->alias('a')
            ->field('a.id,file_url as fileurl,file_name as filename,file_title as filetitle,file_postfix as postfix,classify,operate_time as uploadtime,real_name as operater')
            ->join('esin_users u','a.operate_person=u.id','left')
            ->where('classify','网络')
            ->paginate(10);
        $count=Db::table('esin_asset')->where('classify','网络')->count();
        return $this->fetch('networkfile',[
            'list'=>$list,
            'count'=>$count

        ]);
    }
    public function selectOtherFile(){
        $list=Db::table('esin_asset')
            ->alias('a')
            ->field('a.id,file_url as fileurl,file_name as filename,file_title as filetitle,file_postfix as postfix,classify,operate_time as uploadtime,real_name as operater')
            ->join('esin_users u','a.operate_person=u.id','left')
            ->where('classify','其他')
            ->paginate(10);
        $count=Db::table('esin_asset') ->where('classify','其他')->count();
        return $this->fetch('otherfile',[
            'list'=>$list,
            'count'=>$count

        ]);
    }

    public function articleShare()
    {

        if (1) {
            if (Request::instance()->isPost() && $_POST['classify'] !="" && $_POST['title'] !="" && $_POST['content']!='') {

                $data['title']=$_POST['title'];
                $data['content']=$_POST['content'];
                $data['classify']=$_POST['classify'];
                $data['operate_time']=date('Y-m-d H:i:s',time());
                $data['operate_person']=67;

                if(Loader::model('Article')->addArticle($data)){
                    return json($msg = ['status' => 1, 'message' => '分享成功']);
                }else{
                    return json($msg = ['status' => 0, 'message' => '分享失败']);
                }
            }else{
                return json($msg = ['status' => 2, 'message' => '您的请求不合法']);
            }
        }else{
            return json($msg = ['status' => 3, 'message' => '您的权限不够，请联系管理员']);

        }

    }

    public function getServerArticleList(){
        $server=Db::table('esin_article')
            ->alias('a')
            ->field('a.id,title,operate_time AS operatetime,content,classify,real_name as operater')
            ->join('esin_users u','a.operate_person=u.id','left')
            ->where('classify','其他')
            ->paginate(10);
        $count=Db::table('esin_article') ->where('classify','其他')->count();
        return $this->fetch('serverarticleshare',[
            'server'=>$server,
            'count'=>$count

        ]);

    }
    public function getNetworkArticleList(){
        $network=Db::table('esin_article')
            ->alias('a')
            ->field('a.id,title,operate_time AS operatetime,content,classify,real_name as operater')
            ->join('esin_users u','a.operate_person=u.id','left')
            ->where('classify','网络')
            ->paginate(10);
        $count=Db::table('esin_article')->where('classify','网络')->count();
        return $this->fetch('networkarticleshare',[
            'network'=>$network,
            'count'=>$count
        ]);
    }
    public function getOtherArticleList(){
        $other=Db::table('esin_article')
            ->alias('a')
            ->field('a.id,title,operate_time AS operatetime,content,classify,real_name as operater')
            ->join('esin_users u','a.operate_person=u.id','left')
            ->where('classify','其他')
            ->paginate(10);
        $count=Db::table('esin_article')->where('classify','其他')->count();
        return $this->fetch('otherarticleshare',[
            'other'=>$other,
            'count'=>$count
        ]);

    }

    public function myArticleList(){
        $data=Db::table('esin_article')
            ->alias('a')
            ->field('a.id,title,operate_time AS operatetime,content,classify,real_name as operater')
            ->join('esin_users u','a.operate_person=u.id','left')
            ->where('operate_person',67) //条件需要修改
            ->paginate(10);

        $count=Db::table('esin_article')->where('operate_person',67)->count();

        return $this->fetch('myarticleshare',[
            'list'=>$data,
            'count'=>$count
        ]);
    }
    public function myAssetList(){
        $list=Db::table('esin_asset')
            ->alias('a')
            ->field('a.id,file_url as fileurl,file_name as filename,file_title as filetitle,file_postfix as postfix,classify,operate_time as uploadtime,real_name as operater')
            ->join('esin_users u','a.operate_person=u.id','left')
            ->where('operate_person',67) //条件需要修改
            ->paginate(10);

        $count=Db::table('esin_asset')->where('operate_person',67)->count();
        return $this->fetch('myassetshare',[
            'list'=>$list,
            'count'=>$count
        ]);
    }

    public function articlePage(){

        $id['id']=$_GET['id'];

        $data=Loader::model('Article')->getArticlePage($id);
        //dump($data);

        return $this->fetch('articlepage',['list'=>$data[0]]);

    }
}