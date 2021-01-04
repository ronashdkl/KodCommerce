<?php


namespace kodCommerce\frontend\controllers;


use kodCommerce\frontend\base\CommerceBaseController;
use kodCommerce\models\contact\KodCommerceBillingAddress;
use kodCommerce\models\contact\KodCommerceShippingAddress;

use yii\db\StaleObjectException;
use yii\helpers\VarDumper;


class CheckoutController extends CommerceBaseController
{

    public function actionIndex()
    {
        $this->registerWidgets();
        $total = function($type = 'total',$multiply=null){
            return \Yii::$app->formatter->asCurrency(\Yii::$app->cart->getAttributeTotal($type,$multiply));
        };



        $model = KodCommerceBillingAddress::find()->where([
            'user'=>\Yii::$app->user->id,
            'type'=>0
        ])->one();

        if(!$model){
            $model = new KodCommerceBillingAddress([
                'isSameShippingAddress' => 1,
                'user' => \Yii::$app->user->identity->getId()??null,
                'address_line_one' => \Yii::$app->user->identity->profile->location??null,
                'email'=>\Yii::$app->user->identity->email??null
            ]);
        }




        if($model->load(\Yii::$app->request->post()) && $model->save()){
            \Yii::$app->session->set('billing_address',$model);
            if($model->isSameShippingAddress){
                $this->addShippingAddress($model->getAttributes());
                
                return $this->redirect('checkout/confirm');
               }

           
            return $this->redirect('checkout/shipping-address');
        }
      return $this->render('index',['model'=>$model,'total'=>$total,'title'=>'Billing Address']);
    }


    public function actionShippingAddress()
    {
        $this->registerWidgets();
        $total = function($type = 'total',$multiply=null){
            return \Yii::$app->formatter->asCurrency(\Yii::$app->cart->getAttributeTotal($type,$multiply));
        };
        $model = KodCommerceShippingAddress::find()->where([
            'user'=>\Yii::$app->user->id,
            'type'=>1
        ])->one();

        if(!$model){
            $model = new KodCommerceShippingAddress([
                'user' => \Yii::$app->user->identity->getId()??null,
            ]);
        }
        if($model->load(\Yii::$app->request->post()) && $model->save()){
            \Yii::$app->session->set('shipping_address',$model);
            return $this->redirect('confirm');

        }
        return $this->render('index',['model'=>$model,'total'=>$total,'title'=>'Shipping Address']);
    }

    public function actionConfirm()
    {
       $this->registerWidgets();
        $total = function($type = 'total',$multiply=null){
            return \Yii::$app->formatter->asCurrency(\Yii::$app->cart->getAttributeTotal($type,$multiply));
        };
       return $this->render('confirm',[
           'billingAddress' =>\Yii::$app->session->get('billing_address'),
           'shippingAddress' =>\Yii::$app->session->get('shipping_address'),
           'total'=>$total,
           'items'=>\Yii::$app->cart->getItems()
       ]);
    }
    private function addShippingAddress($billingAddr)
    {
        unset($billingAddr['type']);
        try {
           $model =  KodCommerceShippingAddress::find()->where([
                'user' => \Yii::$app->user->id,
                'type' => 1
            ])->one();
           if($model == null){
               $model = new KodCommerceShippingAddress([
                   'user' => \Yii::$app->user->identity->getId()??null,
               ]);
           }
            $model->setAttributes($billingAddr);

            $model->save();
            \Yii::$app->session->set('shipping_address',$model);

        } catch (StaleObjectException $e) {
        }

    }
}
