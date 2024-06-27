<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
	public $aliases = [
		'isLoggedIn' => \App\Filters\isLoggedIn::class,
		'csrf'     => \CodeIgniter\Filters\CSRF::class,
		'toolbar'  => \CodeIgniter\Filters\DebugToolbar::class,
		'honeypot' => \CodeIgniter\Filters\Honeypot::class,
	];

	public $globals = [
		'after'  => [
			'toolbar',
		],
	];

	public $methods = [];

	public $filters = [
		'isLoggedIn' => [
			'before' => [
				'/',
				'init',
				'user/dashboard',
				'user/product',
				'user/order',
				'admin/dashboard',
				'admin/banner',
				'admin/event',
				'admin/news',
				'admin/member',
				'admin/broadcast'
			],
			'after'  => [
				'/',
				'auth/login'
			]
		],
	];
}
