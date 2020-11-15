<?php


namespace kodCommerce\widgets;


use kodCommerce\frontend\models\KodCommerceProduct;
use yii\base\Widget;

/**
 * Class KodCommerceProductWidget
 * @package kodCommerce\widgets
 * @property KodCommerceProduct $model
 */
abstract class KodCommerceProductWidget extends Widget
{
public $model;
}
