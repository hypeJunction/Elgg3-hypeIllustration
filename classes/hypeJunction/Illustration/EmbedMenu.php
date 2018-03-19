<?php

namespace hypeJunction\Illustration;

use Elgg\Hook;

class EmbedMenu {

	/**
	 * Setup embed menu
	 *
	 * @param Hook $hook Hook
	 * @return \ElggMenuItem[]
	 */
	public function __invoke(Hook $hook) {

		$menu = $hook->getValue();

		$menu[] = \ElggMenuItem::factory([
			'name' => 'illustrations',
			'text' => elgg_echo('embed:illustration'),
			'data' => [
				'view' => 'embed/tab/illustration',
			],
		]);

		return $menu;
	}
}