<?php

use yii\bootstrap4\Modal;

$leftWidgetsNumber = count($widgets_left??[]);

?>

<section id="page-content" class="sidebar-left">
    <div class="container">
        <div class="row">
            <!-- Content-->
            <div class="content col-lg-<?= $leftWidgetsNumber > 0 ? 9 : 12?> ">
                <?php
                foreach ($widgets_top as $widget){
                    if(isset($widget['class'])){
                        $data = $widget['data']??null;
                        echo $widget['class']::widget($data);
                    }
                }
                ?>
                <!--Product list-->
                <div class="shop">
                    <div class="grid-layout grid-<?= $leftWidgetsNumber > 0 ? 3 : Yii::$app->kodCommerceSetting->get('catalog.display.grid')??3 ?>-columns grid-loaded" data-item="grid-item">


                       <?php

                       echo \yii\widgets\ListView::widget([
                           'dataProvider'=>$dataProvider,
                           'itemView'=>'_product'
                       ])
                       ?>
                    </div>
                    <hr>
                    <?php
                    foreach ($widgets_bottom as $widget){
                        if(isset($widget['class'])){
                            $data = $widget['data']??null;
                            echo $widget['class']::widget($data);
                        }
                    }
                    ?>
                </div>
                <!--End: Product list-->
            </div>
            <!-- end: Content-->
            <?php
            if($leftWidgetsNumber>0){
            ?>
            <!-- Sidebar-->
            <div class="sidebar col-lg-3">
                <!--widget newsletter-->


                <?php
                foreach ($widgets_left as $widget){
                    if(isset($widget['class'])){
                        $data = $widget['data']??null;
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
