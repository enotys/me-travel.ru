<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="description" content="terminal for love">

    <?php Yii::app()->clientScript->registerCssFile('/css/jquery.terminal.css'); ?>
</head>

<body>
<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
<?php Yii::app()->clientScript->registerScriptFile('/js/terminal/jquery-1.7.1.min.js');?>
<?php Yii::app()->clientScript->registerScriptFile('/js/terminal/dterm.js');?>
<?php Yii::app()->clientScript->registerScriptFile('/js/terminal/jquery.mousewheel-min.js');?>
<?php Yii::app()->clientScript->registerScriptFile('/js/terminal/jquery.terminal-min.js');?>
<?php echo $content; ?>
</body>
</html>