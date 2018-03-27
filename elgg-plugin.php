<?php

return [
	'actions' => [
		'illustrations/embed' => [
			'controller' => \hypeJunction\Illustration\GenerateEmbedCode::class,
		],
		'cover/pick' => [
			'controller' => \hypeJunction\Illustration\CoverPickAction::class,
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
		],
		'cover:pick' => [
			'path' => '/cover/pick/{guid}',
			'resource' => 'hero/cover/pick',
		],
	],
];
