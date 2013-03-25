<?php

return array(
	1 => array(
		'type' => CAuthItem::TYPE_ROLE,
		'description' => User::$roleNames[User::ROLE_ADMIN_ID],
		'children' => array(
			'mediaplans:upload',
			'mediaplans:view:all',
			'mediaplans:edit',
			'reports:download',
			'userBrandLinks:manage',
			'users:manage',
		),
		'bizRule' => null,
		'data' => null
	),
	2 => array(
		'type' => CAuthItem::TYPE_ROLE,
		'description' => User::$roleNames[User::ROLE_CLIENT_MANAGER_ID],
		'children' => array(
			'mediaplans:view:all',
			'reports:download',
			'userBrandLinks:manage',
		),
		'bizRule' => null,
		'data' => null
	),
	3 => array(
		'type' => CAuthItem::TYPE_ROLE,
		'description' => User::$roleNames[User::ROLE_BRAND_MANAGER_ID],
		'children' => array(
			'mediaplans:view',
			'reports:download',
		),
		'bizRule' => null,
		'data' => null
	),
	4 => array(
		'type' => CAuthItem::TYPE_ROLE,
		'description' => User::$roleNames[User::ROLE_GUEST_ID],
		'bizRule' => null,
		'data' => null
	),
	'mediaplans:upload' => array(
		'type' => CAuthItem::TYPE_OPERATION,
		'description' => 'Загрузка медиапланов',
		'bizRule' => null,
		'data' => null
	),
	'mediaplans:view' => array(
		'type' => CAuthItem::TYPE_OPERATION,
		'description' => 'Просмотр медиапланов',
		'bizRule' => null,
		'data' => null
	),
	'mediaplans:view:all' => array(
		'type' => CAuthItem::TYPE_OPERATION,
		'description' => 'Просмотр медиапланов',
		'children' => array(
			'mediaplans:view',
		),
		'bizRule' => null,
		'data' => null
	),
	'mediaplans:edit' => array(
		'type' => CAuthItem::TYPE_OPERATION,
		'description' => 'Редактирование медиапланов',
		'bizRule' => null,
		'data' => null
	),
	'reports:download' => array(
		'type' => CAuthItem::TYPE_OPERATION,
		'description' => 'Выгрузка отчётов',
		'bizRule' => null,
		'data' => null
	),
	'users:view' => array(
		'type' => CAuthItem::TYPE_OPERATION,
		'description' => 'Управление пользователями',
		'bizRule' => null,
		'data' => null
	),
	'users:manage' => array(
		'type' => CAuthItem::TYPE_OPERATION,
		'description' => 'Управление пользователями',
		'children' => array(
			'users:view',
		),
		'bizRule' => null,
		'data' => null
	),
	'userBrandLinks:manage' => array(
		'type' => CAuthItem::TYPE_OPERATION,
		'description' => 'Назначение видимости брендов для бренд менеджеров',
		'children' => array(
			'users:view',
		),
		'bizRule' => null,
		'data' => null
	),
);
