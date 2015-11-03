$(function(){

	function add_style_on_ul(element,effect){
		element.addClass(effect);
	}

	function detect_style_to_add_on_ul(element){
		if( element.hasClass('nav-tabs') ){
			add_style_on_ul(element,'hoverboot-cadre');
		}
		else if( element.hasClass('nav-pills') ){
			add_style_on_ul(element,'hoverboot-pills');
		}else{
			add_style_on_ul(element,'hoverboot-pills');
		}
	}	

	if( $('ul[data-action~="hoverify-bootnav"]').length >=1 ){

		//Fews DOM's manipulations to prepare the script
		$('ul[data-action~="hoverify-bootnav"]').each(function(){
			var ul_to_hb = $(this);
			
			ul_to_hb.addClass('hoverboot');

			//Add a wrapper
			ul_to_hb.wrap("<div class='hoverboot-wrap'></div>");
			var wraper_hb = ul_to_hb.closest('.hoverboot-wrap');
			//Create the pill
			wraper_hb.append("<div class='hoverboot-pill'></div>");
			var pill_hb = wraper_hb.find('.hoverboot-pill');

			//Add class with the good effect
			detect_style_to_add_on_ul(ul_to_hb);

			//Initialize pill's css properties (width, height, position...)
			if( wraper_hb.find('ul>li.active').length >= 1) {
				var width_active_ini = wraper_hb.find('ul>li.active').width();
				var height_active_ini = wraper_hb.find('ul>li.active').height();
				var pos_left_active_ini = wraper_hb.find('>ul>li.active').position().left;
				var pos_top_active_ini = wraper_hb.find('>ul>li.active').position().top;

				pill_hb.width(width_active_ini);
				pill_hb.height(height_active_ini);
				pill_hb.css('left',pos_left_active_ini);
				pill_hb.css('top',pos_top_active_ini);
			}
		});

		//Run script on hover
		$('ul[data-action~="hoverify-bootnav"] > li').hover(function(){

			var pill_hb = $(this).closest('.hoverboot-wrap').find('.hoverboot-pill');
			pill_hb.stop().animate({ width : $(this).width(), left : $(this).position().left, top : $(this).position().top },{duration: 400, easing:'easeInQuart'} );

		},function(){

			if ($(this).closest('.hoverboot-wrap').find('ul>li.active').length>= 1) {
				var pill_hb = $(this).closest('.hoverboot-wrap').find('.hoverboot-pill');
				pill_hb.stop().animate({ width : $(this).closest('.hoverboot-wrap').find('ul>li.active').width(), left : $(this).closest('.hoverboot-wrap').find('ul>li.active').position().left ,  top : $(this).closest('.hoverboot-wrap').find('ul>li.active').position().top },{duration: 1000, easing:'easeOutBounce'} );
			}
		});


	}
});