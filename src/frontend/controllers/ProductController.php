<?php


namespace kodCommerce\frontend\controllers;


use kodCommerce\admin\models\PostAttributes;
use kodCommerce\admin\models\ProductVariation;
use kodCommerce\frontend\base\CommerceBaseController;
use kodCommerce\frontend\models\KodCommerceProduct;
use ronashdkl\kodCms\config\AppData;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\View;

class ProductController extends CommerceBaseController
{
    public function init()
    {
        parent::init();
        $this->enableCsrfValidation = false;
    }

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

    public function actionVariation($id)
    {
      //  $this->enableCsrfValidation = false;

        $data = \Yii::$app->request->bodyParams;
        ksort($data);

        $variations = ProductVariation::find()->joinWith('product')->where(['kodcommerce_product_variation.post_id'=>$id])->andFilterHaving(['like','kodcommerce_product_variation.variations',json_encode($data)])->one();
            if(!$variations){
                return null;
            }
        $attributes = $variations->getAttributes(['stock','sku']);
        //unset($attributes['variations']);
       // unset($attributes['post_id']);
        $attributes['price'] = $variations->product->price+$variations->price;
        $attributes['formattedPrice'] = \Yii::$app->formatter->asCurrency($attributes['price']);
       $attributes['title'] =$variations->product->title;
       $attributes['id'] =$variations->product->id;
        return $this->asJson($attributes);
}
protected function findModel($slug):ActiveRecord
{
    return KodCommerceProduct::findOne(['slug'=>$slug]);
}
}
