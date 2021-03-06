<?php

/**
 * This is the model class for table "ip".
 *
 * The followings are the available columns in table 'ip':
 * @property string $id
 * @property string $ip
 * @property string $attempt
 * @property string $last_date_attempt
 */
class Ip extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ip the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ip';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ip, attempt, last_date_attempt', 'required'),
			array( 'last_date_attempt', 'length', 'max'=>10),
            array( 'ip', 'length', 'max'=>50),
			array('attempt', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ip, attempt, last_date_attempt', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'ip' => 'Ip address',
			'attempt' => 'Attempt',
			'last_date_attempt' => 'Last Date Attempt',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('attempt',$this->attempt,true);
		$criteria->compare('last_date_attempt',$this->last_date_attempt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}