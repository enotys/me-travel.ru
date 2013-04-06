<?php

/**
 * Class LvController
 *
 * Love terminal
 */
class LvController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/special';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            //'accessControl', // perform access control for CRUD operations
            //'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform all actions
                'actions'=>array('*'),
                'users'=>array('*'),
            )
        );
    }

    /**
     * Show terminal love
     */
    public function actionIndex()
    {   $flower = file_get_contents(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'dataLv'.DIRECTORY_SEPARATOR.'flower.txt');
        $ring = file_get_contents(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'dataLv'.DIRECTORY_SEPARATOR.'ring.txt');
        $this->render('index',array(
            'dataFlower'=> $flower,
            'dataRing' => $ring
        ));
    }
}