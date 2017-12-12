<?php
namespace backend\controllers;

use Yii;
use common\models\LoginForm;
use yii\web\Controller;
//阿里云OSS执行
use common\components\Aliyunoss;
header('content-type:text/html;charset=utf-8');
/**
* 
*/
class UploadController extends CommonController
{
	public $enableCsrfValidation = false;
    public $layout = false;


    /**
     *  图片上传接口
     */

	public function actionImgupload(){
			$userId=yii::$app->request->post('emp_id');
			// echo $userId;die;
			$token=yii::$app->request->post('token');
			
			$tokens=base64_decode($token);

			$token_aaa=$this->yz_token($userId,$tokens);
			if($token_aaa){

				if(yii::$app->request->isPost){
					if(empty($_FILES['file']['name'])){
						$this->error['code'] = 'NOT FOUND';
						$this->error['msg'] = 'error';
						$nofind = 'FILE NOT FOUND';
						$this->error['code'] = '404';
						$this->error['msg'] = $nofind;
						$jsonInfo =  $this->error;
						//TODO: 日志
					}else{
						$path = './uploads/'.$_FILES['file']['name']; // 图片路径加名称
												
						if($path){
							//TODO:上传到oss
							$oss = Yii::$app->Aliyunoss->upload('upload/'.$_FILES['file']['name'],$path);
							// var_dump($oss);
							if($oss){
//							
								$this->success['data'] = $path;
								$jsonInfo = $this->success;
							}else{
								$this->error['code'] = '509';
								$this->error['msg'] = 'oss上传失败';
								$jsonInfo = $this->error;
								//TODO: 日志
							}
							
						}else{
							$this->error['code'] = '505';
							$fail = 'File upload failure';	// 文件上传失败
							$this->error['msg'] = $fail;
							$jsonInfo = $this->error;
							//TODO: 日志
						}
					}
				}
		}else{

			$this->error['code'] = '507';
			$this->error['msg'] = 'Token illegal'; // 令牌非法
			$jsonInfo = $this->error;
		}

		return $this->jsonss($jsonInfo);
	}


}



?>