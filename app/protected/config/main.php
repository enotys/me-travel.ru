<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return CMap::mergeArray(
	require(dirname(__FILE__).'/common.php'),
	array(
		//'defaultController' => 'ad',

		'modules'=>array(
			// uncomment the following to enable the Gii tool
			'gii'=>array(
				'class'=>'system.gii.GiiModule',
				'password'=>'111',
				// If removed, Gii defaults to localhost only. Edit carefully to taste.
				'ipFilters'=>array('127.0.0.1','::1'),
			),
		),

		// autoloading model and component classes
		'import'=>array(
			'application.models.*',
			'application.components.*',
			//'application.components.External.*',
		),
	)
);
