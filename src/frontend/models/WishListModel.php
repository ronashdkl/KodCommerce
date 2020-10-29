<?php


namespace kodCommerce\frontend\models;


use kodcommerce\models\CartItemModel;
use yii\base\Model;


class WishListModel extends Model
{
    const SCENARIO_ADD = 'add';
    const SCENARIO_DELETE= 'delete';
    public $sku;

    public function rules()
    {
        return [
            ['sku', 'required','on'=>[self::SCENARIO_ADD,self::SCENARIO_DELETE]]
        ];
    }
    public function save(){
        if($this->validate()){
            $item = new CartItemModel($this->sku);
            \Yii::$app->wishList->add($item);
            return true;
        }else{
            return false;
        }

    }

    public function delete()
    {
        if($this->validate()){
            \Yii::$app->wishList->remove($this->sku);
            return true;
        }else{
            return false;
        }
    }

}
