<?php

namespace hypeJunction\Illustration;

use Elgg\Http\ResponseBuilder;
use Elgg\Request;

class IllustrationSearchController {

	/**
	 * Search illustrations
	 *
	 * @param Request $request Request
	 *
	 * @return ResponseBuilder
	 */
	public function __invoke(Request $request) {
		
		$output = elgg_view('input/post/illustration', [
			'query' => $request->getParam('query'),
			'quick_submit' => $request->getParam('quick_submit'),
			'name' => $request->getParam('name'),
		]);

		return elgg_ok_response($output);
	}
}