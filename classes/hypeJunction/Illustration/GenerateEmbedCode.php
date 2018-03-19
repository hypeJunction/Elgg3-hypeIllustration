<?php

namespace hypeJunction\Illustration;

use Elgg\Http\ResponseBuilder;
use Elgg\Request;

class GenerateEmbedCode {

	/**
	 * Generates illustration embed code
	 *
	 * @param Request $request Request
	 * @return ResponseBuilder
	 */
	public function __invoke(Request $request) {

		$uid = $request->getParam('uid');

		$output = elgg_view('embed/safe/illustration', [
			'id' => $uid,
		]);

		return elgg_ok_response($output);
	}
}