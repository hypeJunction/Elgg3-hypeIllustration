<?php

$name = elgg_extract('name', $vars);
$value = elgg_extract('value', $vars, []);

echo elgg_view('post/cover', [
	'cover' => elgg_extract('cover', $value),
]);

echo elgg_view_field([
	'#type' => 'select',
	'#label' => elgg_echo('post:cover:ratio'),
	'name' => "{$name}[ratio]",
	'value' => elgg_extract('ratio', $value, 40),
	'options_values' => [
		10 => '10 / 1',
		20 => '10 / 2',
		30 => '10 / 3',
		40 => '10 / 4',
		50 => '10 / 5',
		60 => '10 / 6',
		70 => '10 / 7',
		80 => '10 / 8',
		90 => '10 / 9',
		100 => '10 / 10',
	],
]);

echo elgg_view_field([
	'#type' => 'select',
	'#label' => elgg_echo('post:cover:gravity'),
	'name' => "{$name}[gravity]",
	'value' => elgg_extract('gravity', $value, 'center'),
	'options_values' => [
		'center' => elgg_echo('post:cover:gravity:center'),
		'north' => elgg_echo('post:cover:gravity:north'),
		'east' => elgg_echo('post:cover:gravity:east'),
		'south' => elgg_echo('post:cover:gravity:south'),
		'west' => elgg_echo('post:cover:gravity:west'),
	],
]);

echo elgg_view('forms/illustrations/search', [
	'name' => "{$name}[uid]",
]);