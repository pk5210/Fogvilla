jQuery.noConflict();
jQuery(document).ready(function($){

	// Menu Sorting	
	$(window).bind("resize", function(){
		var $container = $(".dt-sc-rooms-container");
		if( $container.length) {
			$($container).each(function(){
				$(this).css({overflow:'hidden'}).isotope({itemSelector : '.column',masonry: { gutter: 23 } });
			});
		}
	});

	$(window).load(function(){

		var $container = $(".dt-sc-rooms-container");

		if( $container.length) {
			$($container).each(function(){
				$(this).isotope({
					filter: '*',
					masonry: { gutter: 23 },
					animationOptions: { duration:750, easing: 'linear',  queue: false }
				});
			});
		}

		if($("div.dt-sc-hotel-room-sorting").length){
			$("div.dt-sc-hotel-room-sorting a").on('click',function(){
				$("div.dt-sc-hotel-room-sorting a").removeClass("active-sort");
				$(this).addClass("active-sort");
				var selector = $(this).attr('data-filter');
				var $container = $(this).parents(".dt-sc-hotel-room-sorting").next(".dt-sc-rooms-container");

				$container.isotope({
					filter: selector,
					masonry: { gutter: 23 },
					animationOptions: { duration:750, easing: 'linear',  queue: false }
				});
				return false;
			});
		}
	});
	
	if($('.booknow-container').length > 0) {
		$('.btn-book').each(function(){
			$(this).fancybox({
				scrolling: 'no',
				width: 'auto',
				height: 'auto'
			});
		});
	}

	// Ajax Submit
	$('.booknow-frm, .reserve-frm').submit(function () {

		var This = $(this);
        var data_value = null;
		var ajax = This.prev(".ajax_message");
		alert(This);

		if($(This).valid()) {
			var action = $(This).attr('action');

			data_value = decodeURI($(This).serialize());
			$.ajax({
                 type: "POST",
                 url:action,
                 data: data_value,
                 success: function (response) {
                   $(ajax).html(response);
                   $(ajax).slideDown('slow');
                   if (response.match('success') !== null){ $(This).slideUp('slow'); }
                 }
            });
        }
        return false;
    });

	$('#txtarrivedate, .txtarrivedate, #txtchkindate, #txtchkoutdate').datepicker({
		dateFormat: 'dd-M-yy',
		minDate: 0,
		numberOfMonths: 1
	});

	// Room slider
	if( $(".dt-room-single-slider").find("li").length > 1 ) {
		$(".dt-room-single-slider").bxSlider({ auto:false, video:true, useCSS:false, pagerCustom: '#bx-pager', autoHover:true, adaptiveHeight:true, controls:false });
	}

});