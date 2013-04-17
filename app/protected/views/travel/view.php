<?php
/* @var $this TravelController */
/* @var $model Travel */

$model->user_id = Yii::app()->user->id;
?>
<!--menu-->
<div class="row">
    <div class="span12">
        <?php echo CHtml::link(
            '<i class="icon-map-marker icon-white"></i> Редактировать заметку',
            array(
                'travel/edit',
            ),
            array(
                'class' => 'pull-right btn btn-primary'
            )
        );
        ?>
        <!-- menu -->
        <nav>
            <ul class="nav nav-tabs">
                <li class="active">
                    <?php
                    echo CHtml::link(
                        'Главная',
                        array(
                            'blog/index',
                        )
                    );
                    ?>
                </li>
                <li><a href="#">Мой профиль</a></li>
            </ul>
        </nav>
    </div>
</div>
<!-- menu -->

<!-- alerts -->
<?php if (Yii::app()->user->hasFlash('error')): ?>
    <div class="alert alert-error"><?php echo Yii::app()->user->getFlash('error') ?></div>
<?php endif;
if (Yii::app()->user->hasFlash('info')): ?>
    <div class="alert alert-info"><?php echo Yii::app()->user->getFlash('info') ?></div>
<?php endif;
if (Yii::app()->user->hasFlash('success')): ?>
    <div class="alert alert-success"><?php echo Yii::app()->user->getFlash('success') ?></div>
<?php endif; ?>
<!-- alerts -->
<header><h3><?php echo $model->title ?></h3></header>

<?php
$mapsLabels = array();
$calendar = array();
?>
<?php

?>
<script type="text/javascript">
    ymaps.ready(init);

    var myMap;
    var myPlacemark;

    function init(){
        myMap = new ymaps.Map (
            "mapId", {
                center: [<?php echo $model->maps_label ?>],
                zoom: 2
            }
        );
        // Создание экземпляра элемента управления
        myMap.controls.add(
            new ymaps.control.ZoomControl()
        );
        myMap.controls.add('scaleLine');
        myPlacemark = new ymaps.Placemark(
            [<?php echo $model->maps_label ?>],
            {
                content:'<?php echo $model->title ?>',
                balloonContent:'<?php echo $model->title ?>'
            }
        );
        myMap.geoObjects.add(myPlacemark);
    }
</script>

<?php
/** @var $form CActiveForm */

echo '<div id="mapId" style="width: 600px; height: 400px"></div>';
echo '<br/>';
echo '<div id="travel_content">'.$model->text.'</div>';
?>
