<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\AuUser;

    /**
     *  @version  v1
     *  @param    errCode   状态码
     *  @param    errMsg    状态信息
     *  @param    data      传递的数据
     *  @return   json
     */
class CommonController extends Controller
{
    const SUCCESS = 200;  // 上传成功
    const ERROR = 300;    // 上传失败

    public $enableCsrfValidation = false;
    public $layout = false;
    public static function generateSign($params,$key="") {
        echo 11111;

    }
            // 默认状态
    public $success = [
        'code' => 200,
        'msg'  => 'success',
        'data' => []
    ];


    public $error = [
        'code' => 0,
        'msg'  => 'error',
        'data' => []
    ];


    // public function data($token){
    //     $arr = $this->success['data']['token'] = $token; 
    //     return $arr;
    // }

    public function jsonss($arr){
        echo json_encode($arr);
    }

    /**
     * 生成秘钥
     * @param  [type] $userId [description]
     * @return [type]         [description]
     */
    public function createKey($userId){
        $auth= Yii::$app->params['auth'];
        // var_dump($auth);
        $date = time();
        $token_md5 = md5(md5($userId.$date));
        $tokens = $date.$token_md5;
        $salt = $auth['key'].$userId;
        // echo $salt;die;
        $token = Yii::$app->getSecurity()->encryptByPassword($tokens,$salt);
        return $token;
    }

    // 验证token
    public function yz_token($userId,$token){
         $auth= Yii::$app->params['auth'];
         $salt = $auth['key'].$userId;
         $token_jjj = Yii::$app->getSecurity()->decryptByPassword($token,$salt);
//var_dump($token_jjj);die;
         $date = substr($token_jjj,0,10);
         $tokenme=substr($token_jjj,10,32);
        
     if(time()-$date<$auth['timeout']){
         $token_md5=md5(md5($userId.$date));
         $tokens = $date.$token_md5;
         if($tokens==$tokenme){
            echo  0;
         }
     }else{
          return ['code' => 416,'msg'=>'认证失败'];
     }
        

    }

    
}
