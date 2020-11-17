<?php


namespace kodCommerce\admin\controllers;

use kodCommerce\admin\models\KodCommerceAttribute;


use kodCommerce\admin\models\search\KodCommerceAttributeSearch;
use ronashdkl\kodCms\modules\admin\components\CRUDController;

class AttributesController extends CRUDController
{

    public $modelClass = KodCommerceAttribute::class;
    public $searchModelClass = KodCommerceAttributeSearch::class;
}
