<?php


namespace kodCommerce\frontend\controllers;


use kodCommerce\admin\models\ProductVariation;
use kodCommerce\frontend\base\CommerceBaseController;
use kodCommerce\frontend\models\KodCommerceProduct;

use yii\db\ActiveRecord;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;
use yii\web\Response;


class ProductController extends CommerceBaseController
{

    public function actionIndex($slug)
    {
        $model = $this->findModel($slug);
        $this->view->title = $model->title;
       // $this->getView()->params['breadcrumbs'][]=['label'=>'Product'];
        $this->registerWidgets();
//        $params = [
//            'template'=>'index',
//            'args'=>['model'=>$model]
//        ];
//        $view = \Yii::$app->hooks->apply_filters('kodcommerce_product_template',function ($params){
//            return
//        });
        return $this->render('index',['model'=>$model]);
}

protected function findModel($slug):ActiveRecord
{
    $model =  KodCommerceProduct::findOne(['slug'=>$slug]);
    if($model){
        return $model;
    }
    throw new NotFoundHttpException("Product Not FOund");
}
}
