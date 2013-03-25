<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property integer $roleId
 * @property integer $blocked
 * @property integer $deleted
 *
 * The followings are the available model relations:
 * @property Ad[] $ads
 * @property Brand[] $brands
 */
class User extends CActiveRecord
{
	// Table name.
	const tableName = 'user';

	// User roles ids.
	const ROLE_ADMIN_ID = 1;
	const ROLE_CLIENT_MANAGER_ID = 2;
	const ROLE_BRAND_MANAGER_ID = 3;
	const ROLE_GUEST_ID = 4;

	static $roleNames = array(
		self::ROLE_GUEST_ID => 'Гость',
		self::ROLE_ADMIN_ID => 'Администратор',
		self::ROLE_CLIENT_MANAGER_ID => 'Менеджер клиента',
		self::ROLE_BRAND_MANAGER_ID => 'Бренд менеджер',
	);

	/**
	 * Return roles names, which display in role select control.
	 *
	 * @return array
	 */
	public function getRoleNamesForSelect() {
		$rolesNames = array('' => $this->getAttributeLabel('roleId')) + self::$roleNames;
		unset($rolesNames[self::ROLE_GUEST_ID]);
		return $rolesNames;
	}

	/**
	 * Get role name by id.
	 *
	 * @param integer $roleId
	 * @return string
	 */
	static function getRoleName($roleId) {
		return isset(self::$roleNames[$roleId])
			? self::$roleNames[$roleId]
			: ''
			;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, email, roleId', 'required'),
			array('password', 'required', 'on' => 'insert'),
			array('roleId', 'numerical', 'integerOnly'=>true),
			array('name, email', 'length', 'max'=>255),
			array('email', 'email'),
			array('email', 'unique'),
			array('password', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, email, password, roleId, blocked, deleted', 'safe', 'on'=>'search'),
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
			'ads' => array(self::HAS_MANY, 'Ad', 'userId'),
			'brands' => array(self::MANY_MANY, 'Brand', 'userHasBrand(userId, brandId)'),
			'brandsCount' => array(self::STAT, 'Brand', 'userHasBrand(userId, brandId)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'ФИО',
			'email' => 'E-mail',
			'password' => 'Пароль',
			'roleId' => 'Роль',
			'blocked' => 'Заблокирован',
			'deleted' => 'Удалён',
			'brandsCount' => 'Кол-во брендов',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password);
		$criteria->compare('roleId',$this->roleId);
		$criteria->compare('blocked',$this->blocked);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Get password hash.
	 *
	 * @param string $password
	 * @return string
	 */
	public static function hashPassword($password) {
		return md5($password);
	}

	/**
	 * Save linked with user brands, which was accessed for user.
	 *
	 * @param integer[] $brandsIds
	 * @param bool $needDeleteBefore
	 * @return void
	 */
	public function saveAllowedBrands($brandsIds, $needDeleteBefore = true) {
		if ($needDeleteBefore) {
			Yii::app()->db->createCommand()->delete(
				UserHasBrand::tableName,
				'userId=:userId',
				array(
					':userId' => $this->id,
				)
			);
		}
		foreach ($brandsIds as $brandId) {
			Yii::app()->db->createCommand()->insert(
				UserHasBrand::tableName,
				array(
					'userId' => $this->id,
					'brandId' => $brandId,
				)
			);
		}
	}

	/**
	 * After find store password hash.
	 *
	 */
	protected function afterFind()
	{
		parent::afterFind();
		$this->oldPassword = $this->password;
	}

	/**
	 * Check password value. If not empty and not equal value old password.
	 *
	 * @return bool
	 */
	protected function beforeSave()
	{
		if (parent::beforeSave()) {
			if ($this->isNewRecord) {
				$this->password = self::hashPassword($this->password);
			} elseif (!empty($this->password)
				&& $this->password != $this->oldPassword
			) {
				$this->password = self::hashPassword($this->password);
			} else {
				$this->password = $this->oldPassword;
			}
			return true;
		} else {
			return false;
		}
	}


	private $oldPassword;

}