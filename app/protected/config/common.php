<?php

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
		'user'=>array(
			'class' => 'CWebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl'=>array('/auth/login'),
		),
		// uncomment the following to enable URLs in path-format
//		'urlManager'=>array(
//			'urlFormat'=>'path',
//			'rules'=>array(
//				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
//				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
//				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
//			),
//			'showScriptName'=>false,
//			'caseSensitive'=>false,
//		),
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
//		'authManager' => array(
//			// Будем использовать свой менеджер авторизации
//			'class' => 'PhpAuthManager',
//			// Роль по умолчанию.
//			'defaultRoles' => array(0),
//		),
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
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'enotsv2@gmail.com',
//		'uploadsDirPath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'../runtime/upload',
//		'externalAuthData'=> array(
//			1 => array(
//				'login' => 'lazuka',
//				'password' => 'NoRealHbfk436',
//				'applicationId' => 'e9f2f46b00344fc6a3e2cfe48b6b92f7',
//			)
//		),
	),
);
