<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\complete;
header("content-type:text/html;charset=utf8");
class AuctionController extends Controller{
	public $enableCsrfValidation = false;
    public $layout = false;
	//已完成列表
	public function actionComplete(){
		if(yii::$app->request->isPost){
			$data       = yii::$app->request->post();
			$emp_id     = $data['emp_id'];
			$postToken      = $data['token'];
			$where['car_type'] = $data['series_id'];
			$where['car_status'] = $data['car_status'];
			$where['starttime']  = $data['starttime'];
			$where['endtime']    = $data['endtime'];
			if(empty($emp_id) || empty($postToken)){
				$data = array(
					"code"=>401,
					"msg"=>"error",
					"data"=>"参数不完整"
				);
				return json_encode($data);
			}
			$token = "wangshaocong";
			if($token == $postToken){
				$obj = new complete();
				$res = $obj->select($where);
				echo $res;
			}else{
				$data = array(
					"code"=>405,
					"msg"=>"error",
					"data"=>"非法请求"
				);
			return json_encode($data);
			}
		}else{
			$data = array(
					"code"=>406,
					"msg"=>"error",
					"data"=>"请求方式不正确"
				);
			return json_encode($data);
		}
	}

	public function actionComplete1(){
		return $this->render('index');
	}
} 
