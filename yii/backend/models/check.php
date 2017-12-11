<?php
namespace backend\models;

use yii;
use yii\base\Model;

class check extends Model{
    public function update($data){
        $own_id = $data['own_id'];
        $emp_id = $data['emp_id'];
        $type   = $data['type'];
        $remark = $data['remark'];
        $time   = time();
        $fail_time = date('Y-m-d H:i:s');
        $sql = "update au_car_owner set check_fail_type = $type,checker_id = $emp_id,remark_fail = $remark,updatetime = $time where owner_id = $own_id";
        //check_fail_type  线索表 checker_id 线索表 remark_fail 线索表 owner_id线索表
        $res = yii::$app->db->createCommand($sql)->execute();
        if ($res) {
            $arr = array(
                'code' => 200,
                'msg'  => "success"
            );
            return $arr;
        } else {
            $arr = array(
                'code' => 405,
                'msg'  => "error",
                'data' => "数据库修改状态失败"
            );
            return $arr;
        }
    }
}