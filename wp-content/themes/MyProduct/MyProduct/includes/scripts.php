<?php global $shortname; ?>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/superfish.js"></script>
	<script type="text/javascript">
	//<![CDATA[
		jQuery.noConflict();

		et_top_menu();
		et_search_bar()
		et_footer_improvements('#footer .widget');

		<!---- Top Menu Improvements ---->
		function et_top_menu(){
			jQuery('ul.superfish').superfish({
				delay:       300,                            // one second delay on mouseout
				animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation
				speed:       'fast',                          // faster animation speed
				autoArrows:  true,                           // disable generation of arrow mark-up
				dropShadows: false                            // disable drop shadows
			}).find('> li > a.sf-with-ul').parent('li').addClass('sf-ul');

			<?php if (get_option($shortname.'_disable_toptier') == 'on') echo('jQuery("ul.nav > li > ul").prev("a").attr("href","#");'); ?>
		};

		<!---- Footer Improvements ---->
		function et_footer_improvements($selector){
			var $footer_widget = jQuery($selector);

			if (!($footer_widget.length == 0)) {
				$footer_widget.each(function (index, domEle) {
					if ((index+1)%3 == 0) jQuery(domEle).addClass("last").after("<div class='clear'></div>");
				});
			};
		};


		<!---- Search Bar Improvements ---->
		function et_search_bar(){
			var $searchform = jQuery('#header div#search-form'),
				$searchinput = $searchform.find("input#searchinput"),
				searchvalue = $searchinput.val();

			$searchinput.focus(function(){
				if (jQuery(this).val() === searchvalue) jQuery(this).val("");
			}).blur(function(){
				if (jQuery(this).val() === "") jQuery(this).val(searchvalue);
			});
		};


		<!---- et_switcher plugin ---->
		(function($)
		  {
			 $.fn.et_switcher = function(options)
			 {
				var defaults =
				{
				   slides: '>div',
				   activeClass: 'active',
				   linksNav: '',
				   findParent: true, //use parent elements in defining lengths
				   lengthElement: 'li', //parent element, used only if findParent is set to true
				   useArrows: false,
				   arrowLeft: 'prevlink',
				   arrowRight: 'nextlink',
				   auto: false,
				   autoSpeed: 5000
				};

				var options = $.extend(defaults, options);

				return this.each(function()
				{

				   var slidesContainer = jQuery(this);
				   slidesContainer.find(options.slides).hide().end().find(options.slides).filter(':first').css('display','block');


				   var linkSwitcher = jQuery(options.linksNav);

				   linkSwitcher.click(function(){
					  var targetElement;

					  if (options.findParent) targetElement = jQuery(this).parent();
					  else targetElement = jQuery(this);

					  if (targetElement.hasClass('active')) return false;

					  targetElement.siblings().removeClass('active').end().addClass('active');

					  var ordernum = targetElement.prevAll(options.lengthElement).length;

					  slidesContainer.find(options.slides).filter(':visible').hide().end().end().find(options.slides).filter(':eq('+ordernum+')').stop().fadeIn(700);
					  return false;
				   });

				   jQuery('#'+options.arrowRight+', #'+options.arrowLeft).click(function(){

					  var slideActive = slidesContainer.find(options.slides).filter(":visible"),
						 nextSlide = slideActive.next(),
						 prevSlide = slideActive.prev();

					  if (jQuery(this).attr("id") == options.arrowRight) {
						 if (nextSlide.length) {
							var ordernum = nextSlide.prevAll().length;
						 } else { var ordernum = 0; }
					  };

					  if (jQuery(this).attr("id") == options.arrowLeft) {
						 if (prevSlide.length) {
							var ordernum = prevSlide.prevAll().length;
						 } else { var ordernum = slidesContainer.find(options.slides).length-1; }
					  };

					  slidesContainer.find(options.slides).filter(':visible').hide().end().end().find(options.slides).filter(':eq('+ordernum+')').stop().fadeIn(700);
					  return false;
				   });

				   if (options.auto) {
					  interval = setInterval(function(){
						 var slideActive = slidesContainer.find(options.slides).filter(":visible"),
							nextSlide = slideActive.next();

						 if (nextSlide.length) {
							var ordernum = nextSlide.prevAll().length;
						 } else { var ordernum = 0; }

						 linkSwitcher.filter(':eq('+ordernum+')').trigger("click");
					  },options.autoSpeed);
				   };

				});

			 }
		  })(jQuery);


		var $featured = jQuery('#featured'),
			$all_tabs = jQuery('#all_tabs'),
			$image_slideshow = jQuery('#image_slideshow');

		jQuery(window).load( function(){
			if ($featured.length) {
				$featured.et_switcher({
					linksNav: '#featured-control li a'
				});
			};

			if ($all_tabs.length) {
				$all_tabs.et_switcher({
					linksNav: 'ul#tab_controls li a'
				});

				$all_tabs.parents(".sidebar-block").prev(".sidebar-block").addClass("noborder");
			};

			jQuery('.js #image_slideshow').css('display','block');
			  if ($image_slideshow.length) {
				 $image_slideshow.find("#images").et_switcher({
					slides: '>img',
					linksNav: '#switcher-content a',
					findParent: false,
					lengthElement: 'a',
										auto: true
				 });
			  };
		} );

		jQuery("#sidebar .sidebar-block:last-child").addClass("noborder");

		var $comments = jQuery('ol.commentlist');

		if ($comments.length) {
			$comments.find(">li").after('<span class="bottom_bg"></span>');
		};

	//]]>
	</script>