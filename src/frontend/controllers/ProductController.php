<?php


namespace kodCommerce\frontend\controllers;


use kodCommerce\admin\models\ProductVariation;
use kodCommerce\assets\KodCommerceAsset;
use kodCommerce\frontend\base\CommerceBaseController;
use kodCommerce\frontend\models\KodCommerceProduct;

use kodCommerce\KodCommerceHooks;
use yii\db\ActiveRecord;
use yii\helpers\Html;
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
        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => $model->title,
                'content' => $this->renderPartial('iframe', ['url' => '/product/' . $model->slug . '?quickView=true']),
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"])
            ];

        } else {

            if (!\Yii::$app->request->getQueryParam('quickView')) {
                $this->registerWidgets();
            }
            $widgets = \Yii::$app->hooks->apply_filters(KodCommerceHooks::RENDER_PRODUCT_CONTENT, []);
            return $this->render('index', ['model' => $model,'widgets'=>$widgets]);
        }

    }

    protected function findModel($slug): ActiveRecord
    {
        $model = KodCommerceProduct::findOne(['slug' => $slug]);
        if ($model) {
            return $model;
        }
        throw new NotFoundHttpException("Product Not FOund");
    }
}
