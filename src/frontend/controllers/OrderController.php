<?php


namespace kodCommerce\frontend\controllers;


use kodCommerce\frontend\base\CommerceBaseController;

class OrderController  extends CommerceBaseController
{
public function actionIndex(){
    $this->registerWidgets();
    return $this->renderContent('Work in progress!');
}
}