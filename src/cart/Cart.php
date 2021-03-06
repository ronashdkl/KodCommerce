<?php
namespace kodcommerce\cart;

use kodcommerce\cart\storage\StorageInterface;
use kodcommerce\models\CartItemModel;
use yii\base\Component;
use yii\base\InvalidArgumentException;
use yii\base\InvalidConfigException;
use yii\web\Session;
use kodcommerce\cart\models\CartItemInterface;

/**
 * Provides basic cart functionality (adding, removing, clearing, listing items). You can extend this class and
 * override it in the application configuration to extend/customize the functionality
 * @package yii2mod\cart
 * @property int     $count
 * @property Session $session
 */
class Cart extends Component
{

    /**
     * @var interface class
     */
    const ITEM_PRODUCT = 'kodcommerce\cart\models\CartItemInterface';


    /**
     * @var CartItemModel[]
     */
    protected $items;

    /**
     * @var null
     */
    private $storage = null;

    /**
     * Override this to provide custom (e.g. database) storage for cart data
     * @var string|StorageInterface
     */
    public $storageClass = 'kodcommerce\cart\storage\SessionStorage';

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        $this->clear(false);
        $this->setStorage(\Yii::createObject($this->storageClass));
        $this->items = $this->storage->load($this);
    }

    /**
     * Assigns cart to logged in user
     *
     * @param string
     * @param string
     *
     * @return void
     * @throws InvalidConfigException
     */
    public function reassign($sessionId, $userId)
    {
        if (get_class($this->getStorage()) === 'kodcommerce\cart\storage\DatabaseStorage') {
            if (!empty($this->items)) {
                $storage = $this->getStorage();
                $storage->reassign($sessionId, $userId);
                self::init();
            }
        }
    }

    /**
     * Delete all items from the cart
     *
     * @param bool $save
     *
     * @return $this
     */
    public function clear($save = true)
    {
        $this->items = [];
        $save && $this->storage->save($this);
        return $this;
    }

    /**
     * Setter for the storage component
     *
     * @param StorageInterface|string $storage
     *
     * @return Cart
     */
    public function setStorage($storage)
    {
        $this->storage = $storage;
        return $this;
    }

    /**
     * Add an item to the cart
     *
     * @param CartItemInterface $element
     * @param bool                     $save
     *
     * @return $this
     */
    public function add(CartItemInterface $element, $save = true)
    {
        $this->addItem($element);
        $save && $this->storage->save($this);
        return $this;
    }


    /**
     * @param CartItemInterface $item
     *
     * @param bool $update
     * @internal param $quantity
     */
    protected function addItem(CartItemInterface $item)
    {
        $uniqueId = $item->getUniqueId();
       $this->items[$uniqueId] = $item;

    }


    /**
     * Removes an item from the cart
     *
     * @param string $uniqueId
     * @param bool   $save
     *
     * @throws InvalidArgumentException
     * @return $this
     */
    public function remove($uniqueId, $save = true)
    {
        if (!isset($this->items[$uniqueId])) {
            throw new InvalidArgumentException('Item not found');
        }
        unset($this->items[$uniqueId]);

        $save && $this->storage->save($this);
        return $this;
    }

    /**
     * @param string $itemType If specified, only items of that type will be counted
     *
     * @return int
     */
    public function getCount($itemType = null)
    {
        return count($this->getItems($itemType));
    }


    /**
     * Returns all items of a given type from the cart
     *
     * @param string $itemType One of self::ITEM_ constants
     *
     * @return CartItemInterface[]
     */
    public function getItems($itemType = null)
    {
        $items = $this->items;
        if (!is_null($itemType)) {
            $items = array_filter($items,
                function ($item) use ($itemType) {
                    /** @var $item CartItemInterface */
                    return is_subclass_of($item, $itemType);
                });
        }
        return $items;
    }


    /**
     * Finds all items of type $itemType, sums the values of $attribute of all models and returns the sum.
     *
     * @param string      $attribute
     * @param string      $multiplyBy
     * @param string|null $itemType
     *
     * @return integer
     */
    public function getAttributeTotal($attribute,$multiplyBy=null, $itemType = null)
    {
        $sum = 0;
        foreach ($this->getItems($itemType) as $model) {
            if($multiplyBy){
                $sum += $model->{$attribute} * $model->{$multiplyBy};
            }else{
                $sum += $model->{$attribute};
            }

        }
        return $sum;
    }


    /**
     * @return StorageInterface|string
     */
    protected function getStorage()
    {
        return $this->storage;
    }
}
