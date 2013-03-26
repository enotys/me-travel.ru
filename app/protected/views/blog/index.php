<?php
/* @var $this BlogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Мои путешествия',
);

$this->menu=array(
	array('label'=>'Создать страницу', 'url'=>array('create')),
	array('label'=>'Редактировать', 'url'=>array('admin')),
);
?>
<!--menu-->
<div class="row">
    <div class="span12">
        <!-- menu -->
        <ul class="nav nav-tabs">
            <li class="active">
                <?php
                echo CHtml::link(
                    'Карта',
                    array(
                        'blog/index',
                    )
                );
                ?>
            </li>
            <!--                <li><a href="#">All</a></li>-->
        </ul>
    </div>
</div>
<!-- menu -->

<!-- alerts -->
<?php if (Yii::app()->user->hasFlash('error')): ?>
    <div class="alert alert-error"><?php echo Yii::app()->user->getFlash('error') ?></div>
<?php endif;
if (Yii::app()->user->hasFlash('info')): ?>
    <div class="alert alert-info"><?php echo Yii::app()->user->getFlash('info') ?></div>
<?php endif;
if (Yii::app()->user->hasFlash('success')): ?>
    <div class="alert alert-success"><?php echo Yii::app()->user->getFlash('success') ?></div>
<?php endif; ?>
<!-- alerts -->
<h1></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
