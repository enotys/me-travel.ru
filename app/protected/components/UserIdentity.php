<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 *
 * @author serj
 */
class UserIdentity extends CUserIdentity {

    /**
     * User primary key.
     *
     * @var integer
     */
    private $_id;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate() {
        $user = User::model()->find(
            'LOWER(email)=?',
            array(strtolower($this->username))
        );
        if(($user===null)) {
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        } else if(User::hashPassword($this->password)!==$user->password) {
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        } else {
            $this->errorCode=self::ERROR_NONE;
            $this->_id = $user->id;
            $this->username = $user->name;
        }

        return !$this->errorCode;
	}

    /**
     * Getter for property "_id".
     *
     * @return integer
     */
    public function getId() {
        return $this->_id;
    }

}