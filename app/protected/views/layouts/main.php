<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
    <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
    <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
    <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
    <!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		<meta name="description" content="">
        <meta http-equiv="X-Frame-Options" content="deny">
<!--		<meta name="viewport" content="width=device-width">-->

		<?php Yii::app()->clientScript->registerCssFile('/css/normalize.css'); ?>
		<?php Yii::app()->clientScript->registerCssFile('/css/main.css'); ?>
		<?php Yii::app()->clientScript->registerCssFile('/css/bootstrap.css'); ?>
		<?php Yii::app()->clientScript->registerCssFile('/css/bootstrap-responsive.css'); ?>
        <?php Yii::app()->clientScript->registerCssFile('/css/yandex.maps.css'); ?>
	</head>

    <body>
        <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        <script src="http://api-maps.yandex.ru/2.0-stable/?load=package.full&lang=ru-RU" type="text/javascript"></script>
        <?php echo $content; ?>
		<?php Yii::app()->clientScript->registerScriptFile('/js/vendor/modernizr-2.6.2.min.js');?>
        <?php Yii::app()->clientScript->registerScriptFile('/js/jquery.pnotify.min.js');?>
        <?php Yii::app()->clientScript->registerScriptFile('/js/bootstrap.min.js');?>
		<?php Yii::app()->clientScript->registerScriptFile('/js/plugins.js');?>
    </body>
</html>
