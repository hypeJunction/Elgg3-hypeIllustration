<?php

echo elgg_view('forms/illustrations/search', [
	'name' => 'uid',
]);

echo elgg_view_field([
	'#type' => 'hidden',
	'value' => 1,
	'class' => 'illustration-search-quick-submit',
]);
