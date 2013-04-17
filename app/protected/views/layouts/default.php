<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<!--navigation-->
<div class="navbar navbar-inverse navi">
	<div class="navbar-inner">
		<div class="container">
			<div>
				<?php
				$this->widget('zii.widgets.CMenu',array(
					'items'=>array(
						array('label'=>'Заметки', 'url'=>array('blog/index'), 'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Пользователи', 'url'=>array('user/index'), 'visible'=>Yii::app()->user->checkAccess('users:view'))
					),
					'htmlOptions' => array('class' => 'nav'),
					'activeCssClass' => 'active',
				));
				$this->widget('zii.widgets.CMenu',array(
					'items'=>array(
						array('label' => 'Вход', 'url'=>array('/auth/login'), 'visible'=>Yii::app()->user->isGuest),
						array('label' => Yii::app()->user->name . ' (' . Yii::app()->user->getRoleName() . ')', 'visible'=>!Yii::app()->user->isGuest, 'template' => '<i class="icon-white icon-user"></i>{menu}'),
						array('label' => 'Выход', 'url'=>array('/auth/logout'), 'visible'=>!Yii::app()->user->isGuest),
					),
					'htmlOptions' => array(
						'class' => 'nav pull-right',
					)
				));
				?>
			</div>
		</div>
	</div>
</div>
<!--navigation-->

<div class="container main_div">
	<div class="row">
		<div class="span12">
			<?php echo $content; ?>
		</div>
	</div>
</div>
<?php $this->endContent(); ?>