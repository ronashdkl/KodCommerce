<?php


namespace kodCommerce\frontend\controllers;


use kodCommerce\frontend\base\CommerceBaseController;

class SearchController extends CommerceBaseController
{
    public function actionIndex()
    {
        $this->view->title = "Search";
        $this->registerWidgets();
        return $this->render("index");
}
}