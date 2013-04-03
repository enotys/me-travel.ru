<?php
/* @var $this TravelController */
/* @var $model Travel */

$this->breadcrumbs=array(
	'Travels'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Travel', 'url'=>array('index')),
	array('label'=>'Manage Travel', 'url'=>array('admin')),
);
?>

<h1>Create Travel</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>