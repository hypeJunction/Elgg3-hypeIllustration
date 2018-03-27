<?php

namespace hypeJunction\Illustration;

use Elgg\Hook;

class CoverMenu {

	public function __invoke(Hook $hook) {

		$entity = $hook->getEntityParam();
		$menu = $hook->getValue();

		if ($entity->canEdit()) {
			$menu[] = \ElggMenuItem::factory([
				'name' => 'cover:pick',
				'parent_name' => 'cover',
				'text' => elgg_echo('hero:cover:pick'),
				'icon' => 'image',
				'href' => elgg_generate_url('cover:pick', [
					'guid' => $entity->guid,
				]),
				'class' => 'elgg-lightbox',
				'data-colorbox-opts' => json_encode([
					'width' => '600px',
					'className' => 'hero-cover-lightbox',
				])
			]);
		}

		return $menu;
	}
}