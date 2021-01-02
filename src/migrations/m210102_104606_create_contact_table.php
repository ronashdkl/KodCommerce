<?php
namespace kodCommerce\migrations;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%contact}}`.
 */
class m210102_104606_create_contact_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%kodcommerce_contact}}', [
            'id' => $this->primaryKey(),
            'type'=>$this->smallInteger(1),
            'user'=>$this->integer(),
            'country'=>$this->string('50')->notNull(),
            'address_line_one'=>$this->string('200')->notNull(),
            'address_line_two'=>$this->string('200')->null(),
            'zip_code'=>$this->string('5')->notNull(),
            'city'=>$this->string('100')->notNull(),
            'state'=>$this->string('100')->notNull(),
            'phone'=>$this->string('15')->notNull(),
            'email'=>$this->string('100'),
        ]);
        $this->addForeignKey('fbk_iser_id','{{%kodcommerce_contact}}','user','user','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fbk_iser_id','{{%kodcommerce_contact}}');
        $this->dropTable('{{%kodcommerce_contact}}');
    }
}
