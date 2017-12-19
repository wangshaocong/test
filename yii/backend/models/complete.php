<?php
namespace backend\models;

use yii;
use yii\base\Model;

class complete extends Model{
	public function select($where){
		if(empty($where['car_type']) || empty($where['car_status']) || empty($where['starttime']) || empty($where['endtime'])){
			$sql = "select * from `au_cars`";
			$sql1 = "select b.`pic_url`,c.`check_date` from `au_cars` as a inner join `au_car_pictures` as b on a.car_id = b.pic_id inner join au_car_owner as c on a.car_id = c.owner_id";
			$res = yii::$app->db->createCommand($sql)->queryAll();
            $res1 = yii::$app->db->createCommand($sql1)->queryAll();
			foreach($res as $k => $v){
			    foreach($res1 as $key => $val){
			        $res[$k]['pic_url'] = $val['pic_url'];
			        $res[$k]['check_date'] = $val['check_date'];
                }
            }
		}else{
			$car_type = $where['car_type'];
			$car_status = $where['car_status'];
			$start_time = strtotime($where['starttime']);
			$end_time = strtotime($where['endtime']);
			$sql = "select * from `au_cars` where car_type= '$car_type' and car_status = '$car_status' and updatetime > '$start_time' and updatetime < '$end_time'";
			$sql1 = "select b.`pic_url`,c.`check_date` from `au_cars` as a 
                        inner join `au_car_pictures` as b on a.car_id = b.pic_id 
                        inner join au_car_owner as c on a.car_id = c.owner_id";
			$res = yii::$app->db->createCommand($sql)->queryAll();
			$res1 = yii::$app->db->createCommand($sql1)->queryAll();
            foreach($res as $k => $v){
                foreach($res1 as $key => $val){
                    $res[$k]['pic_url'] = $val['pic_url'];
                    $res[$k]['check_date'] = $val['check_date'];
                }
            }
		}
		if(!empty($res)){
				foreach($res as $key => $v){
					$type = $v['car_type'] == 1 ? '已导入' : '审核失败';
					$arr[$key] = array(
						"car_id"=>$v['car_id'],           //车辆id
						"model"=>$type,                     //车型
                        "car_no"=>$v['car_no'],
						"car_status"=>$v['car_status'],   
						"pic_url"=>$v['pic_url'],
						"check_date"=>$v['check_date'],
						"posttime"=>$v['modify_time']
					);
				}
				$data = array(
					"code"=>200,
					"msg"=>"success",
					"data"=>array('list'=>$arr)
				);
        }else{
				$data = array(
					"code"=>404,
					"msg"=>"error",
					"data"=>"查询失败"
				);
        }
        return json_encode($data);

	}
}