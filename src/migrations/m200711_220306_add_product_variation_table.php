<?php
namespace kodCommerce\migrations;
use yii\db\Migration;

/**
 * Class m200711_220306_add_productAttributes_table
 */
class m200711_220306_add_product_variation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('{{%post}}','product_type',$this->smallInteger());
        $this->addColumn('{{%post}}','price',$this->float());
        $this->createTable('{{%kodcommerce_product_attribute}}',[
            'id'=>$this->primaryKey(),
            'post_id'=>$this->integer(),
            'name'=>$this->string(254)->notNull(),
            'value'=>$this->text()->notNull(),
            'config'=>'longtext',
        ]);
        $this->createTable('{{%kodcommerce_attribute}}',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(50)->notNull(),
            'type'=>$this->string(50)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropColumn('{{%post}}','product_type');
        $this->dropColumn('{{%post}}','price');
        $this->dropTable('{{%kodcommerce_product_attribute}}');
        $this->dropTable('{{%kodcommerce_attribute}}');
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
