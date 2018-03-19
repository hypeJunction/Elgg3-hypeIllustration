<?php

namespace hypeJunction\Illustration;

use DateTime;
use DateTimeZone;
use Elgg\Hook;
use Elgg\Request;
use ElggEntity;
use hypeJunction\ValidationException;

class AddFormField {

	/**
	 * Add slug field
	 *
	 * @param Hook $hook Hook
	 *
	 * @return mixed
	 */
	public function __invoke(Hook $hook) {

		$fields = $hook->getValue();

		if (!isset($fields['cover'])) {
			return;
		}

		$fields['cover_artwork'] = [
			'#type' => 'post/cover_artwork',
			'#section' => 'sidebar',
			'#input' => function (Request $request) {
				return $request->getParam('cover_artwork');
			},
			'#validate' => function ($value, $params) {
				$required = elgg_extract('required', $params);
				$label = elgg_extract('#label', $params);

				if ($required && !$value) {
					throw new ValidationException(elgg_echo('error:field:required', [$label]));
				}
			},
			'#getter' => function (ElggEntity $entity) {
				if (!$entity->{'cover:uid'}) {
					return;
				}

				list($prefix, $id) = explode(':', $entity->{'cover:uid'});
				if ($prefix !== 'unsplash') {
					return;
				}

				return [
					'cover' => elgg()->{'posts.post'}->getCover($entity),
					'uid' => $id,
					'ratio' => $entity->{'cover:ratio'} ? : 40,
					'gravity' => $entity->{'cover:gravity'} ? : 'center',
				];
			},
			'#setter' => function (ElggEntity $entity, $value) {
				$uid = elgg_extract('uid', $value);

				if ($uid) {
					$photo = elgg()->{'posts.illustrations'}->get($uid);
					/* @var $photo \Crew\Unsplash\Photo */

					$photo->download();

					$entity->{'cover:uid'} = "unsplash:$photo->id";
					$entity->{'cover:file_url'} = $photo->urls['full'];
					$entity->{'cover:thumb_url'} = $photo->urls['regular'];
					$entity->{'cover:color'} = $photo->color;
					$entity->{'cover:width'} = $photo->width;
					$entity->{'cover:height'} = $photo->height;
					$entity->{'cover:provider'} = 'Unsplash';
					$entity->{'cover:provider_url'} = $photo->links['html'];
					$entity->{'cover:author'} = $photo->user['name'];
					$entity->{'cover:author_url'} = $photo->user['portfolio_url'];

					$entity->{'cover:gravity'} = elgg_extract('gravity', $value, 'center');
					$entity->{'cover:ratio'} = elgg_extract('ratio', $value, 40);
				}

			},
			'#profile' => false,
			'#visibility' => function (\ElggEntity $entity) {
				$params = [
					'entity' => $entity,
				];

				return elgg()->hooks->trigger(
					'uses:cover',
					"$entity->type:$entity->subtype",
					$params,
					true
				);
			},
			'#priority' => 400,
		];

		return $fields;
	}
}
