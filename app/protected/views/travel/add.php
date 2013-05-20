<?php
/* @var $this TravelController */
/* @var $model Travel */

Yii::app()->clientScript->registerCoreScript('jquery');
Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');

$this->breadcrumbs=array(
    'Travels'=>array('index'),
    'добавление заметки',
);

$this->menu=array(
    array('label'=>'List Travel', 'url'=>array('index')),
    array('label'=>'Manage Travel', 'url'=>array('admin')),
);
$model->user_id = Yii::app()->user->id;

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
    <header><h3>Добавление заметки о путешествии</h3></header>

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
                    center: [23.354486,0.486374],
                    zoom: 2
                }
            );
            // Создание экземпляра элемента управления
            myMap.controls.add(
                new ymaps.control.ZoomControl()
            );

            myMap.controls.add('searchControl');
            myMap.controls.add('scaleLine');
            myPlacemark = new ymaps.Placemark([23.354486,0.486374], {
                hintContent: 'Подвинь меня!'
            }, {
                draggable: true // Метку можно перетаскивать, зажав левую кнопку мыши.
            });
            myPlacemark.events.add(
                'dragend',
                function(e) {
                    // Получение ссылки на объект, который был передвинут.
                    var thisPlacemark = e.get('target');
                    // Определение координат метки
                    var coords = thisPlacemark.geometry.getCoordinates();
                    document.getElementById('maps_label').setAttribute('value',coords);
                }
            );
            myMap.geoObjects.add(myPlacemark);
        }
    </script>

<?php
    /** @var $form CActiveForm */
	$form = $this->beginWidget(
        'CActiveForm',
        array(
            'id' => 'addTravel',
            'errorMessageCssClass' => 'alert alert-error',
        )
    );
    echo $form->error($model, 'title');
    echo $form->error($model, 'maps_label');
    echo $form->error($model, 'date');
    echo $form->error($model, 'text');
    echo $form->textField(
        $model,
        'title',
        array(
            'id' => 'title',
            'class' => 'span4',
            'placeholder' => 'Название места',
            'autofocus' => 'autofocus',
        )
    );

    echo '<div id="mapId" style="width: 600px; height: 400px"></div>';
    echo "<br/>";
    echo $form->textField(
        $model,
        'maps_label',
        array(
            'id' => 'maps_label',
            'class' => 'span4',
            //'placeholder' => '0.0,0.0',
            //'disabled' => 'disabled',
        )
    );
    echo "<br/>";
    echo $form->dateField(
        $model,
        'date',
        array(
            'id' => 'date',
            'class' => 'span4',
            'placeholder' => 'ДД-ММ-ГГГГ',
        )
    );
    echo "<br/>";
    $this->widget('ImperaviRedactorWidget', array(
        // можно использовать пару имя модели - имя свойства
        'model' => $model,
        'attribute' => 'text',

        // немного опций, см. http://imperavi.com/redactor/docs/
        'options' => array(
            'lang' => 'ru',
//            'toolbar' => true,
            'iframe' => true,
            'css' => 'wym.css',
        ),
    ));
//    echo $form->textArea(
//        $model,
//        'text',
//        array(
//            'id' => 'text',
//            'class' => 'span4',
//            'placeholder' => 'Текст',
//        )
//    );
    echo "<br/>";
    echo $form->labelEx(
        $model,
        'private',
        array(
            'style'=>'display:inline; padding:5px'
        )
    );
    echo $form->checkBox(
        $model,
        'private'
    );
    echo $form->hiddenField($model,'user_id');
    echo "<br/>";
    echo "<br/>";
    echo CHtml::submitButton(
        'Добавить',
        array(
            'class' => 'btn btn-info btn-block',
            'style' => 'width:100px',
        )
    );
    echo CHtml::fileField(
        'image'
    );

$this->endWidget();
?>

