$(document).ready(function() {

	function fancyAppoint() {
		$("#coub_page .link").fancybox({
			type: 'iframe',
			iframe: {
				scrolling: 'auto',
				preload: false
			}
		});
	}
	fancyAppoint();

	var inProcess = false;
	$(window).scroll(function() {
		if($(window).scrollTop() + $(window).height() >= $(document).height() && !inProcess) {
			$.ajax({
				url: 'ajax.php',
				type: 'POST',
				dataType: 'html',
				data: {
					CODE: 'more',
					FROM: $("#coub_page .item").last().data('id')
				},
				beforeSend: function() {
					inProcess = true;
				}
			})
			.done(function(data) {
				$("#coub_page .wrap").append(data);
				fancyAppoint();
				inProcess = false;
			});
			
		}
	});
	$(document).keydown(function(event) {
		if(event.ctrlKey && event.keyCode == 40) $(window).trigger('scroll');
	});

	$("#coub_page form").submit(function(event) {
		event.preventDefault();
		$.post('ajax.php', $(this).serialize(), function(data) {
			$("#coub_page .wrap").empty().append(data);
		});
	});

});