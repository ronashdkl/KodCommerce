<?php


namespace kodCommerce\widgets;


use yii\base\Widget;

/**
 * Class CartInformationWidget
 * @property string $title
 * @property array $actions
 * @package kodCommerce\widgets
 */
class CartInformationWidget extends Widget
{
    public $title = null;
    public $actions = [];

public function run()
{
    parent::run();
    return $this->render('cart-information',['title'=>$this->title,'actions'=>$this->actions]);
}
}
