<?php
/* @var $this AdController */
/* @var $model ImportDataForm */
?>
<div class="span6 offset2 well">
	<legend>Импорт медиапланов</legend>
<?php
/* @var $form CActiveForm */
$form = $this->beginWidget('CActiveForm', array(
	'enableAjaxValidation' => false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
	'errorMessageCssClass' => 'alert alert-error',
));

echo $form->error($model, 'dataFile');
echo $form->error($model, 'year');
echo $form->error($model, 'month');
echo $form->error($model, 'systemId');
echo '<div>';
echo $form->label($model, 'dataFile');
echo $form->fileField($model, 'dataFile');
echo '</div>';
echo '<div>';
echo $form->label($model, 'year');
echo $form->dropDownList($model, 'year', array(
	2014 => '2014',
	2013 => '2013',
	2012 => '2012',
	2011 => '2011',
	2010 => '2010',
	2009 => '2009',
	2008 => '2008',
	2007 => '2007',
	2006 => '2006',
	2005 => '2005',
));
echo '</div>';
echo '<div>';
echo $form->label($model, 'month');
echo $form->dropDownList($model, 'month', array(
	1 => 'Январь',
	2 => 'Февраль',
	3 => 'Март',
	4 => 'Апрель',
	5 => 'Май',
	6 => 'Июнь',
	7 => 'Июль',
	8 => 'Август',
	9 => 'Сентябрь',
	10 => 'Октябрь',
	11 => 'Ноябрь',
	12 => 'Декабрь',
));
echo '</div>';
echo '<div>';
echo $form->label($model, 'systemId');
echo $form->dropDownList($model, 'systemId', ExternalConstants::$systemsForSelect);
echo '</div>';
echo '<div class="pull-right">';
echo CHtml::submitButton('Загрузить', array('class' => 'btn btn-success', 'style' => 'margin-right: 5px;'));
echo CHtml::link('Отмена', array('ad/index', 'systemName' => $this->systemName, 'year' => $this->year, 'month' => $this->month), array('class' => 'pull-right btn'));
echo '</div>';

$this->endWidget();
?>
</div>