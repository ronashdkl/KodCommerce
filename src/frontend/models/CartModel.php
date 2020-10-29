<?php


namespace kodCommerce\frontend\models;


use kodCommerce\admin\models\ProductVariation;
use kodcommerce\models\CartItemModel;
use yii\base\InvalidArgumentException;
use yii\base\Model;

/**
 * Class CartModel
 * @package kodCommerce\frontend\models
 * @property CartItemModel data
 */
class CartModel extends Model
{
    const SCENARIO_DEFAULT = 'add';
    const SCENARIO_ADD = 'add';
    const SCENARIO_DELETE= 'delete';

    public $sku;
    public $quantity;
    private $_data;

    public function rules()
    {
        return [
            ['sku', 'required','on'=>['add','delete']],
            ['quantity', 'required','on'=>['add']],
            ['sku', 'string'],
            ['quantity', 'integer'],
            ['sku','exist','targetClass'=>ProductVariation::class,'targetAttribute' => ['sku' => 'sku']]
        ];
    }
    public function formName()
    {
        return '';
    }

    public function save(){
        if($this->validate()){
           $this->_data = new CartItemModel($this->sku,$this->quantity);
            \Yii::$app->cart->add($this->_data);
            return true;
        }else{
            return false;
        }

    }

    public function delete()
    {
        if($this->validate()){
            try {
                \Yii::$app->cart->remove($this->sku);
                return true;
            }catch (InvalidArgumentException $e){
                $this->addError('sku',$e->getMessage());

                return false;
            }
        }else{
            return false;
        }
    }


    public static function getAll(){
        return  \Yii::$app->cart->getItems();
    }

    public static function clear()
    {
        return  \Yii::$app->cart->clear();
    }

    public function getData(){
        return $this->_data;
    }

}
