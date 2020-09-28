<?php
namespace kodcommerce\cart\models;

/**
 * All objects that can be added to the cart must implement this interface
 * @package kodcommerce\cart\models
 */
interface CartItemInterface
{
    /**
     * Returns the label for the cart item (displayed in cart etc)
     * @return string
     */
    public function getLabel();

    /**
     * Returns unique id to associate cart item with product
     * @return string
     */
    public function getUniqueId();
}