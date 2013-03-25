<?php
/* @var $this AuthController */
/* @var $userModel User */

$this->breadcrumbs=array(
	'Вход в систему',
);


/* @var $form CActiveForm */
?>
<br/><br/><br/><br/><br/><br/><br/><br/>
<div class="span4 offset3 well">
	<legend>Вход в систему</legend>
	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'errorMessageCssClass' => 'alert alert-error',
	));
	echo $form->error($userModel, 'password');
	echo $form->error($userModel, 'email');
	?>
	<?php
	echo $form->textField($userModel, 'email', array(
			'id' => 'username',
			'class' => 'span4',
			'placeholder' => 'E-mail',
			'autofocus' => 'autofocus',
		)
	);
	echo $form->passwordField($userModel, 'password', array(
			'id' => 'password',
			'class' => 'span4',
			'placeholder' => 'Пароль',
		)
	);
	echo CHtml::submitButton('Войти', array(
		'class' => 'btn btn-info btn-block'
	));
	$this->endWidget();
	?>
</div>
