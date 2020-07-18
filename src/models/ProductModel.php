<?php


namespace kodcommerce\models;


use kodcommerce\cart\models\CartItemInterface;
use ronashdkl\kodCms\models\post\PostModel;

class ProductModel extends PostModel implements CartItemInterface
{

    public function getPrice()
    {
        return $this->price;
    }

    public function getLabel()
    {
        return $this->title;
    }

    public function getUniqueId()
    {
        return $this->id;
    }
}