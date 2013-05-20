<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>Создание пользователя</h1>
<h3>Страница назодится в разработке</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>