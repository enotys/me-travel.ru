<?php
/* @var $this UserController */
/* @var $model User */
/* @var $brands Brand[] */
/* @var $userBrandsIds integer[] */

$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
//	$model->name=>array('view','id'=>$model->id),
	'Редактирование',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'View User', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
echo $this->renderPartial('_form', array(
	'model'=>$model,
	'brands'=>$brands,
	'userBrandsIds'=>$userBrandsIds,
));
?>