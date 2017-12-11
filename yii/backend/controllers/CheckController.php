<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\check;

class CheckController extends Controller{
    public $enableCsrfValidation = false;
    //待检测接口
     public function actionWaitcheck(){
        if(Yii::$app->request->post()){
            $data = Yii::$app->request->post();
            $obj = new Msg_sql();
            return $obj->check($data);
        }else{
            return $this->render('checkcar');
        }
    }
    //检测事变接口
    public function actionCheckfail(){
        if(Yii::$app->request->post()){
            $data = Yii::$app->request->post();
            $emp_id = $data['emp_id'];
            $post_token = $data['token'];
            // $md_id = md5($emp_id)."315c";
            // $token = md5($md_id);
            if(empty($emp_id)||empty($post_token)||empty($data['remark'])){
                $arr = array(
                    'code' => "403",
                    'msg' => "error",
                    'data' => "数据输入不完整"
                );
                echo json_encode($arr);die;
            }
            $token = "1"; 
            if($token == $post_token){
                $obj = new check();
                $res = $obj->update($data);
                echo json_encode($res);
            }else{
                $arr = array(
                    'code' => "0",
                    'msg' => "error",
                    'data' => "token不一致"
                );
                echo json_encode($arr);die;
            }
        }else{
            echo "404 NotFound";
        }
    }

    public function actionTest(){
        return $this->render('test');
    }
}