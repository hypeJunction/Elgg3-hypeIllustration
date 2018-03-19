<?php

return [
	'actions' => [
		'illustrations/embed' => [
			'controller' => \hypeJunction\Illustration\GenerateEmbedCode::class,
		],
	],
	'routes' => [
		'illustrations:callback' => [
			'path' => '/illustrations/callback',
			'controller' => \hypeJunction\Illustration\UnsplashCallbackController::class,
		],
		'illustrations:search' => [
			'path' => '/illustrations/search',
			'controller' => \hypeJunction\Illustration\IllustrationSearchController::class,
			'middleware' => [
				\Elgg\Router\Middleware\AjaxGatekeeper::class,
			],
		]
	],
];
