jQuery(document).ready(
	function ($) {
		$('.e-like-article').on('click', function (e) {
			e.preventDefault();

			var $link = $(e.currentTarget),
				$articleCounter = '.rw-like-article-count';

			$link.toggleClass('fa-heart-o').toggleClass('fa-heart');

			$.ajax({
			    method: 'POST',
				url: $link.attr('href')
			}).done(function(data){
				$($articleCounter).html(data.likes);
			});

			$($articleCounter).html('test');
		});
	}
);
