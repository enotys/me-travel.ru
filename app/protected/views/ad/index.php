<?php
/* @var $this AdController */
/* @var $model AdStat */

$canEditMediaplans = Yii::app()->user->checkAccess('mediaplans:edit');
$editableClassName = $canEditMediaplans
	? '\Realweb\Widget\Grid\Column\Editable'
	: '\Realweb\Widget\Grid\Column\WrappedInSpan'
;
$editableClassParams = array(
	'primaryKeys' => array('systemId','adRemoteId','year','month'),
	'primaryKeysDelimiter' => AdController::PRIMARY_KEYS_DELIMITER,
	'target' => '/ad/updatestatfield',
	'jsOptions' => array(
		'cssclass' => 'inline-edit-form',
		'placeholder' => 'Ред.',
		'width' => '100%',
		'indicator' => '<div class="grid-view-loading" style="height: 16px;"></div>',
		'callback' => 'js:updateMediaplansTableRow',
		'onerror' => 'js:onErrorEditMediaplan',
	),
);

Yii::app()->clientScript->registerCssFile('/css/jquery.pnotify.default.css');
Yii::app()->clientScript->registerScriptFile('/js/jquery.cookie.js');
Yii::app()->clientScript->registerScriptFile('/js/table-fixed-header.js');
Yii::app()->clientScript->registerScriptFile('/js/jquery.pnotify.min.js');
Yii::app()->clientScript->registerScriptFile('/js/ad.js');

Yii::app()->clientScript->registerScript('init-controls', <<<JS

initBootstrapControls();

$('.table-fixed-header').fixedHeader();

$('#show-hide-filter').click(function() {
	var tableFilter = $('#mediaplans-table').find('.filters');
	if (tableFilter.is(':visible')) {
		$.cookie('mediaplans-table-show-filter', 0);
		tableFilter.hide();
	} else {
		$.cookie('mediaplans-table-show-filter', 1);
		tableFilter.show();
	}
	$('.table-fixed-header').resizeHeader();
});

JS
);

$this->breadcrumbs=array(
	'Медиапланы',
);

$this->menu=array(
	array('label'=>'Create Ad', 'url'=>array('create')),
	array('label'=>'Manage Ad', 'url'=>array('admin')),
);
?>

<!--calendar-->
<div class="container main_div">
	<div class="row calendar">
		<div class="span12">
			<div class="navbar">
				<div class="navbar-inner">
					<?php
					$dateMenuItems = array();

					$years = array();

					for ($year = date('Y')+1; $year > 2005; --$year) {
						$years[] = array(
							'label' => $year,
							'url' => array(
								'',
								'systemName' => $this->systemName,
								'year' => $year,
								'month' => $this->month,
							)
						);
					}

					$yearMenuItem = array(
						'itemOptions' => array('class' => 'dropdown'),
						'linkOptions' => array(
							'class' => 'dropdown-toggle',
							'data-toggle' => 'dropdown',
						),
						'label' => $this->year . ' <b class="caret"></b>',
						'items' => $years,
						'url' => '#',
					);

					$dateMenuItems[] = $yearMenuItem;

					for ($month = 1; $month <= 12; ++$month) {
						$dateMenuItems[] =
							array(
								'label' => Constants::$months[$month],
								'url' => array(
									'',
									'systemName' => $this->systemName,
									'year' => $this->year,
									'month' => $month,
								),
								'active' => $month == $this->month,
							);
					}
					$this->widget('zii.widgets.CMenu', array(
						'id' => 'date-menu',
						'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
						'items' => $dateMenuItems,
						'htmlOptions' => array(
							'class' => 'nav'
						),
						'encodeLabel' => false,
					));
					?>
				</div>
			</div>
		</div>
	</div>
	<!--calendar-->
	<!--menu-->
	<div class="row">
		<div class="span12">
			<?php
			if (Yii::app()->user->checkAccess('reports:download')) {
				// @todo не оптимальный вывод. Надо сделать с использованием CHtml.
				echo '<div class="pull-right btn-group"><button class="btn btn-success dropdown-toggle" data-toggle="dropdown" style="margin-left: 5px;"><i class="icon-download icon-white"></i> Выгрузить отчёт <span class="caret"></span></button>';
				echo '<ul class="dropdown-menu">';
				echo '<li>' . CHtml::link('CSV', array('ad/download', 'systemName'=>$this->systemName, 'year' => $this->year, 'month' => $this->month, 'format' => 'csv')) . '</li>';
				echo '<li>' . CHtml::link('Excel', array('ad/download', 'systemName'=>$this->systemName, 'year' => $this->year, 'month' => $this->month, 'format' => 'xlsx')) . '</li>';
				echo '</ul></div>';
			}
			if (Yii::app()->user->checkAccess('mediaplans:upload')) {
				echo CHtml::link('<i class="icon-upload icon-white"></i> Загрузить медиаплан', array('ad/upload', 'systemName'=>$this->systemName, 'year' => $this->year, 'month' => $this->month), array('class' => 'pull-right btn btn-primary'));
			}
			?>
			<ul class="nav nav-tabs">
				<li<?php if ($this->systemName == ExternalConstants::SYSTEM_YANDEX_NAME) echo ' class="active"'; ?>>
					<?php
					echo CHtml::link(
						ExternalConstants::SYSTEM_YANDEX_LABEL,
						array(
							'ad/index',
							'systemName' => ExternalConstants::SYSTEM_YANDEX_NAME,
							'year' => $this->year,
							'month' => $this->month,
						)
					);
					?>
				</li>
				<li<?php if ($this->systemName == ExternalConstants::SYSTEM_GOOGLE_NAME) echo ' class="active"'; ?>>
					<?php
					echo CHtml::link(
						ExternalConstants::SYSTEM_GOOGLE_LABEL,
						array(
							'ad/index',
							'systemName' => ExternalConstants::SYSTEM_GOOGLE_NAME,
							'year' => $this->year,
							'month' => $this->month,
						)
					);
					?>
				</li>
				<!--                <li><a href="#">All</a></li>-->
			</ul>
		</div>
	</div>
	<!--menu-->
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
    <button class="btn btn-small" id="show-hide-filter"><i class="icon-filter"></i></button>
	<?php
	$this->widget('application\components\Widget\Grid\Mediaplans', array(
		'id' => 'mediaplans-table',
		'dataProvider'=>$model->search(),
		'ajaxUpdate' => false,
		'filter'=>$model,
		'itemsCssClass' => 'table table-hover table-striped table-fixed-header',
		'pagerCssClass' => 'pagination pagination-centered',
		'template' => '{items}{pageSize}{pager}',
		'afterAjaxUpdate' => 'function(id, data) {initBootstrapControls();}',//@todo при AJAX обновлении не пересоздаются редактируемые поля.
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
				'class' => 'CCheckBoxColumn',
				'selectableRows' => 2,
			),
			array(
				'class' => '\Realweb\Widget\Grid\Column\WrappedInSpan',
				'name' => 'ad.brand.name',
				'htmlOptions' => array('class' => 'td1'),
				'filter' => CHtml::activeTextField($model->searchAd->searchBrand, 'name'),
			),
			array(
				'class' => '\Realweb\Widget\Grid\Column\WrappedInSpan',
				'name' => 'ad.adObject.name',
				'htmlOptions' => array('class' => 'td1'),
				'filter' => CHtml::activeTextField($model->searchAd->searchAdObject, 'name'),
			),
			array(
				'name' => 'ad.text',
				'class' => '\application\components\Widget\Grid\Column\AdDescriptionColumn',
				'htmlOptions' => array('class' => 'info_td td2'),
				'filter' => CHtml::activeTextField($model->searchAd, 'title', array('placeholder' => 'Текст или ID')),
				'primaryKeysDelimiter' => AdController::PRIMARY_KEYS_DELIMITER,
				'canEditAdRemoteId' => $canEditMediaplans,
			),
			array(
				'name' => 'clicks',
				'htmlOptions' => array('class' => 'leftBorder'),
			),
			array(
				'name' => 'clickPrice',
				'type' => 'float',
			),
			array(
				'name' => 'spend',
				'type' => 'float',
			),
			array(
				'class' => $editableClassName,
				'name' => 'maxPrognosisClicks',
				'header' => 'Клики',
				'htmlOptions' => array('class' => 'leftBorder'),
				'spanHtmlOptions' => array('data-field-name' => 'maxPrognosisClicks'),
			) + ($canEditMediaplans ? $editableClassParams : array()),
			array(
				'class' => $editableClassName,
				'name' => 'maxPrognosisClickPrice',
				'header' => 'Цена клика',
				'type' => 'float',
				'spanHtmlOptions' => array('data-field-name' => 'maxPrognosisClickPrice'),
			) + ($canEditMediaplans ? $editableClassParams : array()),
			array(
				'class' => '\Realweb\Widget\Grid\Column\WrappedInSpan',
				'name' => 'maxPrognosisBudget',
				'header' => 'Бюджет',
				'type' => 'float',
				'spanHtmlOptions' => array('data-field-name' => 'maxPrognosisBudget'),
			),
			array(
				'class' => '\Realweb\Widget\Grid\Column\WrappedInSpan',
				'name' => 'plannedClicks',
				'header' => 'Клики',
				'htmlOptions' => array('class' => 'leftBorder'),
				'spanHtmlOptions' => array('data-field-name' => 'plannedClicks'),
			),

			array(
				'class' => $editableClassName,
				'name' => 'plannedClickPrice',
				'header' => 'Цена клика',
				'type' => 'float',
				'spanHtmlOptions' => array('data-field-name' => 'plannedClickPrice'),
			) + ($canEditMediaplans ? $editableClassParams : array()),
			array(
				'class' => $editableClassName,
				'name' => 'plannedBudget',
				'header' => 'Бюджет',
				'type' => 'float',
				'spanHtmlOptions' => array('data-field-name' => 'plannedBudget'),
			) + ($canEditMediaplans ? $editableClassParams : array()),
			array(
				'class' => '\application\components\Widget\Grid\Column\AdRemoteStatusColumn',
				'name' => 'ad.remoteStatus',
				'htmlOptions' => array('class' => 'statusTd leftBorder'),
				'filter' => CHtml::activeDropDownList(
					$model->searchAd,
					'remoteStatus',
					array('' => '') + Ad::$remoteStatusDescriptions
				),
			),
			array(
				'class' => '\Realweb\Widget\Grid\Column\WrappedInSpan',
				'name' => 'dailyBudget',
				'type' => 'float',
				'spanHtmlOptions' => array('data-field-name' => 'dailyBudget'),
			),
		),
	));
	?>
