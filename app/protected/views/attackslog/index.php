<?php
/* @var $this AttacksLogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Мониторинг атак'
);

$this->menu=array()
?>
<!--menu-->
<div class="row">
    <div class="span12">
        <!-- menu -->
        <nav>
            <ul class="nav nav-tabs">
                <li class="active">
                    <?php
                    echo CHtml::link(
                        'Информация по системе',
                        array(
                            '#',
                        )
                    );
                    ?>
                </li>
            </ul>
        </nav>
    </div>
</div>

<h3>Мониторинг атак</h3>

<?php
$this->Widget('ext.highcharts.HighchartsWidget', array(
    'options' => array(
        'title' => array('text' => 'Fruit Consumption'),
        'xAxis' => array(
            'categories' => array('Apples', 'Bananas', 'Oranges')
        ),
        'yAxis' => array(
            'title' => array('text' => 'Fruit eaten')
        ),
        'series' => array(
            array('name' => 'Jane', 'data' => array(1, 0, 4)),
            array('name' => 'John', 'data' => array(5, 7, 3))
        )
    )
));
?>


<?php $this->widget('zii.widgets.grid.CGridView',
    array(
        'id'=>'travel-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns'=>array(
            'date',
            'type',
            'ip',
            'referer',
            'user_agent',
            /*
            'private',
            */
        ),
        )
    );
?>