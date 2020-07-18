<?php
namespace kodcommerce\cart\storage;



use kodcommerce\cart\Cart;

/**
 * Interface StorageInterface
 * @package kodcommerce\cart\cart
 */
interface StorageInterface
{

    /**
     * @param Cart $cart
     *
     * @return void
     */
    public function load(Cart $cart);

    /**
     * @param Cart $cart
     *
     * @return void
     */
    public function save(Cart $cart);
}