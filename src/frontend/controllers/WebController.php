<?php


namespace kodCommerce\frontend\controllers;


use yii\helpers\FileHelper;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

class WebController extends Controller
{
    public function actionProductImageAsset(){
        return $this->actionMedia('@kodcommerce/widgets/clientAssets/assets/n_p.png');
    }

public function actionMedia($path){
    $path = \Yii::getAlias($path);
    if(is_file($path)){
        header('Content-Type: image/jpeg');
        header('Content-Length: ' . filesize($path));
        echo file_get_contents($path);
        return;
    }
   throw new NotFoundHttpException('Image not found');

}
}
