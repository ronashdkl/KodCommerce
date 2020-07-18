<?php

namespace kodCommerce\services;

use ronashdkl\kodCms\components\FieldConfig;

class RegisterHooks
{
    public $admin_menu = [[
        'label' => 'Kod Commerce',
        'icon' => 'money',
        'items' => [
            ['label' => 'Dashboard',
                'url' => '/commerce-admin',],
            ['label' => 'Attributes',
                'url' => '/commerce-admin/attributes',],
            ['label' => 'Settings',
                'url' => '/commerce-admin/setting',]
        ]
    ]];
    public $commerce_form = [

        'fieldData[homepage]' => [
            'label' => 'HomePage',
            'type' => \ronashdkl\kodCms\components\FieldConfig::RADIO,
            'data' => ['commerce' => 'default', 'commerce/search' => 'Search Page']
        ],
    ];

    public $post_tab_menu = [
        'commerce' => 'Commerce'
    ];
    public $post_tab_content = [
        'commerce' => '@kodcommerce/admin/views/post/form'
    ];

    public $post_fields = [
        'price'=>[
            'type'=>FieldConfig::INPUT,
            'group'=>'price'
        ],
        'product_type'=>[
            'type'=>FieldConfig::CHECKBOX,
            'data'=>[1=>'Variation'],
            'group'=>'price'
        ],
    ];
    public $post_rules = [
        [['price'],'integer'],
        ['product_type','safe']

    ];

    public function register()
    {
        \Yii::$app->hooks->add_filter('kodCommerce_setting_fields', function ($fields) {
            return array_merge($fields, $this->commerce_form);
        });
        $this->adminHooks();
    }

  private function adminHooks()
    {


        \Yii::$app->hooks->add_filter('admin_menu', function ($menu) {
            array_splice($menu, 2, 0, $this->admin_menu);
            return $menu;
        }, 20);

        $this->registerPostFields();
    }

    private function registerPostFields()
    {
        \Yii::$app->hooks->add_filter('post_fields', function ($fields) {
            return array_merge($fields, $this->post_fields);
        });
        \Yii::$app->hooks->add_filter('post_rules', function ($rules) {
            return array_merge($rules, $this->post_rules);
        });
        \Yii::$app->hooks->add_filter('post_tab_nav', function ($navs) {
            return array_merge($navs, $this->post_tab_menu);
        });
        \Yii::$app->hooks->add_filter('post_tab_content', function ($content) {
            return array_merge($content, $this->post_tab_content);
        });
    }
}