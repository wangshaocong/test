<?php
namespace backend\models;

use Yii; 
use yii\base\Model;

class Auditingreturn extends Model{
	public function auditingreturn(){
		 	$emp_id = Yii::$app->request->post('emp_id');
		 	$token = Yii::$app->request->post('token');
            if(empty($emp_id)){
                $arr = array(
                        'code'=>403,
                        'msg'=>"error",
                        'data'=>"员工ID不为空"
                    );
                return json_encode($arr);
            }
            
            if(empty($token)){
                $arr = array(
                        'code'=>404,
                        'msg'=>"error",
                        'data'=>"令牌不为空"
                    );
                return json_encode($arr);
            }
            $real_token = base64_encode($emp_id);
            if($real_token !== $token){
                    $arr = array(
                        'code'=>407,
                        'msg'=>"error",
                        'data'=>"令牌非法"
                    );
                return json_encode($arr);
            }else{
            	// $sql = "select car_no,check_date,remark,car_model from au_cars as a join au_car_owner as b on a.car_id=b.car_id";
            	$sql = "select a.car_id,a.car_no,b.posttime,b.check_date,a.remark,b.car_model from au_cars as a join au_car_owner as b on a.car_id=b.car_id";
            	 $command = Yii::$app->db->createCommand($sql)->queryAll();
                    $arr = array(
                            'code'=>200,
                            'msg'=>"success",
                            'data'=>array('list'=>$command)
                        );
                    echo json_encode($arr);
                    exit;
                
            }
	}
}