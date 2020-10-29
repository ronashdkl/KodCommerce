<?php
namespace kodCommerce;

class KodCommerceAdmin extends \yii\base\Module
{
    public $id = 'commerce-admin';
    public $controllerNamespace = "kodCommerce\\admin\\controllers";
   public function init()
   {
       parent::init();
       $this->viewPath = '@kodcommerce/admin/views';
       $this->layout = '@kodCms/modules/admin/views/layouts/main';
       \Yii::$app->params['bsVersion'] = '3';
       \Yii::$app->params['bsDependencyEnabled'] = false;

   }
}
