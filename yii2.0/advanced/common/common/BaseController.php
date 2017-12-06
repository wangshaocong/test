<?php
namespace common\common;

use Yii;
use yii\web\Controller;

header("content-type:text/html;charset=utf-8");
class BaseController extends Controller
{
    public $enableCsrfValidation = false;
    public function get()
    {
        return Yii::$app->request->get();
    }

    public function post()
    {
        return Yii::$app->request->post();
    }

    public function isGet ()
    {
        return Yii::$app->request->isGet();
    }

    public function isPost ()
    {
        return Yii::$app->request->isPost();
    }
    //文件上传
    // public static function upload($filed){
    //        $file = array();
    //        if(!is_array($_FILES[$filed]['name'])){
    //            $file[] = $_FILES[$filed];
    //        }else{
    //            foreach($_FILES[$filed]['name'] as $k=>$v){
    //                $file[] = array(
    //                    'name'=>$v,
    //                    'type'=>$_FILES[$filed]['type'][$k],
    //                    'tmp_name'=>$_FILES[$filed]['tmp_name'][$k]
    //                );
    //            }
    //        }
    //        $nameinfo = array();
    //        foreach($file as $k=>$v){

    //            //分割后缀名
    //            $type = explode('/',$v['type']);

    //            //文件名
    //            $name = date('Ymd').rand(11111,99999).'.'.$type[1];
    //            $new_name = "/upload".'/'.$name;
    //            $nameinfo[] = $new_name;

    //            move_uploaded_file($v['tmp_name'],".".$new_name);
    //        }

    //        if(count($nameinfo)>1){
    //            return $nameinfo;
    //        }else{
    //            return $nameinfo[0];
    //        }
    //    }
}