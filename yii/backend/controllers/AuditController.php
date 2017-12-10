<?php
namespace backend\controllers;

use Yii;
use common\models\LoginForm;
use yii\web\Controller;
use backend\models\auditing;

/**
* 
*/
class AuditController extends Controller
{
	public $enableCsrfValidation = false;
	public function actionAuditing()
	{
		if(Yii::$app->request->post()){
	        $emp_id=Yii::$app->request->post('emp_id');
	        $token=Yii::$app->request->post('token');
	        if(empty($emp_id) || empty($token))
	        {
	        	$arr = array(
	        			'code' =>"400",
	        			'msg' =>"false",
	        			'data' =>"参数不能为空"
	        		);
	        	return json_encode($arr);
	        }
	        $real_token=md5(md5($emp_id)."315C");
	        if($token!==$real_token)
	        {
	        	$arr=array(
	                  'code' =>"404",
	        		  'msg' =>"令牌错误",
	        		  'data' =>"null"
	        		);
	        	return json_encode($arr);
	        }else{
	        	
	        	$obj = new auditing();
	        	echo $obj->sql();
	        }
		}
	}
}
    