<?php
namespace backend\controllers;

use Yii;
use common\models\LoginForm;
use yii\web\Controller;

/**
* 
*/
class PortController extends CommonController
{
	public $enableCsrfValidation = false;
    public $layout = false;
	
    // 状态码说明	//已放入继承控制器
    // const SUCCESS = 200;  // 上传成功
    // const NOTFOUNT = 320; // 未上传文件
    // const TYPE = 321;     // 类型错误
    // const ERROR = 322;    // 上传失败


    /**
     *  图片上传接口
     */

	public function actionIndex(){
		if(yii::$app->request->isPost){
			if(empty($_FILES['file']['name'])){
				$this->success['code'] = self::notfount;
				$this->success['msg'] = 'error';
				$this->success['data']['msg'] = 'FILE NOT FOUND';
				return $this->jsonss($this->success); // return是上面的状态方法
			}else{
				$path = './uploads/'.$_FILES['file']['name']; // 图片路径加名称
				// echo $MD5path;die;
				// var_dump($path);
				$res = move_uploaded_file($_FILES['file']['tmp_name'], $path); // 将上传文件移动到指定位置
				// var_dump($res);
				if($res){
					// 令牌 md5加密
					$time = time();
					$MD5path = md5($path.$time);
					$this->success['data']['msg'] = $MD5path;
					return $this->jsonss($this->success);
				}else{
					// $this->success['code'] = $this->error;
					// $this->success['msg'] = 'error';
					$this->error['data']['msg'] = [];
					return $this->jsonss($this->error);
				}
			}
		}else{
			return $this->render('index.html');
		}
	}

	/**
	 *  上传报告接口
	 */

	public function actionReport(){
		return $this->render();
	}

}



?>