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
             //默认状态
    public $success = [
        'code' => 200,
        'msg'  => 'success',
        'data' => null
    ];


    public $error = [
        'code' => 0,
        'msg'  => 'error',
        'data' => null
    ];


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
        // echo $token;die;
         $auth= Yii::$app->params['auth'];
         $salt = $auth['key'].$userId;
          // var_dump($salt);die;
         $token_jjj = Yii::$app->getSecurity()->decryptByPassword($token,$salt);
        // var_dump(base64_encode($token_jjj));die;
         $date = substr($token_jjj,0,10);   // 截取前面时间戳
         $tokenme=substr($token_jjj,10,32); // 截取后面token
        
     if(time()-$date<$auth['timeout']){     // 当当前时间-登录时间戳 < 设置秘钥有效期 秒 则生成token
         $token_md5=md5(md5($userId.$date));
         // var_dump($token_md5);
         $tokens = $date.$token_md5;
         // var_dump($tokens);
         // var_dump($tokenme);die;
         if($token_md5 == $tokenme){
                return true;
         }else{
            return false;
         }

     }else{
          return false;
     }
        

    }

    
}
