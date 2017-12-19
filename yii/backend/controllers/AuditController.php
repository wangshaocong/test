<?php
namespace backend\controllers;

use Yii;
use common\models\LoginForm;
use yii\web\Controller;
use backend\models\auditing;
use backend\models\Auditingreturn;
/**
* 
*/
class AuditController extends CommonController
{
	public $enableCsrfValidation = false;
	//审核驳回接口
	 public function actionAuditfail(){
            if(Yii::$app->request->post()){
                $data = Yii::$app->request->post();
                $obj = new Auditingreturn();
                return $obj->auditingreturn($data);
            }else{
                return $this->render('show_auditing');
            }
    }
    //审核中接口
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
	        $real_token=base64_encode($emp_id);
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
    