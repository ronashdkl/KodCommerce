<?php

namespace kodCommerce\admin\models;


use kartik\grid\ActionColumn;
use kartik\grid\CheckboxColumn;
use ronashdkl\kodCms\components\FieldConfig;
use Yii;

/**
 * This is the model class for table "kodcommerce_attribute".
 *
 * @property int $id
 * @property string $name
 * @property string $type
 */
class KodCommerceAttribute extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kodcommerce_attribute';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['name', 'type'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
        ];
    }

    public function formTypes()
    {
    return [
        'name'=>[
            'type'=>FieldConfig::INPUT,

        ],
        'type'=>[
            'type'=>FieldConfig::SELECT,
            'config'=>[
                'data'=>[FieldConfig::INPUT=>'Normal',FieldConfig::COLOR=>'Color',FieldConfig::IMAGE=>'Image']
            ]
        ]
    ];
    }

    public function getColumns()
    {
        return [
            [
                'class'=>CheckboxColumn::class
            ],
            'name',
            'type',
            [
                'class' => ActionColumn::class,
                // you may configure additional properties here
            ]
        ];
    }
}
