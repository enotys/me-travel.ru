<?php
/**
 * IdentityUser represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 *
 * @author enot
 */
class IdentityUser extends CUserIdentity {

    const MAX_ATTEMTPT_LIMIT = 4;

    const ERROR_CODE_BRUTE_FORCE = 100;
    const MINUTE_15 = 900; // 60 * 15

	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate() {

        $ip = $this->getIp();

        /** @var  $ipModel Ip */
        $ipModel = new Ip();
        /** @var  $findedRecord Ip*/
        $findedRecord = $ipModel->findByAttributes(
            array(
                'ip' => $ip
            )
        );
        $ipIsInDb = ($findedRecord !== null);

        if ($findedRecord !== null) {
            if ($findedRecord->attempt > self::MAX_ATTEMTPT_LIMIT) {
                $timeToAttempt = time() - $findedRecord->last_date_attempt;
                if ($timeToAttempt < self::MINUTE_15) {
                    $this->errorCode = self::ERROR_CODE_BRUTE_FORCE;
                    $this->errorMessage = 'Вы заблокированны на 15 минут. Попытайтесь вспомнить авторизационные данные';
                    $attacksLog = new AttacksLog();
                    $criteries = new CDbCriteria();
                    $criteries->compare(
                        'ip',
                        $ip
                    );
                    $criteries->compare(
                        'date','>'.(time() - 60)
                    );
                    $entityLog = $attacksLog->exists(
                        $criteries
                    );
                    if (!$entityLog) {
                        $attacksLog->log('BruteForce');
                    }
                    return !$this->errorCode;
                }

            }
        }

        $user = User::model()->find(
            'LOWER(email)=?',
            array(strtolower($this->username))
        );
        if(($user === null)) {
            $this->errorCode=self::ERROR_USERNAME_INVALID;
            $this->addAttempt($ipIsInDb, $findedRecord, $ipModel, $ip);

        } else if(User::hashPassword($this->password) !== $user->password) {
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
            $this->addAttempt($ipIsInDb, $findedRecord, $ipModel, $ip);
        } else {
            $this->errorCode = self::ERROR_NONE;
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
	public function getId()
	{
		return $this->_id;
	}

    /**
     * Get real user ip address
     *
     * @return string
     */
    public function getIp() {
        $ip = 0;
        if (!empty($_SERVER['HTTP_X_REAL_IP'])) {
            $ip = $_SERVER['HTTP_X_REAL_IP'];
        } else if (!empty($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    /**
     * Add attempt record
     */
    private function addAttempt($ipInDb, $findedRecord, $ipModel, $ip) {
        if ($ipInDb) {
            /** @var  $findedRecord Ip*/
            if ($findedRecord->attempt >self::MAX_ATTEMTPT_LIMIT) {
                $findedRecord->attempt = 1;
            } else {
                $findedRecord->attempt++;
            }
            $findedRecord->last_date_attempt = time();
            $findedRecord->save();
        } else {
            /** @var  $ipModel Ip*/
            $ipModel->attempt = 1;
            $ipModel->ip = $ip;
            $ipModel->last_date_attempt = time();
            $ipModel->save();
        }
    }

	/**
	 * User primary key.
	 *
	 * @var integer
	 */
	private $_id;

}