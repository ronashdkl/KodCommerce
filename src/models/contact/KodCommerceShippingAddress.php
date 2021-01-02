<?php


namespace kodCommerce\models\contact;


use kodcommerce\models\KodCommerceContact;

class KodCommerceShippingAddress extends KodCommerceContact
{
    public function init()
    {
        $this->type = self::TYPE_SHIPPING_ADDRESS;
}
}
