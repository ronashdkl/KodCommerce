<?php


/**
 *
 *
 *
 * For Extending Left Sidebar
 * use kodCommerce\KodCommerceHooks;
 * use yii\bootstrap4\Alert;
 * use yii\helpers\ArrayHelper;
 */

namespace kodCommerce\frontend\controllers;


use kodCommerce\frontend\base\CommerceBaseController;
use kodCommerce\frontend\models\KodCommerceCategory;

use kodCommerce\frontend\models\KodCommerceProductSearch;
use kodCommerce\KodCommerceHooks;

use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class CategoryController extends CommerceBaseController
{

    public function actionIndex($slug = null)
    {

        $model = $this->findModel($slug);
        $this->view->title = $model['name'];
        $this->registerBreadcrumb();
        $data = $this->prepareData($model);
        $this->registerWidgets();

        $widgets_left = \Yii::$app->hooks->apply_filters(KodCommerceHooks::RENDER_CATEGORY_LEFT_WIDGETS, []);
        $widgets_top = \Yii::$app->hooks->apply_filters(KodCommerceHooks::RENDER_CATEGORY_TOP_WIDGETS, []);
        $widgets_bottom = \Yii::$app->hooks->apply_filters(KodCommerceHooks::RENDER_CATEGORY_BOTTOM_WIDGETS, []);
        return $this->render('index', [
            'searchModel' => $data[0],
            'dataProvider' => $data[1],
            'widgets_left' => $widgets_left,
            'widgets_top' => $widgets_top,
            'widgets_bottom' => $widgets_bottom,

        ]);


    }


    private function registerBreadcrumb()
    {
        $this->getView()->params['breadcrumbs'][] = ['label' => \Yii::t('commerce', 'Category')];
        $this->getView()->params['breadcrumbs'][] = ['label' => $this->view->title];
    }

    private function prepareData($model)
    {
        $searchModel = new KodCommerceProductSearch();
        $searchModel->tree_id = $model['id'];
        $dataProvider = $searchModel->search(\Yii::$app->request->post());

        return [$searchModel, $dataProvider];
    }


    protected function findModel($slug): array
    {
        $model = KodCommerceCategory::find()->select('id, name')->where(['like', 'name', urldecode($slug)])->asArray()->one();
        if ($model) {

            return $model;
        }
        throw new NotFoundHttpException("Category Not Found");
    }
}
