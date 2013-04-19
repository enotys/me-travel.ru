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
        <?php echo CHtml::link(
            '<i class="icon-map-marker icon-white"></i> Добавить заметку',
            array(
                'travel/add',
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
                        'Карта',
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
<h3><?php echo Yii::app()->user->getModel()->blog->title ?> </h3>

<?php
    $mapsLabels = array();
    $calendar = array();
    $travelData = Yii::app()->user->getModel()->travels;
?>
<div id="mapId" style="width: 800px; height: 430px"></div>

<script type="text/javascript">
    ymaps.ready(init);

    var myMap;
    var myPlacemarks = [];

    function init(){
        myMap = new ymaps.Map (
            "mapId", {
                center: [23.354486,0.486374],
                zoom: 1
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

<?php
    foreach ($travelData as $travelInfo) {
        $travelYear = date('Y', $travelInfo->date);
        $travelMonthNumber = date('n', $travelInfo->date);
        if (!isset($calendar[$travelYear])) {
            $calendar[$travelYear] = array(
                $travelMonthNumber => array(
                    $travelInfo
                )
            );
        } else {
            $calendar[$travelYear][$travelMonthNumber][] = $travelInfo;
        }
    }

    foreach ($calendar as $year => $yearData) {

        echo "<div class='year'><header><h4>".$year."</h4></header>";

        foreach ($yearData as $month => $travelPlaces) {

            echo"<ul class='month'><li><div><h5>".Constants::$months[$month]."</h5><nav><ul>";

            foreach ($travelPlaces as $place) {
                echo "<li>".CHtml::link(
                    $place->title,
                    array(
                        'travel/view',
                        'id'=>$place->id
                    )
                ) ;
            }
            echo "</li></ul></nav></li></ul>";
        }
        echo "</div>";
    }
?>
