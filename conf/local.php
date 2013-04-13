<?php
/**
 * Settings specified for host.
 *
 * From template: local.php.dist
 *
 * @author serj
 */
date_default_timezone_set('Europe/Moscow');
return array(
	'components' => array(
		// use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=realweb_majortools',
			'username' => 'majortools',
			'password' => '43w#W7Rg',
			'charset' => 'utf8',
		),
	),
	'params' => array(
		'debugEmail' => 'lemnev@realweb.ru',
		'uploadsDirPath'=>'/home/serj/work/mediaplans/app/protected/data/upload',
		'processedMediaplansDirPath'=>'/home/serj/work/mediaplans/app/protected/data/processed/mediaplans',
		'externalAuthData'=> array(
			// Yandex.Direct
			1 => array(
				'login' => 'lazuka',
				'password' => 'rEAlnOhbfkYj634',
				'applicationId' => 'e9f2f46b00344fc6a3e2cfe48b6b92f7',
			),
			// Google AdWords
			2 => array(
				'login' => 'adwords@adhands.ru',
				'password' => 'Zyk76JJjedfswfZ',
				'developerId' => 'Zvxp50RM5Dtj00Dj7u53Lg',
				'customerId' => '1583882939',
			),
		),
		'YiiMailer' => array(
			'Mailer' => 'smtp',
			'Host' => 'smtp.realweb.ru',
		),
	),
);