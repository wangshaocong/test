<?php 
namespace backend\controllers;

use Yii;
use common\models\LoginForm;
use yii\web\Controller;
use common\commoncontroller\comm;
use backend\models\AuUser;

header('content-type:text/html;charset=utf-8');

/**
*  登录接口
*/
class LoginController extends CommonController
{

	public function actionLogin(){
		// 登陆接口
		$username = Yii::$app->request->post('username');
		$password = Yii::$app->request->post('password');
		// yii::$app->db;5
		$db = new AuUser();
		$res = $db->find()->where("username='$username' and password='$password'")->one();
		// 登录成功生成token
		$userId = $res['user_id'];

		if($res){
			$res=$this->createKey($userId);
			$token = base64_encode($res);
		// var_dump(base64_encode($res));die;

			$this->success['data']['username'] = $username;
			$this->success['data']['password'] = $password;
			$this->success['data']['token'] = $token;
        	return json_encode($this->success);  
        }else{
            $arr = $this->error;
            return json_encode($this->error);
        }

		// var_dump($arr);die;

	}

	// 调用页面 测试接口
	public function actionLtest(){
		if(yii::$app->request->isPost){
			// echo 222;die;
			$username = Yii::$app->request->post('username');
			$password = Yii::$app->request->post('password');
// 去请求接口
			 $ch=curl_init();
             curl_setopt_array($ch,[CURLOPT_URL=>"http://127.0.0.1/auction/backend/web/index.php?r=login/login",CURLOPT_POST=>true,CURLOPT_POSTFIELDS=>['username'=>$username,'password'=>$password],CURLOPT_RETURNTRANSFER=>true]);
            $res=curl_exec($ch);

            return $res;
            // var_dump(curl_error($ch));die;
            curl_close($ch);


		}else{
			return $this->render('ltest.html');
		}
	}

	// 生成秘钥

}

 ?>