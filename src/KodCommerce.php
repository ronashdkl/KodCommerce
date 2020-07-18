<?php
namespace kodCommerce;

use yii\filters\AccessControl;

class KodCommerce extends \yii\base\Module
{

    public $id = 'commerce-admin';
    public $controllerNamespace = "kodCommerce\\frontend\\controllers";
    public function init()
    {
        parent::init();
        $this->viewPath = '@kodcommerce/frontend/views';
        $this->layout = '@kodCms/views/layouts/main';

    }
}