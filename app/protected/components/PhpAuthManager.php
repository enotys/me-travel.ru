<?php
/**
 * ACL manager.
 *
 * @author serj
 */
class PhpAuthManager extends CPhpAuthManager {

	/**
	 * Init ACL rules.
	 */
	public function init() {
		if($this->authFile===null) {
			$this->authFile=Yii::getPathOfAlias('application.config.auth').'.php';
		}

		parent::init();

		if(!Yii::app()->user->isGuest) {
			$this->assign(Yii::app()->user->role, Yii::app()->user->id);
		}
	}
}