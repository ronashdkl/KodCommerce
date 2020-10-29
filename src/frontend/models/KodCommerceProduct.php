<?php
namespace kodCommerce\frontend\models;

use kodCommerce\admin\models\PostAttributes;
use kodCommerce\admin\models\ProductVariation;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

/**
 * Class KodCommerceProduct
 * @property integer $price
 * @property integer $product_type
 * @property PostAttributes $productAttributes
 * @property array $productAttributesByIndex
 * @property string $formattedPrice
 * @property ProductVariation $stocks
 */
class KodCommerceProduct extends \ronashdkl\kodCms\models\post\PostModel
{
public $formattedPrice;
    public function afterFind()
    {
        parent::afterFind();
        $this->formattedPrice = \Yii::$app->formatter->asCurrency($this->price);
    }

    public function getProductAttributes(){
        return $this->hasMany(PostAttributes::class,['post_id'=>'id']);
    }

    public function getStocks(){
        return $this->hasMany(ProductVariation::class,['post_id'=>'id'])->asArray();
    }

    public function getProductAttributesByIndex(){
        $attributes = $this->productAttributes;
       return  ArrayHelper::index($attributes,null,'name');
    }

}
