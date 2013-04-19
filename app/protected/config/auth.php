<?php

return array(
	1 => array(
		'type' => CAuthItem::TYPE_ROLE,
		'description' => User::$roleNames[User::ROLE_ADMIN_ID],
		'children' => array(
			'blog:view:all',
			'blog:edit',
			'users:manage',
            'attackslog:index'
		),
		'bizRule' => null,
		'data' => null
	),
	2 => array(
		'type' => CAuthItem::TYPE_ROLE,
		'description' => User::$roleNames[User::ROLE_USER],
		'children' => array(
			'blog:view:all',
		),
		'bizRule' => null,
		'data' => null
	),
	3 => array(
		'type' => CAuthItem::TYPE_ROLE,
		'description' => User::$roleNames[User::ROLE_GUEST_ID],
		'bizRule' => null,
		'data' => null
	),
	'blog:view' => array(
		'type' => CAuthItem::TYPE_OPERATION,
		'description' => 'Просмотр заметок',
		'bizRule' => null,
		'data' => null
	),
	'blog:view:all' => array(
		'type' => CAuthItem::TYPE_OPERATION,
		'description' => 'Просмотр заметок',
		'children' => array(
			'blog:view',
		),
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
    'attackslog:index' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Мониторинг атак',
        'bizRule' => null,
        'data' => null
    ),
);
