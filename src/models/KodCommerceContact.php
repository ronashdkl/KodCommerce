<?php

namespace kodcommerce\models;

use ronashdkl\kodCms\components\FieldConfig;
use ronashdkl\kodCms\models\User;
use Yii;

/**
 * This is the model class for table "kodcommerce_contact".
 *
 * @property int $id
 * @property int $type
 * @property int $user
 * @property string $country
 * @property string $address_line_one
 * @property string $address_line_two
 * @property string $zip_code
 * @property string $city
 * @property string $state
 * @property string $phone
 * @property string $email
 *
 * @property User $user0
 */
class KodCommerceContact extends \yii\db\ActiveRecord
{
    const TYPE_BILLING_ADDRESS = 0;
    const TYPE_SHIPPING_ADDRESS = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kodcommerce_contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'user'], 'integer'],
            ['type', 'in', 'range' => [self::TYPE_BILLING_ADDRESS,self::TYPE_SHIPPING_ADDRESS], 'allowArray' => true],
            [['country', 'address_line_one', 'zip_code', 'city', 'state', 'phone'], 'required'],
            [['country'], 'string', 'max' => 50],
            [['address_line_one', 'address_line_two'], 'string', 'max' => 200],
            [['zip_code'], 'string', 'max' => 5],
            [['city', 'state', 'email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 15],
            [['user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'user' => Yii::t('app', 'User'),
            'country' => Yii::t('app', 'Country'),
            'address_line_one' => Yii::t('app', 'Address Line One'),
            'address_line_two' => Yii::t('app', 'Address Line Two'),
            'zip_code' => Yii::t('app', 'Zip Code'),
            'city' => Yii::t('app', 'City'),
            'state' => Yii::t('app', 'State'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'user']);
    }

    /**
     * {@inheritdoc}
     * @return KodcommerceContactQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new KodcommerceContactQuery(get_called_class());
    }

    public function formTypes()
    {
        return [
            'address_line_one'=>[
                'type'=>FieldConfig::INPUT,

            ], 'address_line_two'=>[
                'type'=>FieldConfig::INPUT,
                'group'=>'Address'
            ],'zip_code'=>[
                'type'=>FieldConfig::INPUT
            ],'city'=>[
                'type'=>FieldConfig::INPUT
            ],'phone'=>[
                'type'=>FieldConfig::INPUT
            ]
            ,'email'=>[
                'type'=>FieldConfig::INPUT,
                'config'=>[
                    'type'=>'email'
                ]
            ],
        ];
    }
}
