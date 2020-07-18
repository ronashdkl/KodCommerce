<?php


namespace kodCommerce\admin\controllers;


use kodcommerce\models\KodCommerceSettingsModel;
use ronashdkl\kodCms\modules\admin\components\AdminSiteController;


class SettingController extends AdminSiteController
{
public $modelClass = KodCommerceSettingsModel::class;

}