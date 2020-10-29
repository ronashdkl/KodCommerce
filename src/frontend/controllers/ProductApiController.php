<?php


namespace kodCommerce\frontend\controllers;


use kodCommerce\admin\models\ProductVariation;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ProductApiController extends Controller
{
    public function beforeAction($action)
    {
        \Yii::$app->request->parsers['application/json'] =  'yii\web\JsonParser';
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    public function actionIndex($id)
    {

        $data = \Yii::$app->request->post();

        ksort($data);

        $variations = ProductVariation::find()->joinWith('product')->where(['kodcommerce_product_variation.post_id'=>$id])->andFilterHaving(['like','kodcommerce_product_variation.variations',json_encode($data)])->one();

        if(!$variations){
            throw new NotFoundHttpException('Variation Not Found');
        }
        $attributes = $variations->getAttributes(['stock','sku']);
        //unset($attributes['variations']);
        // unset($attributes['post_id']);
       // $attributes['price'] =;
        $attributes['stock'] = $attributes['stock']!==0;
        $attributes['price'] = \Yii::$app->formatter->asCurrency( $variations->product->price+$variations->price);
        return $attributes;
    }

}
