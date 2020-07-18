<?php


namespace kodCommerce\frontend\controllers;


use kodCommerce\frontend\base\CommerceBaseController;

class ProductController extends CommerceBaseController
{
    public function actionIndex()
    {
        $this->view->title = "Product";
        $this->registerWidgets();
        return $this->render('index');
}
}