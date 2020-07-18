<?php


namespace kodCommerce\frontend\controllers;


use kodCommerce\frontend\base\CommerceBaseController;


class DefaultController extends CommerceBaseController
{

    public function actionIndex()
    {
        $this->view->title = "Commerce";
       $this->registerWidgets(true);
       return $this->renderContent(null);
        //return $this->render('index');
    }
}