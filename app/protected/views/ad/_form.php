<?php
/* @var $this AdController */
/* @var $model Ad */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ad-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'userId'); ?>
		<?php echo $form->textField($model,'userId',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'userId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'systemId'); ?>
		<?php echo $form->textField($model,'systemId'); ?>
		<?php echo $form->error($model,'systemId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'brandId'); ?>
		<?php echo $form->textField($model,'brandId',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'brandId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'adObjectId'); ?>
		<?php echo $form->textField($model,'adObjectId',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'adObjectId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remoteId'); ?>
		<?php echo $form->textField($model,'remoteId',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'remoteId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remoteStatus'); ?>
		<?php echo $form->textField($model,'remoteStatus'); ?>
		<?php echo $form->error($model,'remoteStatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deleted'); ?>
		<?php echo $form->textField($model,'deleted'); ?>
		<?php echo $form->error($model,'deleted'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->