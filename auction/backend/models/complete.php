<?php
namespace backend\models;

use yii;
use yii\base\Model;

class complete extends Model{
	public function select($where){
		if(empty($where['car_type']) && empty($where['car_status']) && empty($where['starttime']) && empty($where['endtime'])){
			$sql = "select * from `au_cars`";
			$res = yii::$app->db->createCommand($sql)->queryAll();
		}else{
			$car_type = $where['car_type'];
			$car_status = $where['car_status'];
			$start_time = strtotime($where['starttime']);
			$end_time = strtotime($where['endtime']);
			$sql = "select * from `au_cars` where car_type= '$car_type' and car_status = '$car_status' and upload_time > '$start_time' and upload_time < '$end_time'";
			$res = yii::$app->db->createCommand($sql)->queryAll();
		}
		if($res){
			// return $res;
				foreach($res as $key => $v){
					$type = $v['car_type'] == 1 ? '已导入' : '审核失败';
					$list[$key] = array(
						"car_id"=>$v['m'],           //车辆id
						"car_no"=>$v['car_source'],       //车原编号
						"model"=>$type,                     //车型
						"car_status"=>$v['car_status'],   
						"pic_url"=>$v['car_img'],
						"check_date"=>$v['check_time'],
						"posttime"=>$v['upload_time']
					);
				}
				// $arr['list'] = $list;
				$data = array(
					"code"=>200,
					"msg"=>"success",
					"data"=>array('list'=>$list)
				);
				return json_encode($data);
			}else{
				$data = array(
					"code"=>404,
					"msg"=>"error",
					"data"=>"查询失败"
				);
				return json_encode($data);
			}
	}
}