<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

class ReportController extends Controller{
	public function actionUpreport(){
		return $this->render('index');
	}
}