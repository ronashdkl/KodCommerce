<?php


namespace kodCommerce\admin\models;


use kodCommerce\frontend\models\KodCommerceProduct;
use yii\db\ActiveRecord;

/**
 * Class ProductVariation
 * @package kodCommerce\admin\models
 * @property string $sku
 * @property integer $post_id
 * @property array $variations
 * @property float $price
 * @property integer $stock
 * @property KodCommerceProduct $product
 *
 */
class ProductVariation extends ActiveRecord
{
public static function tableName()
{
    return "kodcommerce_product_variation";
}

public function rules()
{
    return [
        [['price','stock','post_id'],'integer'],
        ['sku','string'],
        ['variations','safe']
    ];
}

public function beforeSave($insert)
{
    $this->variations = json_encode($this->variations);
    return parent::beforeSave($insert);
}
    public function afterFind()
    {
        $this->variations = json_decode($this->variations,true);
        parent::afterFind();

    }

    public function getPrice(){
    return $this->price+$this->product->price;
}

    public function getProduct(){
    return $this->hasOne(KodCommerceProduct::class,['id'=>'post_id']);
    }
}
