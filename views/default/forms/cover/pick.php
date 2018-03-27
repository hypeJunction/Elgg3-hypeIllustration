<?php

$entity = elgg_extract('entity', $vars);
if (!$entity) {
	return;
}

echo elgg_view_field([
	'#type' => 'hidden',
	'name' => 'guid',
	'value' => $entity->guid,
]);

echo elgg_view_field([
	'#type' => 'hidden',
	'value' => 1,
	'class' => 'illustration-search-quick-submit',
]);

$cover = [];
if ($entity->{'cover:uid'}) {
	list($prefix, $id) = explode(':', $entity->{'cover:uid'});
	if ($prefix == 'unsplash') {
		$cover = [
			'cover' => elgg()->{'posts.post'}->getCover($entity),
			'uid' => $id,
			'ratio' => $entity->{'cover:ratio'} ? : 40,
			'gravity' => $entity->{'cover:gravity'} ? : 'center',
		];
	}
}

echo elgg_view_field([
	'#type' => 'post/cover_artwork',
	'value' => $cover,
	'name' => 'cover_artwork',
	'extended' => false,
]);