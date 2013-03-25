<?php

/**
 * Mediaplans management controller.
 *
 * @author serj
 */
class AdController extends Controller
{
	const PRIMARY_KEYS_DELIMITER = ':::';

	public $pageTitle = 'Медиапланы';
	public $year;
	public $month;
	public $systemName;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		$rules = array();
		if (Yii::app()->user->checkAccess('mediaplans:view')) {
			$rules[] = array('allow',
				'actions'=>array(
					'index',
				),
				'users'=>array('*'),
			);
		}
		if (Yii::app()->user->checkAccess('mediaplans:upload')) {
			$rules[] = array('allow',
				'actions'=>array(
					'upload',
				),
				'users'=>array('*'),
			);
		}
		if (Yii::app()->user->checkAccess('mediaplans:edit')) {
			$rules[] = array('allow',
				'actions'=>array(
					'updatestatfield',
					'updateadremoteidfield'
				),
				'users'=>array('*'),
			);
		}
		$rules[] = array('deny','users'=>array('*'));

		return $rules;
	}

	public function init()
	{
		parent::init();
		$this->year = Yii::app()->request->getParam('year', date('Y'));
		$this->month = Yii::app()->request->getParam('month', date('n'));
		$this->systemName = Yii::app()->request->getParam(
			'systemName',
			ExternalConstants::SYSTEM_YANDEX_NAME
		);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model = new AdStat('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AdStat'])) {
			$model->attributes=$_GET['AdStat'];
		}
		$model->searchAd = new Ad('search');
		if (isset($_GET['Ad'])) {
			$model->searchAd->attributes = $_GET['Ad'];
		}
		$model->searchAd->searchBrand = new Brand('search');
		if (isset($_GET['Brand'])) {
			$model->searchAd->searchBrand->attributes = $_GET['Brand'];
		}
		$model->searchAd->searchAdObject = new AdObject('search');
		if (isset($_GET['AdObject'])) {
			$model->searchAd->searchAdObject->attributes = $_GET['AdObject'];
		}
		$model->systemId = ExternalConstants::getSystemIdByName(
			$this->systemName
		);
		$model->year = $this->year;
		$model->month = $this->month;
		/* @var $user WebUser */
		$user = Yii::app()->user;
		if (!Yii::app()->user->checkAccess('mediaplans:view:all')) {
			$model->displayBrandsIds = $user->getAllowedBrandsIds();
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Uploading mediaplans page.
	 */
	public function actionUpload() {
		$model = new ImportDataForm();
		if (isset($_POST['ImportDataForm'])) {
			$model->attributes = $_POST['ImportDataForm'];
			$model->dataFile = CUploadedFile::getInstance($model, 'dataFile');
			if ($model->validate()) {
				$filePath = $model->dataFile->getTempName();
				$dataSource =
					new \Realweb\Data\Reader\File\Csv($filePath);
				$dataSource->setDelimiter(';');
				$dataSource->setSourceCharset('CP1251');
				$dataSource->setTargetCharset('UTF-8');
				if (count($dataSource->getData()) > 100) {
					$uploadsDirPath =
						Yii::app()->params['uploadsDirPath'];
					if (!file_exists($uploadsDirPath)) {
						mkdir($uploadsDirPath, 0777, true);
					}
					$fileName =
						time() . '-' .
						$model->year . '-' .
						$model->month . '-' .
						$model->systemId . '-' .
						Yii::app()->user->id .
						'.csv';
					$filePath = $uploadsDirPath . '/' . $fileName;
					$model->dataFile->saveAs($filePath);
					Yii::app()->user->setFlash(
						'info',
						'Файл добавлен в очередь на импорт. В течение 10 минут данные будут добавлены в систему.'
					);
					$this->redirect(
						array(
							'ad/index',
							'systemName' => ExternalConstants::getSystemNameById($model->systemId),
							'year' => $model->year,
							'month' => $model->month,
						)
					);
				} else {
					$dataStorage =
						new application\components\Data\Writer\Db\Mediaplans(
							$model->year,
							$model->month,
							$model->systemId,
							Yii::app()->user->id
						);
					$dataImporter = new \application\components\Data\Importer\Mediaplans(
						$dataSource,
						$dataStorage
					);
					try {
						$dataImporter->import(false, true);
						Yii::app()->user->setFlash('success', 'Данные успешно загружены.');
						$this->redirect(
							array(
								'ad/index',
								'systemName' => ExternalConstants::getSystemNameById($model->systemId),
								'year' => $model->year,
								'month' => $model->month,
							)
						);
					}
					catch (Exception $e) {
						Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
						$model->addError(
							'dataFile',
							'Не удалось обработать файла из-за технических проблем на сервере. Приносим свои извинения. В ближайшее время мы попытаемся исправить данную проблему.'
						);
					}
				}
			}
		} else {
			$model->systemId = ExternalConstants::getSystemIdByName($this->systemName);
			$model->month = $this->month;
			$model->year = $this->year;
		}

		$this->render('upload', array(
			'model' => $model,
		));
	}

	public function actionUpdateStatField() {
		$value = Yii::app()->request->getParam('value');
		if ($value === null) {
			throw new CHttpException(400, 'Не указано значение.');
		}
		$value = str_replace(',', '.', $value);

		$typeAndId = Yii::app()->request->getParam('id', '');
		$typeAndIdPair = explode(self::PRIMARY_KEYS_DELIMITER, $typeAndId);

		if (count($typeAndIdPair) != 5) {
			throw new CHttpException(400, 'Некорректное число параметров.');
		}
		$fieldName = $typeAndIdPair[0];
		if (!in_array($fieldName, $this->allowedFieldsForUpdate)) {
			throw new CHttpException(400, 'Попытка обновить недопустимое поле.');
		}

		$adStat = AdStat::model()->findByPk(array(
			'systemId' => $typeAndIdPair[1],
			'adRemoteId' => $typeAndIdPair[2],
			'year' => $typeAndIdPair[3],
			'month' => $typeAndIdPair[4],
		));

		if ($adStat === null) {
			throw new CHttpException(404, 'Нет указанной записи.');
		}

		$adStat->$fieldName = $value;
		unset($adStat->clicks);
		unset($adStat->clickPrice);
		unset($adStat->spend);
		if ($adStat->validate(array($fieldName)) && $adStat->save(false)) {
			$mediaplanAttributes = $adStat->attributes;
			/** @var $formatter \Formatter */
			$formatter = Yii::app()->format;
			$mediaplanAttributes['clickPrice'] =
				$formatter->formatFloat($mediaplanAttributes['clickPrice']);
			$mediaplanAttributes['spend'] =
				$formatter->formatFloat($mediaplanAttributes['spend']);
			$mediaplanAttributes['maxPrognosisClickPrice'] =
				$formatter->formatFloat($mediaplanAttributes['maxPrognosisClickPrice']);
			$mediaplanAttributes['maxPrognosisBudget'] =
				$formatter->formatFloat($mediaplanAttributes['maxPrognosisBudget']);
			$mediaplanAttributes['plannedClickPrice'] =
				$formatter->formatFloat($mediaplanAttributes['plannedClickPrice']);
			$mediaplanAttributes['plannedBudget'] =
				$formatter->formatFloat($mediaplanAttributes['plannedBudget']);
			$mediaplanAttributes['dailyBudget'] =
				$formatter->formatFloat($mediaplanAttributes['dailyBudget']);

			echo json_encode($mediaplanAttributes);
		} else {
			throw new CHttpException(400, implode("\n", $adStat->getErrors($fieldName)));
		}
	}

	public function actionUpdateAdRemoteIdField() {
		$value = Yii::app()->request->getParam('value');
		if ($value === null) {
			throw new CHttpException(400, 'Не указано значение.');
		}

		$typeAndId = Yii::app()->request->getParam('id', '');
		$typeAndIdPair = explode(self::PRIMARY_KEYS_DELIMITER, $typeAndId);

		if (count($typeAndIdPair) != 3) {
			throw new CHttpException(400, 'Некорректное число параметров.');
		}
		$fieldName = $typeAndIdPair[0];
		if ($fieldName != 'remoteId') {
			throw new CHttpException(400, 'Попытка обновить недопустимое поле.');
		}

		$systemId = $typeAndIdPair[1];
		$adRemoteId = $typeAndIdPair[2];

		$ad = Ad::model()->findByPk(array(
			'systemId' => $systemId,
			'remoteId' => $value,
		));
		if ($ad !== null) {
			throw new CHttpException(400, 'Объявление с ID '.$value.' уже есть в системе');
		}

		/* @var $ad Ad */
		$ad = Ad::model()->findByPk(array(
			'systemId' => $systemId,
			'remoteId' => $adRemoteId,
		));
		if ($ad === null) {
			throw new CHttpException(404, 'Нет указанной записи.');
		}

		$ad->setIsNewRecord(true);

		$ad->remoteId = $value;
		$ad->campaignRemoteId = null;
		$ad->title = '';
		$ad->description = '';
		$ad->remoteStatus = Ad::REMOTE_STATUS_UNKNOWN;
		$transaction = Yii::app()->db->beginTransaction();
		if ($ad->save()) {
			try {
				Yii::app()->db->createCommand()
					->update('adStat', array(
						'adRemoteId' => $ad->remoteId,
					),
					'systemId=:systemId AND adRemoteId=:remoteId',
					array(
						':systemId' => $ad->systemId,
						':remoteId' => $adRemoteId,
					)
				);

				Yii::app()->db->createCommand()
					->delete(
						'ad',
						'systemId=:systemId AND remoteId=:remoteId',
						array(
							':systemId' => $systemId,
							':remoteId' => $adRemoteId,
						)
					)
				;

				$transaction->commit();
				echo $ad->remoteId;
			} catch (Exception $e) {
				$transaction->rollback();
				Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
				throw new CHttpException(500, 'Технический сбой. В ближайшее время мы устраним данную проблему.');
			}
		} else {
			$transaction->rollback();
			Yii::log(
				'Не удалось сохранить значение при inline-редактировании: ' .
				CVarDumper::dumpAsString($ad->attributes) .
				'. Ошибки: ' .
				CVarDumper::dumpAsString($ad->getErrors()),
				CLogger::LEVEL_ERROR
			);
			throw new CHttpException(500, 'Технический сбой. В ближайшее время мы устраним данную проблему.');
		}
	}

	private $allowedFieldsForUpdate = array(
		'maxPrognosisClicks',
		'maxPrognosisClickPrice',
		'maxPrognosisBudget',
		'plannedClicks',
		'plannedClickPrice',
		'plannedBudget',
		'dailyBudget',
	);

	private $allowedAdFieldsForUpdate = array(
		'brandId',
		'adObjectId',
	);
}
