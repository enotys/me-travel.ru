<?php
date_default_timezone_set('Europe/Moscow');
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Me Travel',
	'language'=>'ru',

	// preloading 'log' component
	'preload'=>array('log'),

	// application components
	'components'=>array(
        'format' => array(
            'class' => 'Formatter',
            'numberFormat' => array(
                'decimals' => 2,
                'decimalSeparator' => '.',
                'thousandSeparator' => '',
            ),
        ),
        'request' => array(
            'enableCsrfValidation' => true,
            'class' => 'MyHttpRequest'
        ),

		'user'=>array(
			'class' => 'WebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl'=>array('/auth/login'),
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
			'showScriptName'=>false,
			'caseSensitive'=>false,
		),
		// use caching
		'cache'=>array(
			'class'=>'CFileCache',
		),
		// use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=h47280_me-travel',
			'emulatePrepare' => true,
			'username' => 'h47280_me-travel',
			'password' => 'pass',
			'charset' => 'utf8',
			'schemaCachingDuration'=>3600,
		),
		'authManager' => array(
			// Будем использовать свой менеджер авторизации
			'class' => 'PhpAuthManager',
			// Роль по умолчанию.
			'defaultRoles' => array(3),
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
        'mailer' => array(
            'class' => 'Mailer'
        ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'enotsv2@gmail.com',
		'uploadsDirPath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'../runtime/upload',
		'YiiMailer' => array(
            'Mailer' => 'smtp',
			'Host' => 'srv0.host-food.ru',
            'viewPath' => 'application.views.mail',
            'layoutPath' => 'application.views.layouts',
            'baseDirPath' => 'webroot.img.mail',
            'layout' => 'mail',
            'CharSet' => 'UTF-8',
            'AltBody' => Yii::t('YiiMailer','You need an HTML capable viewer to read this message.'),
            'language' => array(
                'authenticate'         => Yii::t('YiiMailer','SMTP Error: Could not authenticate.'),
                'connect_host'         => Yii::t('YiiMailer','SMTP Error: Could not connect to SMTP host.'),
                'data_not_accepted'    => Yii::t('YiiMailer','SMTP Error: Data not accepted.'),
                'empty_message'        => Yii::t('YiiMailer','Message body empty'),
                'encoding'             => Yii::t('YiiMailer','Unknown encoding: '),
                'execute'              => Yii::t('YiiMailer','Could not execute: '),
                'file_access'          => Yii::t('YiiMailer','Could not access file: '),
                'file_open'            => Yii::t('YiiMailer','File Error: Could not open file: '),
                'from_failed'          => Yii::t('YiiMailer','The following From address failed: '),
                'instantiate'          => Yii::t('YiiMailer','Could not instantiate mail function.'),
                'invalid_address'      => Yii::t('YiiMailer','Invalid address'),
                'mailer_not_supported' => Yii::t('YiiMailer',' mailer is not supported.'),
                'provide_address'      => Yii::t('YiiMailer','You must provide at least one recipient email address.'),
                'recipients_failed'    => Yii::t('YiiMailer','SMTP Error: The following recipients failed: '),
                'signing'              => Yii::t('YiiMailer','Signing Error: '),
                'smtp_connect_failed'  => Yii::t('YiiMailer','SMTP Connect() failed.'),
                'smtp_error'           => Yii::t('YiiMailer','SMTP server error: '),
                'variable_set'         => Yii::t('YiiMailer','Cannot set or reset variable: ')
            ),
        ),
	),
);
