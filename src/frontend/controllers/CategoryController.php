<?php


/**
 *
 *
 *
 * For Extending Left Sidebar
 * use kodCommerce\KodCommerceHooks;
 * use yii\bootstrap4\Alert;
 * use yii\helpers\ArrayHelper;
 *
 * \Yii::$app->hooks->add_filter(KodCommerceHooks::RENDER_CATEGORY_LEFT_WIDGETS, function ($data) {
 * return ArrayHelper::merge($data, [
 * ['class' => Alert::class,
 * 'data' => [
 * 'options' => [
 * 'class' => 'alert-info',
 * ],
 * 'body' => 'Say hello...',
 * ]
 * ],
 * ['class' => Alert::class,
 * 'data' => [
 * 'options' => [
 * 'class' => 'alert-danger',
 * ],
 * 'body' => 'Say hi...',
 * ]
 * ]
 * ]
 * );
 * }, 2);
 */

namespace kodCommerce\frontend\controllers;



use kodCommerce\frontend\base\CommerceBaseController;
use kodCommerce\frontend\models\KodCommerceCategory;
use kodCommerce\frontend\models\KodCommerceProduct;
use kodCommerce\KodCommerceHooks;
use kodcommerce\widgets\ProductImagesWidget;
use yii\bootstrap\Alert;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class CategoryController extends CommerceBaseController
{


    public function actionIndex($slug)
    {
        $model = $this->findModel($slug);
        $this->view->title = $model['name'];
        $this->registerBreadcrumb();
        $this->registerWidgets();

        $widgets_left = \Yii::$app->hooks->apply_filters(KodCommerceHooks::RENDER_CATEGORY_LEFT_WIDGETS, []);
        $widgets_top = \Yii::$app->hooks->apply_filters(KodCommerceHooks::RENDER_CATEGORY_TOP_WIDGETS, []);
        $widgets_bottom = \Yii::$app->hooks->apply_filters(KodCommerceHooks::RENDER_CATEGORY_BOTTOM_WIDGETS, []);
        return $this->render('index', ['dataProvider' => $this->prepareData($model),
            'widgets_left' => $widgets_left,
            'widgets_top'=>$widgets_top,
            'widgets_bottom'=>$widgets_bottom
        ]);
    }


    private function registerBreadcrumb()
    {
        $this->getView()->params['breadcrumbs'][] = ['label' => 'Category', 'url' => Url::toRoute(['/commerce/category'])];
        $this->getView()->params['breadcrumbs'][] = ['label' => $this->view->title];
    }

    private function prepareData($model)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => KodCommerceProduct::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        $dataProvider->query->andWhere(['tree_id' => $model['id']]);
        return $dataProvider;
    }


    protected function findModel($slug): array
    {
        $model = KodCommerceCategory::find()->select('id, name')->where(['name' => $slug])->asArray()->one();
        if ($model) {

            return $model;
        }
        throw new NotFoundHttpException("Category Not Found");
    }
}
