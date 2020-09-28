<?php


namespace kodCommerce\frontend\base;


use yii\base\Event;
use yii\helpers\VarDumper;
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

    public function init()
    {
        parent::init();
        \Yii::$app->hooks->add_action('kodCms-navigation',[$this,'registerNavigation']);
    }
    function registerNavigation(){
            echo $this->renderPartial('/cartNavigation');
    }

    public function afterAction($action, $result)
    {
        return parent::afterAction($action, $result);
    }
}