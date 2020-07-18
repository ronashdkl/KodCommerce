<?php
/**
 * @var \kodcommerce\models\KodCommerceSettingsModel $setting
 */

?>


<div class="panel">
    <div class="panel-heading">
        <h3>Setting</h3>
    </div>
    <div class="panel-body">
       <?php
            foreach (Yii::$app->kodCommerceSetting->fieldData as $data){
                echo $data ."\n";
            }
       ?>
    </div>
</div>
