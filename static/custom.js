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
				// console.log(Number($(".total-coub-count .loaded").html()));
				$(".total-coub-count .loaded").html(Number($(".total-coub-count .loaded").html()) + 10);
			});
			
		}
	});
	$(document).keydown(function(event) {
		if(event.ctrlKey && event.keyCode == 40) $(window).trigger('scroll'); // Ctrl + Стрелка вниз
	});

	// Попап
    $(".cpp").click(function(event) {
        event.preventDefault();
        $(".overlay .inner > *").hide();
        $(".overlay, .overlay ."+$(this).data('pp')).fadeIn(150).find("input[type='text']").val('');
    });
    $(".overlay").click(function(event) {
        if(!$(".popup").is(event.target) && $(".popup").has(event.target).length === 0 || event.target.className == "close") $(".overlay").fadeOut(150);
    });

    $(".add_coub").submit(function(event) {
    	event.preventDefault();
    	$.post(path.ajax, $(this).serialize(), function(data) {
    		$(".overlay").fadeOut(150);
    	});
    });
	
});