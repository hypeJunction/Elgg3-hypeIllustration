<?php

return [
	'posts.illustrations.cache' => \DI\object(\Elgg\Cache\CompositeCache::class)
		->constructor(
			'illustrations',
			\DI\get('config'),
			ELGG_CACHE_PERSISTENT | ELGG_CACHE_FILESYSTEM
		),
	'posts.illustrations' => \DI\object(\hypeJunction\Illustration\IllustrationService::class)
		->constructor(\DI\get('posts.illustrations.cache')),
];
