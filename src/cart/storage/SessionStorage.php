<?php
namespace kodcommerce\cart\storage;


use kodcommerce\cart\Cart;
use yii\base\BaseObject;
use yii\web\Session;

/**
 * Class SessionStorage
 * @property Session session
 * @package kodcommerce\cart\cart
 */
class SessionStorage extends BaseObject implements StorageInterface
{
    /**
     * @var string
     */
    public $key = 'cart';

    /**
     * @inheritdoc
     */
    public function load(Cart $cart)
    {
        $cartData = [];
        if (false !== ($session = ($this->session->get($this->key, false)))) {
            $cartData = unserialize($session);
        }
        return $cartData;
    }

    /**
     * @inheritdoc
     */
    public function save(Cart $cart)
    {
        $sessionData = serialize($cart->getItems());
        $this->session->set($this->key, $sessionData);
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        return \Yii::$app->get('session');
    }
}