<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\report;
header("content-type:text/html;charset=utf8");
class ReportController extends Controller{
	public $enableCsrfValidation = false;
    public $layout = false;

    //调用接口
    public function actionUpreport(){
    	if(yii::$app->request->post()){
    	    $emp_id = yii::$app->request->post('emp_id');
    	    $token = yii::$app->request->post('token');
    	    $real_token = base64_encode($emp_id);
    	    if($token !== $real_token){
                $data = [
                    'code'=>'400',
                    'msg'=>'token不一致',
                    'data'=>null,
                ];
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }else{
                $param = yii::$app->request->post();
                $report = $param['report'];
                $arrReport = json_decode($report,true);
                $damage = json_decode($arrReport['damage_info'],true);
                $arr = [];
                foreach($damage as $key => $value){
                    foreach($value as $k => $v){
                        foreach($v as $ke => $val){
                        $arr[$key]['position'] = $value['position'];
                        $arr[$key]['visible_type'] = $val['visible_type'];
                        $arr[$key]['describe'] = $val['describe'];
                        $arr[$key]['urls'] = $val['url'];
                        }
                    }
                }
//                print_r($arr); die;
                $obj = new report();
                print_r($obj->ReportUpload($arr));
            }
    	}
    }

}