<?php
/* @var $this AttacksLogController */
/* @var $model AttacksLog */

$this->breadcrumbs=array(
	'Мониторинг атак'=>array('index'),
	$model->id,
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

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'date',
		'type',
		'ip',
		'referer',
		'user_agent',
		'location',
		'globals_state',
	),
)); ?>
