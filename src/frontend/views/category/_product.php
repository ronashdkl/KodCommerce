<?php

?>

<div class="grid-item">
    <div class="product">
        <div class="product-image">
            <a href="<?=$model->generateRoute()?>"><img alt="Shop product image!" src="<?=$model->getAvatar()?>">
            </a>
            <a href="<?=$model->generateRoute()?>"><img alt="Shop product image!" src="<?=$model->getAvatar()?>">
            </a>

            <div class="product-overlay">
                <a href="<?=$model->generateRoute()?>" role="modal-remote"><?=Yii::$app->kodCommerceSetting->get('catalog.label.quick_view')?></a>
            </div>
        </div>
        <div class="product-description">
            <div class="product-category"><?=$model->catalog->name?></div>
            <div class="product-title">
                <h3><a href="<?=$model->generateRoute()?>"><?=$model->title ?></a></h3>
            </div>
            <div class="product-price"><ins><?=$model->formattedPrice ?></ins>
            </div>
            <?= Yii::$app->hooks->do_action(\kodCommerce\KodCommerceHooks::RENDER_CATEGORY_PRODUCT_ITEM)?>
        </div>
    </div>
</div>

