<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;




class UpgradeController extends Controller {
    /*
     * 检查APP更新接口
     * @param sort int 应用类型
     * @param driver int 应用设备
     * @param version int 版本号
     * return json
     * */
    public function actionIndex() {
        $rep = array('code' => 200);
        $sort_id = Yii::$app->request->post('sort', 0);
        $driver = Yii::$app->request->post('driver', 0);
        $version = Yii::$app->request->post('version', '');
        if ($sort_id < 1 || $driver < 1 || $version == '') {
            $rep['code'] = 405;
            $rep['msg'] = '参数不全或参数值不能为空';
        } else {
            $lastest = Yii::$app->db->createCommand("select * from ucar_upgrade order by version  DESC limit 1")->queryOne();
            if ($lastest) {
                if ($version>=$lastest['version']){
                    $rep['code'] = 201;
                    $rep['msg'] = '已是最新版';
                } else {
                    $rep['msg'] = 'SUCCESS';
                    $rep['data']['name'] = $lastest['name'];
                    $rep['data']['version'] = $lastest['version'];
                    $rep['data']['link'] = $lastest['link'];
                }
            } else {
                $rep['code'] = 406;
                $rep['msg'] = '没有相应的版本';
            }
        }
        echo json_encode($rep);
        exit;
    }

}
