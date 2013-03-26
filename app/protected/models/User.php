<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property integer $roleId
 * @property integer $blocked
 * @property integer $deleted
 */
class User extends CActiveRecord {

    // User roles ids.
    const ROLE_ADMIN_ID = 1;
    const ROLE_USER = 2;
    const ROLE_GUEST_ID = 3;

    static $roleNames = array(
        self::ROLE_GUEST_ID => 'Гость',
        self::ROLE_ADMIN_ID => 'Администратор',
        self::ROLE_USER => 'Пользователь',
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
			array('name, email, password, roleId', 'required'),
			array('roleId, blocked, deleted', 'numerical', 'integerOnly'=>true),
			array('name, email', 'length', 'max'=>255),
			array('password', 'length', 'max'=>32),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'email' => 'Email',
			'password' => 'Password',
			'roleId' => 'Role',
			'blocked' => 'Blocked',
			'deleted' => 'Deleted',
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
		$criteria->compare('password',$this->password,true);
		$criteria->compare('roleId',$this->roleId);
		$criteria->compare('blocked',$this->blocked);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}