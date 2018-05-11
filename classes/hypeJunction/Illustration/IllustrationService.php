<?php

namespace hypeJunction\Illustration;

use Crew\Unsplash\Photo;
use Elgg\Cache\CompositeCache;
use Elgg\Request;
use Unsplash\OAuth2\Client\Provider\Unsplash;

class IllustrationService {

	/**
	 * @var CompositeCache
	 */
	protected $cache;

	/**
	 * Constructor
	 *
	 * @param CompositeCache $cache Cache
	 */
	public function __construct(CompositeCache $cache) {
		$this->cache = $cache;
	}

	/**
	 * Flush cache
	 */
	public function flushCache() {
		$this->cache->clear();
	}

	/**
	 * Init the client
	 *
	 * @return bool
	 */
	public function init() {
		$plugin = elgg_get_plugin_from_id('hypeIllustration');

		if ($plugin->unsplash_app_id && $plugin->unsplash_app_secret && $plugin->unsplash_app_key) {
			\Crew\Unsplash\HttpClient::init([
				'applicationId' => $plugin->unsplash_app_key,
				'secret' => $plugin->unsplash_app_secret,
				'callbackUrl' => elgg_generate_url('illustrations:callback'),
				'utmSource' => $plugin->unsplash_app_id,
			]);

			return true;
		}

		return false;
	}

	/**
	 * Generate a connection URL for non-public scope auth
	 *
	 * @param array $scopes Scopes
	 *
	 * @return string
	 */
	public function getConnectionUrl(array $scopes = ['public']) {
		$this->init();

		return \Crew\Unsplash\HttpClient::$connection->getConnectionUrl($scopes);
	}

	/**
	 * Digest oAuth callback
	 *
	 * @param Request $request Request
	 *
	 * @return void
	 */
	public function digestCallback(Request $request) {
		$this->init();

		$code = $request->getParam('code');

		$token = \Crew\Unsplash\HttpClient::$connection->generateToken($code);

		if ($token) {
			elgg_set_plugin_user_setting('unsplash_token', json_encode($token), 0, 'hypeIllustration');
		}
	}

	/**
	 * Search images
	 *
	 * @param string $query       Query
	 * @param int    $limit       Max number of results
	 * @param string $orientation Image orientation
	 *
	 * @return Photo[]
	 */
	public function find($query, $limit = 20, $orientation = 'landscape') {
		$this->init();

		$response = \Crew\Unsplash\Search::photos($query, 1, $limit, $orientation);

		$results = $response->getResults();

		$photos = [];

		foreach ($results as $result) {
			$photo = new Photo($result);
			$photos[] = $photo;

			$this->cache->save($photo->id, $photo);
		}

		return $photos;
	}

	/**
	 * Get a photo from its id
	 *
	 * @param string $id Photo id
	 *
	 * @return Photo
	 */
	public function get($id) {
		$this->init();

		$result = $this->cache->load($id);
		if ($result) {
			return $result;
		}

		return Photo::find($id);
	}
}