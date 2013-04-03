<?php
/* @var $this TravelController */
/* @var $model Travel */

$this->breadcrumbs=array(
	'Travels'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Travel', 'url'=>array('index')),
	array('label'=>'Create Travel', 'url'=>array('create')),
	array('label'=>'View Travel', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Travel', 'url'=>array('admin')),
);
?>

<h1>Update Travel <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>