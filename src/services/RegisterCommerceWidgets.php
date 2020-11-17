<?php


namespace kodCommerce\services;


use kodCommerce\KodCommerceHooks;
use kodCommerce\widgets\ProductDescriptionWidget;

use kodCommerce\widgets\ProductSearchWidget;
use ronashdkl\kodCms\components\FieldConfig;


class RegisterCommerceWidgets
{
    public $widgets = [
        [
            'class'=>ProductDescriptionWidget::class,
            'name'=>'Product Description'
        ]
    ];
    public $setting = ['fieldData[catalog][display][search_widget_title]' => [
                'type' => FieldConfig::INPUT,
                'label'=> 'Search Widget Title',
                'group' => 'display',
            ],
        ];
    public function register()
    {
        \Yii::$app->hooks->add_filter(KodCommerceHooks::RENDER_PRODUCT_CONTENT, function ($widgets) {
            return array_merge($widgets, $this->widgets);
        });
        \Yii::$app->hooks->add_filter(KodCommerceHooks::RENDER_CATEGORY_LEFT_WIDGETS, function ($widgets) {
            \Yii::$app->hooks->add_filter(KodCommerceHooks::SETTING_FIELDS, function ($fields) {
                return array_merge($fields, $this->setting);
            });
            return array_merge($widgets,[
                [
                    'class'=>ProductSearchWidget::class,
                    'name'=>'Search Product',
                ]
            ]);
        });


    }
}
