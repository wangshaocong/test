<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use yii\web\Controller;

/**
* 
*/
class PortController extends Controller
{
	
	public function actionIndex(){
		return $this->render('index.html');
	}
}



?>