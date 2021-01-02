<?php

namespace kodcommerce\models;

/**
 * This is the ActiveQuery class for [[KodCommerceContact]].
 *
 * @see KodCommerceContact
 */
class KodcommerceContactQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return KodCommerceContact[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return KodCommerceContact|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
