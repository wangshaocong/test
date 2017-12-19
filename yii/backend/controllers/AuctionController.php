<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\LoginForm;
use backend\models\AuUser;          //登录model
use backend\models\complete;        //已完成model
use backend\controllers\CommonController;
use backend\models\carmsg;

header("content-type:text/html;charset=utf8");
class AuctionController extends Controller{
	public $enableCsrfValidation = false;
    public $layout = false;
    /**
        登录接口
    */
    public function actionLogin()
    {
        if (Yii::$app->request->post()) {
            $username = Yii::$app->request->post('username');
            $password = Yii::$app->request->post('passwd');
            $res = yii::$app->db->createCommand("select * from `au_user` WHERE username = '$username' and password = '$password'")->queryOne();
            if (!empty($res)) {
                $token = base64_encode($res['user_id']);
                $data = [
                    'code' => 200,
                    'msg' => 'success',
                    'data' => [
                        'emp_id' => $res['user_id'],
                        'token' => $token,
                        'real_name' => $username
                    ],
                ];
                echo json_encode($data);
            } else {
                $data = [
                    "code" => 400,
                    "msg" => "error",
                    "data" =>null,
                ];
                return json_encode($data);
            }
        }else{
            return $this->render("login");
        }
    }
	/**
        已完成列表接口
    */
	public function actionComplete(){
		if(Yii::$app->request->post()){
			$data       = yii::$app->request->post();
			$where['car_type'] = $data['series_id'];
			$where['car_status'] = $data['car_status'];
			$where['starttime']  = $data['starttime'];
			$where['endtime']    = $data['endtime'];
			if(empty($data['emp_id']) || empty($data['token'])){
				$data = array(
					"code"=>401,
					"msg"=>"error",
					"data"=>"参数不完整"
				);
				return json_encode($data);
			}
			$token = base64_encode($data['emp_id']);
			if($token == $data['token']){
				$obj = new complete();
				$res = $obj->select($where);
				print_r($res); die;
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

	/**
        版本更新接口
    */
	public function actionVersionupdate() {
	    $data = [
        'code'=>200,
        'msg'=>"success",
        'data'=> [
            'name' => $res['name'],
            'version' => $res['version'],
            'link' => $res['link'],
            'message'=> $res['message']
        ]
    ];
        return json_encode($data);
        $sort = Yii::$app->request->post('sort');
        $driver = Yii::$app->request->post('driver');
        $version = Yii::$app->request->post('version');
        if (empty($sort)||empty($driver)||empty($version)) {
            $data = [
                'code'=>404,
                'msg'=>"error",
                'data'=>"参数不完整"
            ];
            return json_encode($data);
        } else {
            //匹配设备
            if($sort == '1' && $driver == '1'){
                $res = yii::$app->db->createCommand("SELECT * from au_version where sort = $sort and driver = $driver order by desc")->queryOne();
                //版本是否更新
                if($version == $res['version']){
                    $data = [
                        'code'=>200,
                        'msg'=>"success",
                        'data'=> [
                            'name' => $res['name'],
                            'version' => $res['version'],
                            'link' => $res['link'],
                            'message'=> $res['message']
                        ]
                    ];
                    return json_encode($data);
                } else {
                    $data = [
                        'code'=>200,
                        'msg'=>"success",
                        'data'=> [
                            'name' => $res['name'],
                            'version' => $res['version'],
                            'link' => $res['link'],
                            'message'=> $res['message']
                        ]
                    ];
                    return json_encode($data);
                }
            } else {
                $data = [
                    'code'=>404,
                    'msg'=>"error",
                    'data'=>"设备不匹配"
                ];
                return json_encode($data);
            }
        }
    }
    /**
     车辆信息接口
     */
    public function actionCarmsg(){
        if (Yii::$app->request->post()) {
            $emp_id     = Yii::$app->request->post('emp_id');
            $post_token = Yii::$app->request->post('token');
            $car_id     = Yii::$app->request->post('car_id');
            //判断非空
            if (empty($emp_id) || empty($post_token) || empty($car_id)) {
                $arr = array(
                        'code' => "403",
                        'msg'  => "error",
                        'data' => "数据输入不完整"
                    );
                echo json_encode($arr);die;
            }
            //此处做token加密
            $token = base64_encode($emp_id);
            if ($token == $post_token) {
                $obj = new carmsg();
                $res = $obj->content($car_id);
                echo json_encode($res);die;
            } else {
                $arr = array(
                        'code' => "402",
                        'msg' => "error",
                        'data' => "token不一致"
                    );
                echo json_encode($arr);die;
            }
        }
    }
} 
