<?php

$id = elgg_extract('id', $vars);

$photo = elgg()->{'posts.illustrations'}->get($id);

if (!$photo) {
	return;
}

?>
<figure contenteditable="false">
	<?php
	echo elgg_view('output/img', [
		'src' => $photo->urls['full'],
		'alt' => elgg_echo('illustration:cover:author', [$photo->user['name']]),
	]);
	?>
    <figcaption>
		<?php
		if ($photo->user['name'] || $photo->user['portfolio_url']) {
			$author_link = elgg_view('output/url', [
				'text' => $photo->user['name'] ? : elgg_echo('illustration:cover:unknown'),
				'href' => $photo->user['portfolio_url'] ? : '#',
				'class' => 'illustration-cover-library-author',
			]);
			echo elgg_echo('illustration:cover:author', [$author_link]);
		}
		echo elgg_view('output/url', [
			'text' => 'Unsplash',
			'href' => $photo->links['html'] ? : '#',
			'class' => 'illustration-cover-library-provider',
		]);
		?>
    </figcaption>
</figure>
