<?php
namespace backend\models;

use Yii; 
use yii\base\Model;

class Msg_sql extends Model{
    public function msg(){
            $emp_id = Yii::$app->request->post($data['emp_id']);
            $token = Yii::$app->request->post($data['token']);
            if(empty($emp_id)){
                $arr = array(
                        'code'=>403,
                        'msg'=>"error",
                        'data'=>"员工ID不为空"
                    );
                return json_encode($arr);
                exit;
            }
            if(empty($token)){
                $arr = array(
                        'code'=>404,
                        'msg'=>"error",
                        'data'=>"令牌不为空"
                    );
                return json_encode($arr);
                exit;
            }
            $real_token = md5(md5($emp_id)."315C");
            if($real_token !== $token){
                    $arr = array(
                        'code'=>407,
                        'msg'=>"error",
                        'data'=>"令牌非法"
                    );
                return json_encode($arr);
                exit;
            }else{
                $this->select("au_cars");
                // if($data['car_status'] == 1 ){

                // }
                
            }
    }
    public function check(){
                $carowner_id = Yii::$app->request->post('carowner_id');
                $token = Yii::$app->request->post('token');
                if (empty($carowner_id)) {
                    $data = array(
                        'code'=>404,
                        'msg'=>"error",
                        'data'=>"参数不完整"
                    );
                    echo json_encode($data);
                    exit;
                }

                $real_token = md5(md5($carowner_id)."315C");
                if($real_token !== $token){
                        $arr = array(
                            'code'=>407,
                            'msg'=>"error",
                            'data'=>"令牌非法"
                        );
                    echo json_encode($arr);
                    exit;
                }else{
                    $sql = "select owner_id,car_model,reserce_time,seller_name,phone,reserve_province,reserve_city,reserve_area,reserve_address,address,reserve_remark,assign_remark from au_car_owner";
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
    public function select($table_name){
         $sql = "select * from $table_name";
         return Yii::$app->db->createCommand($sql)->queryAll();
    }
    public function check_base_msg(){
         $emp_id = Yii::$app->request->post('emp_id');
                $token = Yii::$app->request->post('token');
                if (empty($emp_id)||empty($car_id)) {
                    $data = array(
                        'code'=>404,
                        'msg'=>"error",
                        'data'=>"参数不完整"
                    );
                    echo json_encode($data);
                    exit;
                }

                $real_token = md5(md5($carowner_id)."315C");
                if($real_token !== $token){
                        $arr = array(
                            'code'=>407,
                            'msg'=>"error",
                            'data'=>"令牌非法"
                        );
                    echo json_encode($arr);
                    exit;
                }else{
                    $sql = "select * from auditing";
                    $command = Yii::$app->db->createCommand($sql)->queryAll();
                    $arr = array(
                            'code'=>200,
                            'msg'=>"success",
                            'data'=>$command
                        );
                    echo json_encode($arr);
                    exit;
                }
        }
}
