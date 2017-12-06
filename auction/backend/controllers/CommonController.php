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
    
}
