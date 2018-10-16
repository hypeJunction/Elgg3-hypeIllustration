<?php

require_once __DIR__ . '/autoloader.php';

return function () {

	elgg_register_event_handler('cache:flush', 'system', function () {
		elgg()->get('posts.illustrations')->flushCache();
	});

	elgg_register_event_handler('init', 'system', function () {

		elgg_register_plugin_hook_handler('fields', 'object', \hypeJunction\Illustration\AddFormField::class);
		elgg_register_plugin_hook_handler('fields', 'group', \hypeJunction\Illustration\AddFormField::class);
		elgg_register_plugin_hook_handler('fields', 'user', \hypeJunction\Illustration\AddFormField::class);

		elgg_register_plugin_hook_handler('entity:cover:url', 'all', \hypeJunction\Illustration\SetCoverArtwork::class);

		elgg_extend_view('elgg.css', 'illustration.css');
		elgg_extend_view('elgg.css', 'embed/safe/illustration.css');
		elgg_extend_view('elgg/wysiwyg.css', 'embed/safe/illustration.css');

		elgg_register_plugin_hook_handler('register', 'menu:embed', \hypeJunction\Illustration\EmbedMenu::class);
		elgg_register_plugin_hook_handler('register', 'menu:cover', \hypeJunction\Illustration\CoverMenu::class);
	});

};
