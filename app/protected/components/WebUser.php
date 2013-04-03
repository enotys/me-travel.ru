<?php
/**
 * Current user object.
 *
 * @author serj, enot
 */
class WebUser extends CWebUser {

	/**
	 * Return user role id.
	 *
	 * @return integer
	 */
	function getRole()
	{
		if ($user = $this->getModel())
		{
			return $user->roleId;
		}
		else
		{
			Yii::log(
				'Не удалось получить модель для пользователя с id=' . $this->id,
				CLogger::LEVEL_WARNING
			);
		}

		return User::ROLE_GUEST_ID;
	}

	/**
	 * Get current user role name.
	 *
	 * @return string
	 */
	function getRoleName() {
		$model = $this->getModel();
		return isset(User::$roleNames[$model->roleId])
			? User::$roleNames[$model->roleId]
			: User::$roleNames[User::ROLE_GUEST_ID];
	}

	/**
	 * Return current user model.
	 *
	 * @param bool $forceGet force load user if user was getting earlier.
	 * @return User
	 */
	public function getModel($forceGet = false)
	{
		if (!$this->isGuest && $this->_model === null || $forceGet)
		{
			$this->_model = User::model()->findByPk($this->id);
		}
		return $this->_model;
	}

	/**
	 * Current user model.
	 *
	 * @var User
	 */
	private $_model = null;
}