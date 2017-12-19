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
            }
            if(empty($token)){
                $arr = array(
                        'code'=>404,
                        'msg'=>"error",
                        'data'=>"令牌不为空"
                    );
                return json_encode($arr);
            }
            $real_token = 4;
            if($real_token !== $token){
                    $arr = array(
                        'code'=>407,
                        'msg'=>"error",
                        'data'=>"令牌非法"
                    );
                return json_encode($arr);
            }else{
                $this->select("au_cars");
            }
    }
    public function check(){
                $carowner_id = Yii::$app->request->post('emp_id');
                $token = Yii::$app->request->post('token');
                if (empty($carowner_id)) {
                    $data = array(
                        'code'=>404,
                        'msg'=>"error",
                        'data'=>"参数不完整"
                    );
                    echo json_encode($data);
                }
                $real_token = base64_encode($carowner_id);
                if($real_token !== $token){
                        $arr = array(
                            'code'=>407,
                            'msg'=>"error",
                            'data'=>"令牌非法"
                        );
                    echo json_encode($arr);
                }else{
                    $sql = "select owner_id,car_model,reserve_time,seller_name,phone,reserve_province,reserve_city,reserve_area,reserve_address,address,reserve_remark,assign_remark from au_car_owner";
                    $command = Yii::$app->db->createCommand($sql)->queryAll();
                    foreach($command as $key => $value){
                        $list[$key] = [
                            'owner_id'=>$value['owner_id'],
                            'model'=>$value['car_model'],
                            'reserve_time'=>$value['reserve_time'],
                            'seller_name'=>$value['seller_name'],
                            'phone'=>$value['phone'],
                            'reserve_province'=>$value['reserve_province'],
                            'reserve_city'=>$value['reserve_city'],
                            'reserve_area'=>$value['reserve_area'],
                            'reserve_address'=>$value['reserve_address'],
                            'address'=>$value['address'],
                            'reserve_remark'=>$value['reserve_remark'],
                            'assign_remark'=>$value['assign_remark'],
                        ];
                    }


                    $arr = array(
                            'code'=>200,
                            'msg'=>"success",
                            'data'=>array('list'=>$list),
                            'maxCount'=>'2',
                            'maxPage'=>'1',
                        );
                    echo json_encode($arr);
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
