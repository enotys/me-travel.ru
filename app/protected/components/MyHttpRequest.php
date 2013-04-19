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
            $attackLog->log('CSRF');
            throw new CHttpException(400,Yii::t('yii','The CSRF token could not be verified.'));
        }

    }


}