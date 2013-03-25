<?php

Yii::import('application.components.External.ExternalConstants');

/**
 * Import data form for download data from csv files.
 *
 */
class ImportDataForm extends CFormModel
{
	/**
	 * @var CUploadedFile
	 */
	public $dataFile;
	public $year;
	public $month;
	public $systemId;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('dataFile, year, month, systemId', 'required'),
			array('dataFile', 'file', 'types' => 'csv'),
			array('systemId', 'in', 'range' => ExternalConstants::$systems),
			array('year, month, systemId', 'numerical', 'integerOnly'=>true),
			array('dataFile', 'safe'),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'dataFile'=>'Файл для импорта',
			'year'=>'Год',
			'month'=>'Месяц',
			'systemId'=>'Система, по которой загружаются данные',
		);
	}

	public function init()
	{
		parent::init();
		$this->year = date('Y');
		$this->month = date('n');
		$this->systemId = ExternalConstants::SYSTEM_YANDEX;
	}
}
