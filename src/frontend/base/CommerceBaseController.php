<?php


namespace kodCommerce\frontend\base;


use yii\base\Event;
use yii\web\Controller;
use yii\web\View;

class CommerceBaseController extends Controller
{

    protected function registerWidgets($singlePage=false){
        if($singlePage){
            \Yii::$app->appData->registerHomeWidget();
            return;
        }
        \Yii::$app->appData->registerPageWidget();
        return;
    }

}