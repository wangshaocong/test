<?php
namespace backend\models;

use yii;
use yii\base\Model;

class auditing extends Model{
	public function sql(){
		$sql="select a.`car_id`,`car_no`,`car_model`,`check_date` from `au_car_owner` as a inner join `au_cars` as b on a.car_id = b.car_id";
    	$res=Yii::$app->db->createCommand($sql)->queryAll();
    	foreach($res as $key => $v){
    		$list[] = array(
				"car_id"=>$v['car_id'], //au_car_owner
				"car_no"=>$v['car_no'], //au_cars
				"model"=>$v['car_model'], //au_car_owner
				"check_date"=>$v['check_date'] //au_car_owner
    		);
    	}
    	$arr=array(
              	'code' =>"200",
    			'msg' =>"success",
    			'data' => array('list'=>$list),
    		);
    	return json_encode($arr);
	}
}