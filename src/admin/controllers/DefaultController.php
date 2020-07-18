<?php
namespace kodCommerce\admin\controllers;

use yii\helpers\Html;
use yii\web\Controller;

class DefaultController extends Controller
{
public function actionIndex(){
   // \Yii::$app->kodCommerceSetting->set('ronash','Ronash Dhakal');
   return  $this->render('index');
}
public function actionMigration($type){


}
}