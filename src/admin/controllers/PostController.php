<?php


namespace kodCommerce\admin\controllers;


use kodCommerce\admin\models\PostAttributes;
use kodCommerce\admin\models\ProductVariation;
use kodcommerce\models\attribute\KodCommerceProductAttributeModel;
use kodCommerce\services\RegisterPostUpdateSection;
use Yii;
use yii\base\DynamicModel;
use yii\db\Exception;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;


class PostController extends Controller
{


    public function actionAttributes( $id = null, $remove = null)
    {
        if ($id) {
            $model = PostAttributes::findOne($id);
            Yii::$app->hooks->add_filter('kodcommerce_product_attributes_forms', function ($fields) use ($model) {
                $fields['config[typeValue]]'] = [
                    'type' =>$model->commerceAttribute->type,
                    'label'=>'Attribute Type Value',
                    'hint'=>'Leave empty to use default value',
                    'group' => 'config'
                ];
                return $fields;
            });
        } else {
            $model = new PostAttributes();
        }

      if($model->post_id==null){
          $model->post_id = Yii::$app->request->getQueryParam('post_id');
      }
        if($remove && $model->delete()){
            return $this->renderView(new PostAttributes(['post_id'=>$model->post_id]));
        }


        //register config field;



        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('success', 'Attributes saved');
            return $this->renderView(new PostAttributes(['post_id'=>$model->post_id]));

        }
        return $this->renderView($model);
       }

    private function renderView($model)
    {
        $viewParam = array_merge(
            [
                'post_id' => $model->post_id,
                'postAttributes' => $model->id?$model:new PostAttributes(['post_id' => $model->post_id])
            ],
            RegisterPostUpdateSection::getPostAttributes($model->post_id));
        return $this->renderAjax('attributesForm', $viewParam);
    }


    public function actionVariations($id)
    {

        if(Yii::$app->request->isPost){
            try {
                return $this->saveAttributes($id);
            } catch (Exception $e) {
                throw $e;
            }
        }
       $attributes = PostAttributes::find()->select('value,name')->where(['post_id'=>$id])->asArray()->all();
        $attributes = ArrayHelper::index($attributes,null,'name');

        $data  = $this->variations($attributes);


        foreach ($data as $i=>$product){
            $model = ProductVariation::findOne(['sku'=>$product['sku']]);
            if($model){
               $data[$i]= $model->attributes;
            }
        }


        return $this->send('variations',['models'=>$data,'post_id'=>$id]);
    }
private function saveAttributes($id){
    $data =Yii::$app->request->post();

    try {


        foreach ($data['data'] as $product){
            $sku = $product['sku'];
            // unset($product['variations']['sku']);
            // $price = $product['']
            $model = ProductVariation::findOne(['sku'=>$sku]);
            if($model==null){
                $model = new ProductVariation();
            }
            $model->setAttributes($product);

            if($model->save()){
                Yii::$app->session->setFlash('success','Saved');
            }

        }

        return $this->send('variations',['models'=>$data['data'],'post_id'=>$id]);


//                Yii::$app->db->createCommand()->batchInsert('kodcommerce_product_variation', ['sku', 'post_id', 'created_at'], [
//                    [1, 'title1', '2015-04-10'],
//                    [2, 'title2', '2015-04-11'],
//                    [3, 'title3', '2015-04-12'],
//                ])->execute();

    }catch (Exception $e){
        throw $e;
    }


}
   private function variations($attributes){


       $array = [];
       foreach ($attributes as $key=>$model){

           foreach ($model as $d){
               $array[$key][] = $d['value'];
           }
       }

        if( empty( $array ) ) return [];

        function traverse( $array, $parent_ind ){
            $r = [];
            $pr = '';
            if( !is_numeric($parent_ind) )
                $pr = $parent_ind . '-';
            foreach( $array as $ind=>$el ) {
                if ( is_array( $el ) ) {
                    $r = array_merge( $r, traverse( $el, $pr . ( is_numeric( $ind ) ? '' : $ind ) ) );
                }else
                    if ( is_numeric( $ind ) )
                        $r[] = $pr . $el;
                    else
                        $r[] = $pr . $ind . '-' . $el;
            }
            return $r;
        }

        //1. Go through entire array and transform elements that are arrays into elements, collect keys
        $keys = [];$size = 1;
        foreach( $array as $key=>$elems ) {
            if ( is_array( $elems ) ) {
                $rr = [];
                foreach ( $elems as $ind=>$elem ) {
                    if ( is_array( $elem ) )
                        $rr = array_merge( $rr, traverse( $elem, $ind ) );
                    else $rr[] = $elem;
                }
                $array[ $key ] = $rr;
                $size *= count( $rr );
            }
            $keys[] = $key;
        }

        //2. Go through all new elems and make variations
        $rez = [];
        for( $i = 0; $i < $size; $i++ ) {
            $rez[ $i ] = array();
            $rez[$i]['sku'] = "P".$_GET['id'];
            foreach( $array as $key => $value ){
                $rez[ $i ]['stock' ] = 5;
                $rez[ $i ]['price' ] = 0;
                $current = current( $array[ $key ] );
                $rez[ $i ]['variations'][ $key ] = $current;
                $rez[$i]['sku'] .=$key[0].$rez[ $i ]['variations'][ $key ][0];
            }

            foreach( $keys as $key )
                if( !next( $array[ $key ] ) ) reset( $array[ $key ] );
                else break;
        }

       return $rez;


    }
private function send($template, $args){
      //  return  $this->renderAjax($template,$args);
    \Yii::$app->response->format = Response::FORMAT_JSON;
   return  [
        //'forceReload' => '#crud-datatable-pjax',
        'title' => "Variations",
        'content' => $this->renderAjax($template,$args),
        'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]).
            \yii\helpers\Html::submitButton('Save',['class'=>'btn btn-success'])
    ];
}
}