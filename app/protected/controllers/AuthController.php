<?php
/**
 * Controller for handling authentication users.
 *
 * @author serj
 */
class AuthController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/withoutNavigation';

    /**
     * Login in system
     */
    public function actionLogin()
	{
		$this->pageTitle = 'Вход в систему';
		$userModel = new User();

		if (isset($_POST['User'])) {
			$userModel->attributes = $_POST['User'];
			$identity = new IdentityUser(
				$userModel->email,
				$userModel->password
			);
			if ($identity->authenticate()) {
				$duration = 3600 * 24 * 30; // 30 days
				Yii::app()->user->login($identity, $duration);
				$this->redirect(array('blog/index'));
			} else {
                if ($identity->errorCode == 100) {
                    $userModel->addError('password', $identity->errorMessage);
                }
				$userModel->addError('password', 'Неверный E-mail или пароль.');
			}
		}

		$this->render('login', array(
			'userModel' => $userModel,
		));
	}

    /**
     * Logout (exit)
     */
    public function actionLogout()
	{
		Yii::app()->user->logout();

		$this->redirect('/');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}