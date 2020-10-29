<?php


namespace kodcommerce\models;


use kodCommerce\admin\models\ProductVariation;
use kodcommerce\cart\models\CartItemInterface;
use yii\base\BaseObject;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;


/**
 * Class CartItemModel
 * @package kodcommerce\models
 */
class CartItemModel extends BaseObject implements CartItemInterface
{
    public $sku;
    public $quantity;
    public $price;
    public $label;
    public $variation;
    public $image;
    public $product_id;

    public function __construct(string $sku, int $quantity = 1)
    {
        parent::__construct();
        $this->sku = $sku;
        $this->quantity = $quantity;
        $this->loadData();
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getUniqueId()
    {
        return $this->sku;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->product_id;
    }


    /**
     * @param bool $add
     * @param int|null $quantity
     * @return $this
     */
    public function updateQuantity(int $quantity = null)
    {

            $this->quantity = $quantity;

    }

    /**
     * @return int|mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return float|int
     */
    public function getTotal()
    {
        return $this->price * $this->quantity;
    }


    /**
     * @return array
     */

    public function getVariations()
    {
        return $this->variation;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @throws NotFoundHttpException|void
     */
    private function loadData()
    {
        $pv = ProductVariation::find()->joinWith('product')->where(['sku' => $this->sku])->one();
        if (!$pv) {
            throw new NotFoundHttpException("Product not found");
        }

        $this->price = $pv->getPrice();
        $this->label = $pv->product->title;
        $this->variation = ["name"=>$pv->variations,"price"=>$pv->price];
        $this->product_id = $pv->post_id;
        $this->image = $pv->product->avatar;

    }

}
