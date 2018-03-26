<?php

namespace hypeJunction\Illustration;

use Elgg\Hook;

class SetCoverArtwork {

	/**
	 * Use cover artwork
	 *
	 * @param Hook $hook Hook
	 *
	 * @return string
	 */
	public function __invoke(Hook $hook) {

		$entity = $hook->getEntityParam();
		if (!$entity || !$entity->{'cover:uid'}) {
			return;
		}

		list($prefix, $id) = explode(':', $entity->{'cover:uid'});
		if ($prefix !== 'unsplash') {
			return;
		}

		return $entity->{"cover:file_url"};
	}
}