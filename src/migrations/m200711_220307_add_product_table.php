<?php
namespace kodCommerce\migrations;
use yii\db\Migration;

/**
 * Class m200711_220306_add_productAttributes_table
 */
class m200711_220307_add_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%kodcommerce_product_variation}}',[
            'sku'=>$this->string(),
            'post_id'=>$this->integer(),
            'variations'=>$this->text(),
            'price'=>$this->float(),
            'stock'=>$this->integer(),
            'PRIMARY KEY (sku)'
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
       $this->dropTable('{{%kodcommerce_product_variation}}');


    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200711_220306_add_productAttributes_table cannot be reverted.\n";

        return false;
    }
    */
}
