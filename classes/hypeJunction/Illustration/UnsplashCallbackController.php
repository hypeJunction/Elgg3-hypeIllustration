<?php

namespace hypeJunction\Illustration;

use Elgg\Http\ResponseBuilder;
use Elgg\Request;

class UnsplashCallbackController {

	/**
	 * Digest Unsplash OAuth callback
	 *
	 * @param Request $request Request
	 * @return ResponseBuilder
	 */
	public function __invoke(Request $request) {

		elgg()->{'posts.illustrations'}->digestCallback($request);

		return elgg_redirect_response('');
	}
}