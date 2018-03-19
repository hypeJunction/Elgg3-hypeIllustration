<?php

$name = elgg_extract('name', $vars);

$query = elgg_extract('query', $vars);
$value = (array) elgg_extract('value', $vars, []);

if (!$query) {
	return;
}

try {
	$photos = elgg()->{'posts.illustrations'}->find($query);
} catch (\Crew\Unsplash\Exception $ex) {
	echo elgg_format_element('p', [
		'class' => 'elgg-no-results',
	], $ex->getMessage());
	return;
}

if (empty($photos)) {
	echo elgg_format_element('p', [
		'class' => 'elgg-no-results',
	], elgg_echo('illustration:search:no_results'));
	return;
}
?>

<div class="illustration-cover-libary">
	<?php
	foreach ($photos as $photo) {
		?>
		<div>
			<?php
			echo elgg_format_element('input', [
				'type' => 'radio',
				'name' => $name,
				'value' => $photo->id,
				'id' => $photo->id,
				'checked' => elgg_extract('uid', $value) === $photo->id,
				'class' => 'illustration-cover-library-input',
			])
			?>
			<label for="<?= $photo->id ?>" class="illustration-cover-library-photo"
				   style="background-image:url(<?= $photo->urls['regular'] ?>">
				<?php
                if (elgg_extract('quick_submit', $vars, false)) {
					echo elgg_view('input/submit', [
						'#type' => 'submit',
						'value' => elgg_echo('illustration:cover:use'),
						'class' => 'illustration-cover-pick-confirm',
					]);
				}
				?>
				<div class="illustration-cover-library-attribution">
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
				</div>
			</label>
		</div>
		<?php
	}
	?>
</div>
