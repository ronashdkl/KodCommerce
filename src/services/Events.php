<?php


namespace kodCommerce\services;


use kodCommerce\admin\models\PostAttributes;
use kodCommerce\admin\models\ProductVariation;
use ronashdkl\kodCms\modules\admin\models\Post;
use yii\base\Event;
use yii\helpers\VarDumper;

class Events
{
    public function register()
    {
        /**
         * Listen before save event and check whether product is variation type or simple.
         */
        Event::on(Post::class, Post::BEFORE_SAVE, [$this,'variation']);
    }

    /**
     * @param $event
     */
    public function variation($event): void
    {
        $sku =  "P" . $event->sender->id . "TS";

        //if it is a variation
     if( $event->sender->product_type){
         ProductVariation::deleteAll(['sku' =>$sku]);
         PostAttributes::deleteAll(['post_id'=>$event->sender->id,'name'=>'Type']);
     }else{ //if not a variation
         //remove all attributes
         PostAttributes::deleteAll(['post_id'=>$event->sender->id]);
         //remove all variations
         ProductVariation::deleteAll(['post_id' => $event->sender->id]);
         //insert Product Attribute to simple
         $productAttribute = new PostAttributes([
             'post_id'=>$event->sender->id,
             'name'=>'Type',
             'value'=>'Simple'
         ]);
         $productAttribute->save(false);
         //insert simple product to variation
         $simpleProduct = new ProductVariation([
             'post_id'=>$event->sender->id,
             'sku' => $sku,
             'variations' =>['Type'=>'Simple'],
             'price' => 0,
             'stock' => -1
         ]);
         $simpleProduct->save(false);
     }

    }
}
