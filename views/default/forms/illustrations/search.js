define(function (require) {

	var $ = require('jquery');
	var Ajax = require('elgg/Ajax');
	var lightbox = require('elgg/lightbox');

	$(document).on('click', '.illustration-search-button', function(e) {
		e.preventDefault();

		var $form = $(this).closest('form');

		var q = $('.illustration-search-input', $form).val();
		var name = $('.illustration-search-name', $form).val();
		var quick_submit = $('.illustration-search-quick-submit', $form).val();

		if (!q) {
			return;
		}

		var ajax = new Ajax();
		ajax.path('illustrations/search', {
			data: {
				query: q,
				quick_submit: quick_submit,
				name: name
			}
		}).done(function(output) {
			$('.illustration-search-results', $form).html($(output));
			lightbox.resize();
		});
	});
});