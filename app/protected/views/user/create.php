<?php
/* @var $this UserController */
/* @var $model User */
/* @var $brands Brand[] */
/* @var $userBrandsIds integer[] */

$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	'Добавление нового пользователя',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
echo $this->renderPartial('_form', array(
	'model'=>$model,
	'brands'=>$brands,
	'userBrandsIds'=>$userBrandsIds,
)); ?>