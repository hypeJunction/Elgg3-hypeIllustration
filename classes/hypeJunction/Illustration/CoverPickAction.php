<?php

namespace hypeJunction\Illustration;

use Elgg\BadRequestException;
use Elgg\EntityPermissionsException;
use Elgg\Http\ResponseBuilder;
use Elgg\Request;

class CoverPickAction {

	/**
	 * Cover upload action
	 *
	 * @param Request $request Request
	 *
	 * @return ResponseBuilder
	 * @throws EntityPermissionsException
	 */
	public function __invoke(Request $request) {

		$entity = $request->getEntityParam();
		if (!$entity || !$entity->canEdit()) {
			throw new EntityPermissionsException();
		}

		$value = $request->getParam('cover_artwork');

		if (!$value) {
			throw new BadRequestException();
		}

		$entity->deleteIcon('cover');

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

		$request->elgg()->events->trigger('update', 'object:cover', $entity);

		$msg = $request->elgg()->echo('hero:cover:pick:success');
		$url = $entity->getURL();

		return elgg_ok_response([
			'cover_url' => $entity->getIconURL(['type' => 'cover', 'size' => 'hero']),
		], $msg, $url);

	}
}