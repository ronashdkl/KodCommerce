<?php


namespace kodCommerce\services;


use kodCommerce\admin\models\PostAttributes;


use kodCommerce\admin\models\search\PostAttributesSearch;
use Yii;
use yii\helpers\VarDumper;

class RegisterPostUpdateSection
{

    public static function getPostAttributes($id=null){
        $searchModel = new PostAttributesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['post_id' => $id??Yii::$app->request->getQueryParam('id')]);
            return ['dataProvider'=>$dataProvider,'searchModel'=>$searchModel];
    }

    function view($sections){

        return array_merge($sections, [
            [
            'template'=>'@kodcommerce/admin/views/post/attributesForm',
            'arguments'=> array_merge(['postAttributes'=>new PostAttributes()], self::getPostAttributes())
        ],
        ]);
    }
    public function register(){

        if(YII_APP_ID!=2){
            return;
        }
        \Yii::$app->hooks->add_filter('plugin_post_update_section',[$this,'view']);
    }

    public static function getInstance(){
         return new self();
}
}