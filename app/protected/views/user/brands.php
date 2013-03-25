<?php
/* @var $this UserController */
/* @var $userModel User */
/* @var $brands Brand[] */
/* @var $userBrandsIds integer[] */

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(
	'Пользователи' => '/user',
	'Бренды'
);
?>

<div class="modal" id="userBrandModal">
	<div class="modal-header">
		<?php echo CHtml::link('x', array('user/index'), array(
			'class' => 'close',
			'data-dismiss' => 'modal',
		)); ?>
		<h3><?php echo $userModel->name; ?> - бренды</h3>
	</div>
	<?php echo CHtml::beginForm(
	'',
	'post',
	array(
		'id' => 'user-brands-form',
		'style' => 'margin: 0px;',
	)
); ?>
	<div class="modal-body">
		<div style="margin-bottom: 15px;">
			<a href="#" onclick="$('#user-brands-form input[type=checkbox]').attr('checked', 'checked'); return false;">Выбрать все</a>
			<a href="#" onclick="$('#user-brands-form input[type=checkbox]').removeAttr('checked'); return false;" class="pull-right">Сбросить</a>
		</div>
		<div style="overflow-y: auto; max-height: 250px;">
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
	<?php echo CHtml::submitButton('Сохранить', array(
		'name' => 'save-user-brands',
		'class' => 'btn btn-primary',
	)) ?>
	</div>
	<?php echo CHtml::endForm(); ?>
</div>