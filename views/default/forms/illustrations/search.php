<?php

elgg_require_js('forms/illustrations/search');

echo elgg_view_field([
	'#type' => 'text',
	'#label' => elgg_echo('illustration:search'),
	'class' => 'illustration-search-input',
]);

echo elgg_view_field([
	'#type' => 'hidden',
	'value' => elgg_extract('name', $vars),
	'class' => 'illustration-search-name',
]);

echo elgg_view_field([
    '#type' => 'button',
    'value' => elgg_echo('search'),
    'class' => 'illustration-search-button',
]);
?>
<div class="illustration-search-results">
    <?= elgg_view('input/post/illustration', $vars) ?>
</div>
