<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
/* @var $brands Brand[] */
/* @var $userBrandsIds integer[] */

Yii::app()->clientScript->registerCoreScript('jquery');

?>

<div class="modal form" id="user-modal-form">
	<div class="modal-header">
		<?php echo CHtml::link('x', array('user/index'), array(
			'class' => 'close',
			'data-dismiss' => 'modal',
		)); ?>
		<h3><?php echo $model->isNewRecord ? 'Добавление нового пользователя' : $model->name; ?></h3>
	</div>

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'user-form',
		'enableAjaxValidation'=>false,
		'htmlOptions' => array(
			'style' => 'margin: 0px;'
		),
	)); ?>
	<div class="modal-body">
		<?php if ($model->hasErrors()): ?>
			<div class="alert alert-error">
				<?php echo $form->errorSummary($model); ?>
			</div>
		<?php endif; ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255,'placeholder'=>$model->getAttributeLabel('name'))); ?>
		<?php echo $form->dropDownList($model,'roleId', $model->getRoleNamesForSelect()); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255,'placeholder'=>$model->getAttributeLabel('email'))); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>32,'maxlength'=>32,'placeholder'=>$model->getAttributeLabel('password'))); ?>
		<div>
			<div style="margin-bottom: 15px;">
				<a href="#" onclick="$('#user-modal-form input[type=checkbox]').attr('checked', 'checked'); return false;">Выбрать все</a>
				<a href="#" onclick="$('#user-modal-form input[type=checkbox]').removeAttr('checked'); return false;" class="pull-right">Сбросить</a>
			</div>
			<ul style="margin: 0;">
				<?php
				foreach ($brands as $brand) {
					echo '<li style="width: 115px; float: left; margin: 5px; list-style-type: none; line-height: 18px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">';
					echo CHtml::checkBox('userBrands[' . $brand->id . ']', in_array($brand->id, $userBrandsIds));
					echo ' ';
					echo CHtml::label(
						$brand->name,
						'userBrands_' . $brand->id . '',
						array(
							'style' => 'display: inline;',
							'title' => $brand->name,
						)
					);
					echo '</li>';
				}
				?>
			</ul>
		</div>
	</div>
	<div class="modal-footer">
		<?php echo CHtml::link('Отмена', array('user/index'), array(
			'class' => 'btn',
			'data-dismiss' => 'modal',
		)); ?>
		<?php
		echo CHtml::submitButton(
			$model->isNewRecord ? 'Создать' : 'Сохранить', array(
			'name' => 'save-user',
			'class' => 'btn btn-primary',
		)); ?>
	</div>
	<?php $this->endWidget(); ?>

</div><!-- form -->