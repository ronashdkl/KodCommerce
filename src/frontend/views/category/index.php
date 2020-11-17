<?php
/**
 * @var $widgets_top \kodcommerce\widgets\KodCommerceProductWidget[]
 * @var $widgets_left \kodcommerce\widgets\KodCommerceProductWidget[]
 * @var $widgets_bottom \kodcommerce\widgets\KodCommerceProductWidget[]
 * @var $searchModel \kodCommerce\frontend\models\KodCommerceProductSearch
 * @var $dataProvider \yii\data\ActiveDataProvider
 */
use yii\bootstrap4\Modal;

$leftWidgetsNumber = count(Yii::$app->kodCommerceSetting->activeWidgets('catalog.left')??[]);

?>

<section id="page-content" class="sidebar-left">
    <div class="container">
        <div class="row">
            <!-- Content-->
            <div class="content col-lg-<?= $leftWidgetsNumber > 0 ? 9 : 12?> ">
                <?php
                $active_widgets = Yii::$app->kodCommerceSetting->activeWidgets('catalog.top');
                foreach ($widgets_top as $widget){
                    if(isset($widget['class']) && in_array($widget['class'],$active_widgets)){
                        $data = ['model'=>$searchModel];
                        if(isset($widget['data'])){
                            $data = \yii\helpers\ArrayHelper::merge($data,$widget['data']);
                        }
                        echo $widget['class']::widget($data);
                    }
                }
                ?>
                <!--Product list-->
                <div class="shop">
                    <?= ($dataProvider->count > 0) ? $this->render('_wrapper',['dataProvider'=>$dataProvider,'leftWidgetsNumber'=>$leftWidgetsNumber]):$this->render('_empty')
                    ?>
                </div>

                <!--End: Product list-->
                <?php
                $active_widgets = Yii::$app->kodCommerceSetting->activeWidgets('catalog.bottom');
                foreach ($widgets_bottom as $widget){
                    if(isset($widget['class']) && in_array($widget['class'],$active_widgets)){
                        $data = ['model'=>$searchModel];
                        if(isset($widget['data'])){
                            $data = \yii\helpers\ArrayHelper::merge($data,$widget['data']);
                        }
                        echo $widget['class']::widget($data);
                    }
                }
                ?>
            </div>
            <!-- end: Content-->
            <?php
            if($leftWidgetsNumber>0){
            ?>
            <!-- Sidebar-->
            <div class="sidebar col-lg-3">
                <!--widget newsletter-->


                <?php
                $active_widgets = Yii::$app->kodCommerceSetting->activeWidgets('catalog.left');
                foreach ($widgets_left as $widget){
                    if(isset($widget['class']) && in_array($widget['class'],$active_widgets)){
                        $data = ['model'=>$searchModel];
                        if(isset($widget['data'])){
                            $data = \yii\helpers\ArrayHelper::merge($data,$widget['data']);
                        }
                        echo $widget['class']::widget($data);
                    }
                }
                ?>

            </div>
            <!-- end: Sidebar-->
            <?php } ?>
        </div>
    </div>
</section>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "size"=>Modal::SIZE_EXTRA_LARGE,

    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
