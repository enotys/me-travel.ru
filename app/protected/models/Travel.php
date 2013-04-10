<?php

/**
 * This is the model class for table "travel".
 *
 * The followings are the available columns in table 'travel':
 * @property string $id
 * @property string $title
 * @property string $maps_label
 * @property string $date
 * @property string $text
 * @property string $user_id
 * @property integer $private
 */
class Travel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Travel the static model class
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
		return 'travel';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
        $obj=new CHtmlPurifier();
		return array(
			array('title, maps_label, date, text, user_id', 'required'),
			array('private', 'numerical', 'integerOnly'=>true),
			array('title, maps_label', 'length', 'max'=>255),
			array('date, user_id', 'length', 'max'=>10),
            array('title, text', 'filter', 'filter'=>array($obj, 'purify')),
            array('date','date','format'=>'d.M.yyyy'),
            array('date', 'filter', 'filter'=> array($this, 'convertDate')),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, maps_label, date, text, user_id, private', 'safe', 'on'=>'search'),
		);
	}

    /**
     * Convert date to timestamp
     *
     * @param $date
     * @return int
     */
    public function convertDate($date) {
        return strtotime($date);
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'title' => 'Название места',
			'maps_label' => 'Отметка на карте',
			'date' => 'Дата',
			'text' => 'Текст заметки',
			'user_id' => 'Идентификатор пользователя',
			'private' => 'Приватная запись',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('maps_label',$this->maps_label,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('private',$this->private);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}