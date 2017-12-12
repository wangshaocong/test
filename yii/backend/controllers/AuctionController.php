<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\LoginForm;
use backend\models\AuUser;          //登录model
use backend\models\complete;        //已完成model

header("content-type:text/html;charset=utf8");
class AuctionController extends CommonController{
	public $enableCsrfValidation = false;
    public $layout = false;
    /**
        登录接口
    */
    public function actionLogin(){
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');
        $db = new AuUser();
        $res = $db->find()->where("username='$username' and password='$password'")->one();
        // 登录成功生成token
        $userId = $res['user_id'];
        if($res){
            $res=$this->createKey($userId);
            $token = base64_encode($res);
            $this->success['data']['username'] = $username;
            $this->success['data']['password'] = $password;
            $this->success['data']['token'] = $token;
            return json_encode($this->success);  
        }else{
            $arr = $this->error;
            return json_encode($this->error);
        };
    }
	/**
        已完成列表接口
    */
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

	/**
        版本更新接口
    */
	public function actionVersionupdate() {
        // $rep = array('code' => 200);
        $emp_id = Yii::$app->request->post('emp_id',0);
        $sort_id = Yii::$app->request->post('sort',0);
        $driver = Yii::$app->request->post('driver',0);
        $version = Yii::$app->request->post('version');
        $token = Yii::$app->request->post('token','');
        if ($sort_id < 1 || $driver < 1 || $version == '') {
            $data = [
                'code'=>201,
                'msg'=>"error",
                    'data'=>"参数不完整"
                ];
            } else {
                $owner_token = '1';
                if($token !== $owner_token){
                     $data = [
                        'code'=>500,
                        'msg'=>"error",
                        'data'=>"token不正确"
                    ];
                }else{
                    $lastest = Yii::$app->db->createCommand("select * from `au_version` order by version  DESC limit 1")->queryOne();
                    if ($lastest) {
                        if ($version==$lastest['version'])
                        {
                            $data = [
                                'code'=>"200",
                                'msg'=>"success",
                                'data'=>array(
                                    'name'=>$lastest['name'],
                                    'version'=>$lastest['version'],
                                    'link'=>$lastest['link'],
                                    'message'=>$lastest['message']
                                )
                            ]; 
                        } 
                        else
                        {
                            $data = [
                                'code'=>405,
                                'msg'=>'没有相应的版本'
                            ];
                        }
                    }
                    // $obj = new version();
                    // $res = $obj->update();
            }
        }
        return json_encode($data);
    }   
    public function actionAdd()
    {
        return $this->render('version');
    }
    /**
     车辆信息接口
     */
} 
