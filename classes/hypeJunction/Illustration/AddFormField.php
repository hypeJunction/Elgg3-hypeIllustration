<?php

namespace hypeJunction\Illustration;

use DateTime;
use DateTimeZone;
use Elgg\Hook;
use Elgg\Request;
use ElggEntity;
use hypeJunction\Fields\Collection;
use hypeJunction\ValidationException;

class AddFormField {

	/**
	 * Add slug field
	 *
	 * @param Hook $hook Hook
	 *
	 * @return mixed
	 * @throws \InvalidParameterException
	 */
	public function __invoke(Hook $hook) {

		$fields = $hook->getValue();
		/* @var $fields Collection */

		$fields->add('cover_artwork', new CoverArtworkField([
			'type' => 'post/cover_artwork',
			'section' => 'sidebar',
			'is_profile_field' => false,
			'priority' => 400,
			'extended' => function (\ElggEntity $entity) {
				return $entity instanceof \ElggObject;
			},
		]));

		return $fields;
	}
}
