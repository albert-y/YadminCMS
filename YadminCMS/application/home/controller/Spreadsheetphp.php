<?php
/**
 * Created by PhpStorm.
 * User: yuanjianqiu
 * Date: 2018/1/30
 * Time: 0:17
 */

namespace app\home\controller;

//use think\Controller;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use think\Db;


class Spreadsheetphp extends HomeBase
{
    //    public function export(){
//
//        $spreadsheet = new Spreadsheet();//实例化Spreadsheet类
//        $objSheet=$spreadsheet->getActiveSheet();
//
//        $objUser=Loader::model('Users');
//        $data=$objUser->select();
//
////        print_r($data);
////        exit();
//        //填充数据
//        $index=0;
//        $index_name=$this->getCells($index);
//        $index_real=$this->getCells($index+1);
//        $index_passwd=$this->getCells($index+1);
//        $objSheet->setCellValue('A1','姓名')->setCellValue('B1','密码');
//        $j=2;
//        foreach ($data as $data_k => $data_v){
//                $objSheet->setCellValue($index_name.$j,$data_v['real_name'])->setCellValue($index_passwd.$j,$data_v['user_password']);
//                $j++;
//        }
////        $objSheet->setCellValue('A1', '这是第1行第1列');
////        $objSheet->setCellValue('B1', '这是第1行第2列');
////        foreach ($title as $title_k=>$title_v){
////            foreach ($data as $data_k=>$data_v){
////
////            }
////        }
//
//        //输出输出
//        $type='Xlsx';
//        $filename=date('Y-m-d',time()).".xlsx";
//        $writer = IOFactory::createWriter($spreadsheet, $type);
//        $this->Browser_export($type,$filename);
//        $writer->save("php://output");
//
//    }
    public function index(){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        //取数据
        $sql='select *  from esin_idc ';
        $data=Db::query($sql);

        $sql2='select count(*) FROM esin_idc';
        $sql3="select count(*) FROM information_schema.columns where  TABLE_NAME ='esin_idc'";

        $count=Db::query($sql2)[0]['count(*)'];
        $column=Db::query($sql3)[0]['count(*)'];
        dump($data);
        dump($count);
        dump($column);
        foreach ($data as $key=>$value){
            for ($i=0;$i<$count;++$i){
                $data2[$i][$i]=$value['id'];
                $data2[$i][++$i]=$value['idc_name'];
                $data2[$i][++$i]=$value['abbreviation'];
            }



//
//                $value[0] = $value['id'];
//                $value[1] = $value['idc_name'];
//                $value[2] = $value['abbreviation'];

        }
     //   dump($value);

        dump($data2);

        for($i=0;$i<27;++$i){
            for ($j=1;$j<=$count;++$j){
                if($i>25){
                    echo '<br>';
                    $n=65;
                    for ($l=0;$l<=25;++$l){
                        for($k=0;$k<=25;++$k){
                            $col=chr($l+$n).chr($n+$k).$j;
                            echo $col;
                        }
                        echo '<br>';
                    }
//                   $str= $this->aa();
                }else{
                    $col=chr($i+65).$j;
                   // $sheet->setCellValue($col, 'dasd');
                    echo $col;
                }

            }
        }
        $sheet->setCellValue('A1', '这是第1行第1列');
        $sheet->setCellValue('B1', '这是第1行第2列');
        $writer = new Xlsx($spreadsheet);
        $writer->save('/PHPEnv/www/EsinDevops/data/Spreadsheet.xlsx');



//        $sheet->setCellValue('A1', 'Hello World !');
//        $sheet->setCellValue('A2', 'H!');
//        $sheet->setCellValue('A3', 'H3!');
//
//        $sheet->setCellValue('B1', 'Hello  !');
//        $sheet->setCellValue('A1', 'Hello World !');
//
//        $writer = new Xlsx($spreadsheet);
//        $writer->save('/PHPEnv/www/EsinDevops/data/Spreadsheet.xlsx');
//
//        $inputFileName='/PHPEnv/www/EsinDevops/data/Spreadsheet.xlsx';
//
//        $reFilename='/PHPEnv/www/EsinDevops/data/'.date('YmdHis',time()).'.xlsx';
//        rename($inputFileName,$reFilename);
//        $name=substr($reFilename,-14);
//        $this->fetch('index',['FileName'=>$name,'download'=>$reFilename]);
//
//        //unlink($reFilename);
//        return view('index');


    }
    public function bb(){


        $sql='select *  from esin_idc ';
        $data=Db::query($sql);



    }
    public function aa(){
        $n=65;
        for ($l=0;$l<=25;++$l){
            for($k=0;$k<=25;++$k){
                $col=chr($l+$n).chr($n+$k);
               return $col;
            }
            echo '<br>';
        }
    }
    public function downloadFile(){



    }
    public function readFile(){



    }
    public function createtable($list,$filename){

    }


}