<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use  yii\web\Session;
class AuctionController extends Controller{
    public $enableCsrfValidation = false;
    public function actionLogin()
    {
//        $imei = Yii::$app->request->post('imei');
//        $token = '123452';
//        if($imei!=md5($token)){
//            $data=[
//                'code'=>"405",
//                'msg'=>"非法请求",
//                'time'=>time()
//            ];
//            echo json_encode($data);exit;
//        }
        if(Yii::$app->request->post()){
            $username = Yii::$app->request->post('username');
            $password = Yii::$app->request->post('passwd');
            if (empty($username)||empty($password)) {
                $data=[
                    'code'=>"404",
                    'msg'=>"参数不完整",
                    'time'=>time()
                ];
                return json_encode($data);
            }
            $sql="select * from au_user where `username`='$username' and `password`='$password'";
            $res = Yii::$app->db->createCommand($sql)->queryOne();
            if ($res)
            {
                $ress = Yii::$app->db->createCommand("UPDATE `au_user` SET  `login_time`='".date('Y-m-d H:i:s')."' WHERE (`user_id`='".$res['user_id']."')")->execute();
//                print_r($ress);die;
                $session = Yii::$app->session;
                $session->set('user_id', $res['user_id']);
                $data=[
                    'code'=>200,
                    'msg'=>'success',
                    'data'=>[
                        'empt_id'=>'xxxxx',
                        'token'=>md5(123456),
                        'real_name'=>'',
                    ],
                ];
                return json_encode($data);
            }else{
                $data=[
                    'code'=>"500",
                    'msg'=>"请求失败",
                    'data'=>[
                        'empt_id'=>'xxxxx',
                        'token'=>md5(123456),
                        'real_name'=>'',
                    ],
                ];
                return json_encode($data);
            }
        }
//        return $this->render('login');
    }
}