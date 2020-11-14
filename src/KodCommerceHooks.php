<?php

namespace kodCommerce;
/**
 * Class KodCommerceHooks
 * @package kodCommerce
 * Yii::$app->hooks->add_action(\kodCommerce\KodCommerceHooks::RENDER_CATEGORY_PRODUCT_ITEM,function(){
 * echo "html content or render widget";
 * });
 */
class KodCommerceHooks
{
    const RENDER_PRODUCT_CONTENT = 'kodcommerce_render_product_content';
    const RENDER_CONTENT_AFTER_VARIATION = 'kodcommerce_render_content_after_variation';
    const RENDER_CONTENT_BEFORE_VARIATION = 'kodcommerce_render_content_before_variation';
    const RENDER_CATEGORY_LEFT_WIDGETS = 'kodcommerce_category_left_widgets';
    const RENDER_CATEGORY_TOP_WIDGETS = 'kodcommerce_category_top_widgets';
    const RENDER_CATEGORY_BOTTOM_WIDGETS = 'kodcommerce_category_bottom_widgets';
    const RENDER_CATEGORY_PRODUCT_ITEM = 'kodcommerce_category_product_item';


//        Example

       /* \Yii::$app->hooks->add_filter(KodCommerceHooks::RENDER_CATEGORY_TOP_WIDGETS,function($d){
            return [[
                'class'=>ProductImagesWidget::class,
                'data'=>[
                    'images'=>KodCommerceProduct::find()->one()->images
                ]
            ]];
        });*/

}
