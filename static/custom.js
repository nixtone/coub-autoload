$(document).ready(function() {
    
    var path = {
        ajax: '/core/dev/inc/ajax.php'
    };

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
	/*
    var inProcess = false;
	$(window).scroll(function() {
		if($(window).scrollTop() + $(window).height() >= $(document).height() && !inProcess) {
			$.ajax({
				url: path.ajax,
				type: 'POST',
				dataType: 'html',
				data: {
					CODE: 'MORE',
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
		if(event.ctrlKey && event.keyCode == 40) $(window).trigger('scroll'); // Ctrl + Стрелка вниз
	});
	*/
});