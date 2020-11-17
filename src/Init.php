<?php


namespace kodCommerce;


use kodCommerce\services\Cart;
use kodCommerce\services\Events;
use kodCommerce\services\RegisterCommerceWidgets;
use kodCommerce\services\RegisterCurrencyFormatter;
use kodCommerce\services\RegisterHooks;
use kodCommerce\services\RegisterModules;
use kodCommerce\services\RegisterPostUpdateSection;
use yii\base\BaseObject;
use yii\i18n\Formatter;

class Init extends BaseObject
{

    /**
     * Class order matters
     * @var string[]
     */
    public static $services =[
        Cart::class,
        RegisterModules::class,
        RegisterHooks::class,
        RegisterCurrencyFormatter::class,
        RegisterPostUpdateSection::class,
        Events::class,
        RegisterCommerceWidgets::class
    ];

    /**
     * loop through the classes, initialize them,
     * and call register method if exists
     *
     * @return void
     * @throws \yii\base\InvalidConfigException
     */
    public static function registerServices(){
        foreach(self::$services as $class){
            $service = self::instantiate($class);
            if(method_exists($service, 'register')){
                $service->register();
            }
        }
    }

    /**
     * Initialize the class
     *
     * @param class  $class class from the service array
     * @return  instance new instance of the class
     */
    private static function instantiate($class){
        return new $class();
    }

}
