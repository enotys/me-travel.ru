<?php
/* @var $this BlogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Мои путешествия',
);

$this->menu=array(
	array('label'=>'Создать страницу', 'url'=>array('create')),
	array('label'=>'Редактировать', 'url'=>array('admin')),
);
?>
<!--menu-->
<div class="row">
    <div class="span12">
        <!-- menu -->
        <ul class="nav nav-tabs">
            <li class="active">
                <?php
                echo CHtml::link(
                    'Карта',
                    array(
                        'blog/index',
                    )
                );
                ?>
            </li>
            <li><a href="#">Мой профиль</a></li>
        </ul>
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
<h3><?php echo Yii::app()->user->getModel()->blog->title ?> </h3>

<?php
    $mapsLabels = array();
    $travelData = Yii::app()->user->getModel()->travels;

    foreach ($travelData as $travelInfo) {
        $mapsLabels[]= $travelInfo->maps_label;
    }
    echo print_r($mapsLabels, 1);
?>
<?php

?>
<div id="mapId" style="width: 1100px; height: 750px"></div>

<script type="text/javascript">
    ymaps.ready(init);

    var myMap;
    var myPlacemarks = [];

    function init(){
        myMap = new ymaps.Map (
            "mapId", {
                center: [23.354486,0.486374],
                zoom: 2
            }
        );
        <?php
            foreach ($travelData as $travelInfo) {
                echo "
                    myPlacemarks.push(new ymaps.Placemark([".
                        $travelInfo->maps_label."], {
                        content:'".$travelInfo->title."',
                        balloonContent:'".$travelInfo->title."'
                    }));
                ";
            }
        ?>
       console.log(myPlacemarks);
       for(var i = 0; i < myPlacemarks.length; i++) {
           myMap.geoObjects.add(myPlacemarks[i])
       }
    }
</script>
<?php //$this->widget('zii.widgets.CListView', array(
//	'dataProvider'=>$dataProvider,
//	'itemView'=>'_view',
//)); ?>
