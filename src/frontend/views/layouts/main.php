<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
/* @var $this \yii\web\View */

/* @var $content string */
Yii::$app->themeAssetClass?Yii::$app->themeAssetClass::register($this):null;
\kodCommerce\assets\KodCommerceAsset::register($this);
\ronashdkl\kodCms\widgets\notify\assets\NotifyAssets::register($this);
if($this->title==null){
    $this->title = $this->params['config']('name');
}

$this->beginPage(); ?>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?php $this->head() ?>
</head>
<body data-spy="scroll" data-target=".fixed-top">
<?php $this->beginBody() ?>
  <?= $content?>
<!-- end of copyright -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
