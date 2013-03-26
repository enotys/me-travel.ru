<?php
/* @var $this BlogController */
/* @var $model Blog */

$this->breadcrumbs=array(
	'Путешествия'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Мои путешествия', 'url'=>array('index')),
	array('label'=>'Создать заметку', 'url'=>array('create')),
	array('label'=>'Редактировать заметку', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить заметку', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление заметками', 'url'=>array('admin')),
);
?>

<h1>Мои путешествия #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'fio',
		'user_id',
		'deleted',
	),
)); ?>
