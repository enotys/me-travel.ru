<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */
/* @var $allBrandsCount integer */

$this->breadcrumbs=array(
	'Пользователи',
);

$this->menu=array(
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);

$canManageUsers = Yii::app()->user->checkAccess('users:manage');

if (Yii::app()->user->hasFlash('error')) {
?>
	<div class="alert alert-error"><?php echo Yii::app()->user->getFlash('error') ?></div>
<?php
}

if (Yii::app()->user->hasFlash('success')) {
	?>
<div class="alert alert-success"><?php echo Yii::app()->user->getFlash('success') ?></div>
<?php
}
?>

<?php if ($canManageUsers)  {
		echo CHtml::link('<i class="icon-plus"></i>', array('user/create'), array(
			'id' => 'add-user-link',
			'class' => 'btn btn-small',
		));
	}
?>
<?php

$this->widget('\Realweb\Widget\Grid\Base', array(
	'id' => 'users-table',
	'dataProvider'=>$dataProvider,
	'itemsCssClass' => 'table table-hover table-striped',
	'pagerCssClass' => 'pagination pagination-centered',
	'template' => '{items}{summary}{pager}',
	'pager' => array(
		'htmlOptions' => array('class' => 'pagination'),
		'selectedPageCssClass' => 'active',
		'internalPageCssClass' => '',
		'prevPageLabel' => '«',
		'previousPageCssClass' => '',
		'nextPageLabel' => '»',
		'nextPageCssClass' => '',
		'hiddenPageCssClass' => 'disabled',
		'header' => '',
	),
	'columns' => array(
		array(
			'name' => 'name',
		),
		array(
			'name' => 'roleId',
			'value' => 'User::getRoleName($data->roleId)',
		),
		array(
			'name' => 'email',
		),
		array(
			'name' => 'password',
			'type' => 'html',
			'value' =>
			$canManageUsers
				? 'CHtml::link("<b class=\"icon-edit dotted\" />", array("user/update", "id" => $data->id))'
				: '"Нет доступа"'
				,
		),
		array(
			'class' => 'application\components\Widget\Grid\Column\UserBrandsCountColumn',
			'spanHtmlOptions' => array('class' => 'dotted'),
			'name' => 'brandsCount',
			'allBrandsCount' => $allBrandsCount,
		),
	),
));
?>
