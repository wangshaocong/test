<?php
namespace backend\controllers;

use Yii;
use common\models\LoginForm;
use yii\web\Controller;
//阿里云OSS执行
use common\components\Aliyunoss;
header('content-type:text/html;charset=utf-8');
/**
 *
 */
class UploadController extends CommonController
{
    public $enableCsrfValidation = false;
    public $layout = false;


    /**
     *  图片上传接口
     */

    public function actionImgupload(){
        $rep = array('code'=>200);
        $img = $_FILES['pic'];
        // var_dump($img);die;
        $name = $img['name'];
        // var_dump($name);die;
        $data = Yii::$app->request->post();
        // var_dump($data);die;
        if(!empty($data['emp_id']))
        {
            if(!empty($data['token']))
            {
                if(empty($img['name']))
                {
                    $rep['code'] = 404;
                    $rep['msg'] = "请选择图片!";
                }

            }
            else
            {
                $rep['code'] = 404;
                $rep['msg'] = "令牌不能为空!";
            }
        }
        else
        {
            $rep['code'] = 404;
            $rep['msg'] = "员工ID不能为空!";
        }

        //定义允许上传的类型
        $allow_type = array('jpg','jpeg','gif','png');
        //得到文件类型，并且都转化成小写
        $type = strtolower(substr($name,strrpos($name,'.')+1));
        // var_dump($images);
        if(!in_array($type, $allow_type))
        {
            //如果不被允许，则直接停止程序运行
            $rep['code'] = 404;
            $rep['msg'] = "文件类型不允许!";
        }
        //判断是否是通过HTTP POST上传的
        if(!is_uploaded_file($img['tmp_name'])){
            //如果不是通过HTTP POST上传的
            $rep['code'] = 404;
            $rep['msg'] = "文件上传方法错误!";
        }
        $upload_path = $img['tmp_name'];//上传文件的存放路径
        // print_r($upload_path);die;
        //开始移动文件到相应的文件夹
        $obj = new Aliyunoss();
        $res = $obj->upload($name,$upload_path);//$name是文件名(改成唯一的);$upload_path是路径
        // print_r($res);die;
        if($res){
//            $rep['code'] = 200;
//            $rep['msg'] = "success";
//            $rep['data'] = $res;
            $data = [
                'code'=>'200',
                'msg'=>'success',
                'data'=>$res,
            ];
            echo json_encode($data);
        }else{
            $data = [
                'code'=>'404',
                'msg'=>'error',
                'data'=>null,
            ];
            echo json_encode($data);
//            $rep['code'] = 404;
//            $rep['msg'] = "上传失败!";
        }


//        var_dump($rep);
//        exit;

    }


}



?>