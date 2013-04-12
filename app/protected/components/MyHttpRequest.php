<?php

/**
 * Class for handling exceptions occur when CSRF attacks
 *
 * Class MyHttpRequest
 */
class MyHttpRequest extends CHttpRequest {

    /**
     * Save attack info in DB and throw exception
     *
     * @param CEvent $event
     * @throws CHttpException
     */
    public function validateCsrfToken($event) {
        try {
            parent::validateCsrfToken($event);
        } catch (CHttpException $e) {
            $attackLog = new AttacksLog();
            $attackLog->date = time();
            $attackLog->type = 'CSRF';
            $attackLog->ip = '0.0.0.0';
            if (!empty($_SERVER['HTTP_X_REAL_IP'])) {
                $attackLog->ip = $_SERVER['HTTP_X_REAL_IP'];
            } else if (!empty($_SERVER['REMOTE_ADDR'])) {
                $attackLog->ip = $_SERVER['REMOTE_ADDR'];
            }
            if (!empty($_SERVER['HTTP_REFERER'])){
                $attackLog->referer = $_SERVER['HTTP_REFERER'];
            } else {
                $attackLog->referer = 'EMPTY_REFERER';
            }
            if (!empty($_SERVER['HTTP_USER_AGENT'])) {
                $attackLog->user_agent = $_SERVER['HTTP_USER_AGENT'];
            } else {
                $attackLog->user_agent = 'Unknown';
            }
            //@todo need add location
            $attackLog->location = 'RUSSIA';
            $attackLog->globals_state = serialize($GLOBALS);
            $attackLog->save();
            throw new CHttpException(400,Yii::t('yii','The CSRF token could not be verified.'));
        }

    }


}