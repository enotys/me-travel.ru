<?php

/**
 * This is the model class for table "attacks_log".
 *
 * The followings are the available columns in table 'attacks_log':
 * @property string $id
 * @property string $date
 * @property string $type
 * @property string $ip
 * @property string $referer
 * @property string $user_agent
 * @property string $location
 * @property string $globals_state
 */
class AttacksLog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AttacksLog the static model class
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
		return 'attacks_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date, type, ip, referer, user_agent, location, globals_state', 'required'),
			array('date', 'length', 'max'=>10),
			array('type, ip', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, date, type, ip, referer, user_agent, location, globals_state', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'date' => 'Date',
			'type' => 'Type',
			'ip' => 'Ip',
			'referer' => 'Referer',
			'user_agent' => 'User Agent',
			'location' => 'Location',
			'globals_state' => 'Globals State',
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
		$criteria->compare('date',$this->date,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('referer',$this->referer,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('globals_state',$this->globals_state,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}