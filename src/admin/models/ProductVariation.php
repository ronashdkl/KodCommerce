<?php


namespace kodCommerce\admin\models;


use kodcommerce\cart\models\CartItemInterface;
use ronashdkl\kodCms\models\post\PostModel;
use yii\db\ActiveRecord;

/**
 * Class ProductVariation
 * @package kodCommerce\admin\models
 * @property string $sku
 * @property integer $post_id
 * @property array $variations
 * @property float $price
 * @property integer $stock
 * @property PostModel $product
 *
 */
class ProductVariation extends ActiveRecord implements CartItemInterface
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

    public function getPrice()
    {
        return $this->price+$this->product->price;
    }

    public function getLabel()
    {
        $this->product->title;
    }

    public function getUniqueId()
    {
       return $this->sku;
    }

    public function getProduct(){
    return $this->hasOne(PostModel::class,['id'=>'post_id']);
    }
}