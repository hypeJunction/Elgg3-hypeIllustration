<?php

$entity = elgg_extract('entity', $vars);

$link = elgg_view('output/url', [
	'href' => 'https://unsplash.com/oauth/applications',
	'target' => '_blank',
]);

$callback = elgg_view('output/url', [
	'href' => elgg_generate_url('illustrations:callback'),
]);

if (elgg()->{'posts.illustrations'}->init()) {
	echo elgg_view_message('success', elgg_echo('illustration:app:connected'));
} else {
	echo elgg_view_message('info', elgg_echo('illustration:app:help', [$link]));
}

echo elgg_view_field([
	'#type' => 'text',
	'#label' => elgg_echo('illustration:app:id'),
	'name' => 'params[unsplash_app_id]',
	'value' => $entity->unsplash_app_id,
]);

echo elgg_view_field([
	'#type' => 'text',
	'#label' => elgg_echo('illustration:app:secret'),
	'name' => 'params[unsplash_app_secret]',
	'value' => $entity->unsplash_app_secret,
]);

echo elgg_view_field([
	'#type' => 'text',
	'#label' => elgg_echo('illustration:app:name'),
	'name' => 'params[unsplash_app_name]',
	'value' => $entity->unsplash_app_name,
]);


