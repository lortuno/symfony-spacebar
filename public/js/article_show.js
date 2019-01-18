jQuery(document.ready(function ($) {
	$('.e-like-article').on('click', function (e) {
		e.preventDefault();

		var $link = $(e.currentTarget),
			$articleCounter = '.rw-like-article-count';

		$link.toggleClass('fa-heart-o').toggleClass('fa-heart');
		$($articleCounter).html('test');
	});
})
);
