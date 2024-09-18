(function($) {	
	"use strict";

var DZWPScript =  function (){
	
	var screenWidth = jQuery( window ).width();	
	if(typeof jobzilla_js_data == 'undefined'){
		var siteUrl                      = '/';	
		var login_on_mobile				 = false;
		var register_on_mobile			 = false;
		var header_social_link_on_mobile = false;
	}else{
		var siteUrl 					 = jobzilla_js_data.template_directory_url+'/';	
		var login_on_mobile				 = jobzilla_js_data.login_on_mobile;
		var register_on_mobile			 = jobzilla_js_data.register_on_mobile;
		var header_social_link_on_mobile = jobzilla_js_data.header_social_link_on_mobile;
		
	}
	var WebsiteLaunchDate = new Date(); /* Default website launch date one month plus in current date */
	var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	WebsiteLaunchDate.setMonth(WebsiteLaunchDate.getMonth() + 1);
	WebsiteLaunchDate =  WebsiteLaunchDate.getDate() + " " + monthNames[WebsiteLaunchDate.getMonth()] + " " + WebsiteLaunchDate.getFullYear();
  
	var themeWorkOnMobile = function() {		
		if(screenWidth <= 991){
			if(login_on_mobile == 'No') { jQuery('.dz-login-btn').hide(); }
			if(register_on_mobile == 'No') { jQuery('.dz-register-btn').hide(); }
			if(header_social_link_on_mobile == 'No') { jQuery('.dz-social-link').hide(); }
		}else{
			jQuery('.dz-login-btn, .dz-register-btn, .dz-social-link').show(); 
		}	
	}
  
	var handleMegaMenu = function (){		
		/*--------------- STARTS- AJAX Load Mega menu posts ------------------*/
		function load_mega_menu_posts() {
				var cat_slug = jQuery(this).attr('id').split('st_')[1];	
				var posts_per_page = parseInt(jQuery(this).data('posts-per-page'));
				var cat_id = parseInt(jQuery(this).data('cat-id'));		
				var images_only = jQuery(this).data('images-only');		
				var data = {
						'action': 'load_mega_menu_posts_by_ajax',
						'page': 1,					
						'posts_per_page': posts_per_page,					
						'posts_in_categories': cat_id,
						'mega_menu_images_only': images_only,
						'security': jobzilla_js_data.ajax_security_nonce
					};			
				
					jQuery.ajax({
						method: 'POST',
						url: jobzilla_js_data.admin_ajax_url,
						type: 'JSON',
						data: data,
						beforeSend : function ( xhr ) {
							jQuery("#"+ cat_slug).html("<div class='dz-menu-loading' ></div>");
						},
						success:function(response){                
							if( response ) { 
								jQuery("#"+ cat_slug).html(response);					
							}
						},
						complete : function(){		
							header_blog_carousel();
						}	
					}); 
		}
		
		if(jQuery("a.post-tabs").length > 0){	
			jQuery("a.post-tabs").off('mouseover',load_mega_menu_posts);
			jQuery("a.post-tabs").on('mouseover',load_mega_menu_posts);
		}
		/*--------------- END- AJAX Load Mega menu posts ------------------*/
	
	}
	
	
	var handleLoadMore = function (){
		/*--STARTS- AJAX Load more posts for Blog Listing King Elements --*/
		function load_more_posts() {
		  
			jQuery("a.dz-load-more").on('click', function()
			{				
				jQuery(this).addClass('active');
				var loadMoreBtnId = jQuery(this).attr('id');
				var post_type = jQuery(this).data('post-type');
				var ajax_container = jQuery(this).data('ajax-container');
				var blog_view = jQuery(this).data('blog-view');		
				var max_num_pages = parseInt(jQuery(this).data('max-num-pages'));
				var posts_per_page = parseInt(jQuery(this).data('posts-per-page'));		
				var posts_image_preference = jQuery(this).data('image-preference');		
				var post_by_label = jQuery(this).data('post-by-label');		
				var post_order = jQuery(this).data('post-order');		
				var post_order_by = jQuery(this).data('post-order-by');		
				var posts_in_categories = jQuery(this).data('posts-in-categories');
				var side_bar = jQuery(this).data('side-bar');
				var title_text_limit = jQuery(this).data('title-text-limit');
				var description_text_limit = jQuery(this).data('description-text-limit');				
				var show_date = jQuery(this).data('show-date');
				var show_author = jQuery(this).data('show-author');
				var show_comment = jQuery(this).data('show-comment');
				var element_style = jQuery(this).data('element-style');
				var show_share = jQuery(this).data('show-share');
				var show_column = jQuery(this).data('show-column');
				var hide_category = jQuery(this).data('hide-category');
				
				var data = {
						'action': 'load_posts_by_ajax',
						'page': page_no,
						'post_type': post_type,
						'blog_view': blog_view,
						'posts_per_page': posts_per_page,
						'max_num_pages': max_num_pages,					
						'posts_in_categories': posts_in_categories,
						'posts_image_preference' : posts_image_preference,
						'post_by_label' : post_by_label,
						'post_order' : post_order,
						'post_order_by' : post_order_by,
						'side_bar' : side_bar,
						'title_text_limit' : title_text_limit,
						'description_text_limit' : description_text_limit,						
						'show_date' : show_date,
						'show_author' : show_author,
						'show_comment' : show_comment,
						'show_share' : show_share,
						'show_column' : show_column,
						'element_style' : element_style,
						'hide_category' : hide_category,					
						'security': jobzilla_js_data.ajax_security_nonce,
				};
		  		
				var remove_loadmore_button = false;
				
				jQuery.ajax({
					method: 'POST',
					url: jobzilla_js_data.admin_ajax_url,
					type: 'JSON',
					data: data,
					beforeSend : function ( xhr ) {
					},
					success:function(response){
						if( response ) { 					
							var content = jQuery( response );					
							
							if(jQuery('#'+ajax_container).hasClass("masonry")){
								jQuery('#'+ajax_container).append(content).masonry( 'appended', content );
								
								masonryBoxFilter();
								
							}else{
								jQuery('#'+ajax_container).append(content);
								jQuery('#'+ajax_container+' div.hide-items').show('slow').removeClass(' hide-items ');
							}
							
							setTimeout(function(){			
							 header_blog_swiper();
							 MagnificPopup();
							}, 1000);
							
							if(page_no < max_num_pages)	{						
								page_no++;
							}
							else{
								remove_loadmore_button = true; 
							}
						}
						else {
							remove_loadmore_button = true;
						}
					},
					error : function(response){
						alert('Error in your ajax, plz check thirdparty plugins file for correct file path');
					},
					fail : function(response){				
						alert('Error in your ajax, plz check thirdparty plugins file for correct file path');				
					},
					complete : function(){
						jQuery("#"+loadMoreBtnId).removeClass('active');
						if(remove_loadmore_button){
							jQuery("#"+loadMoreBtnId).html('No More Post Available').addClass('disabled');
						}
					}			
				}); 
				return false;
			});
		} 
		
		if(jQuery("a.dz-load-more").length > 0){		
			load_more_posts();
			
			var page_no = 2;		
		}	
	}
	
	var handleCommonPageLoadMore = function (){
		
		/*---------------	STARTS- AJAX Load for 
						Author, Archive, Category, Search, Tag pages posts ---------------*/
		function load_common_page_posts_ajax() {		
			var max_num_pages = parseInt(jQuery('a.common-page-dz-load-more').data('max-num-pages'));
			var posts_per_page = parseInt(jQuery('a.common-page-dz-load-more').data('posts-per-page'));
			var common_page_type = jQuery('a.common-page-dz-load-more').data('common-page-type');
			var post_order = jQuery('a.common-page-dz-load-more').data('order');		
			var post_order_by = jQuery('a.common-page-dz-load-more').data('orderby');
			var data = {
					'action': 'load_common_page_posts_ajax',
					'page': page_no,
					'page_view': jQuery('a.common-page-dz-load-more').data('common-page-view'),
					'posts_per_page': posts_per_page,		
					'orderby': post_order_by,					
					'order': post_order,		
					'security': jobzilla_js_data.ajax_security_nonce
				};	
			var remove_loadmore_button = false;	
			
			if( (typeof( jQuery('a.common-page-dz-load-more').data('object-data') ) != undefined) ){
				var object_data = jQuery('a.common-page-dz-load-more').data('object-data');
				jQuery.extend( data, {'object_data': object_data} );
			}
			
			jQuery.ajax({
				method: 'POST',
				url: jobzilla_js_data.admin_ajax_url,
				type: 'JSON',
				data: data,
				beforeSend : function ( xhr ) {
					jQuery("a.common-page-dz-load-more").html('Load More <i class="fa fa-refresh fas fa-spinner fa-spin"></i>');
				},
				success:function(response){                
					if( response ) { 
						
						var content = jQuery( response );					
						
						if(jQuery('#masonry').length > 0 || jQuery('.masonry').length > 0){
							setTimeout(function() {
								jQuery('div.loadmore-content').append(content).masonry( 'appended', content );
							}, 500);	
						}else{
							jQuery('div.loadmore-content').append(content);
							jQuery('div.loadmore-content div.hide-items').show('slow').removeClass(' hide-items ');
						}
						
						setTimeout(function(){
							 header_blog_swiper();
							 MagnificPopup();
						}, 1000);

						if(page_no < max_num_pages)	{						
							page_no++;							
							setTimeout(function() {
								jQuery("a.common-page-dz-load-more").text('Load More');
							}, 550);
						}
						else{
							remove_loadmore_button = true;							
						}
					}else {
						remove_loadmore_button = true;						
					}
				},
				complete : function(){
					jQuery("a.common-page-dz-load-more").removeClass('active');
					if(remove_loadmore_button){
						jQuery("a.common-page-dz-load-more").html('No More Post Available').addClass('disabled');
					}
				}							
			}); 
		} 	
		
		if(jQuery("a.common-page-dz-load-more").length > 0){ 	
			var page_no = 2;		
			jQuery("a.common-page-dz-load-more").off('click',load_common_page_posts_ajax);
			jQuery("a.common-page-dz-load-more").on('click',load_common_page_posts_ajax);
		}		
	}
	
	var handleIndexPageLoadMore = function (){
		
		/*--------------- STARTS- AJAX Load Latest posts on index page------------------*/
		function load_latest_posts_ajax() {		
			var max_num_pages = parseInt(jQuery('a.latest-post-dz-load-more').data('max-num-pages'));
			var posts_per_page = parseInt(jQuery('a.latest-post-dz-load-more').data('posts-per-page'));		
			var data = {
					'action': 'load_latest_posts_ajax',
					'page': page_no,				
					'posts_per_page': posts_per_page,					
					'security': jobzilla_js_data.ajax_security_nonce
				};	
			var remove_loadmore_button = false;
			
			jQuery.ajax({
				method: 'POST',
				url: jobzilla_js_data.admin_ajax_url,
				type: 'JSON',
				data: data,
				beforeSend : function ( xhr ) {
					jQuery("a.latest-post-dz-load-more").html('Load More <i class="fa fa-refresh fas fa-spinner fa-spin"></i>');
				},
				success:function(response){                
					if( response ) { 
					
						var content = jQuery( response );					
						
						if(jQuery('#masonry').length > 0){
							setTimeout(function() {
								jQuery('div.loadmore-content').append(content).masonry( 'appended', content );
							}, 500);	
						}
						else{
							jQuery('div.loadmore-content').append(content);
							jQuery('div.loadmore-content div.hide-items').show('slow').removeClass(' hide-items ');
						}
						
						setTimeout(function(){
							MagnificPopup();
							header_blog_swiper();
						}, 1000);
						
						if(page_no < max_num_pages)	{						
							page_no++;
							
							setTimeout(function() {
								jQuery("a.latest-post-dz-load-more").text('Load More');
							}, 550);
						}
						else{
							remove_loadmore_button = true;							
						}
					}
					else {
						remove_loadmore_button = true;						
					}
				},
				
				complete : function(){
					jQuery("a.latest-post-dz-load-more").removeClass('active');
					if(remove_loadmore_button){
						jQuery("a.latest-post-dz-load-more").html('No More Post Available').addClass('disabled');
					}
				}					
			}); 
		} 
		
		if(jQuery("a.latest-post-dz-load-more").length > 0){ 	
			var page_no = 2;		
			jQuery("a.latest-post-dz-load-more").off('click',load_latest_posts_ajax);
			jQuery("a.latest-post-dz-load-more").on('click',load_latest_posts_ajax);
		}		
	}
	
	
	
	/* Magnific Popup ============ */
	var MagnificPopup = function(){
		
		if(jQuery('.popup-youtube, .popup-vimeo, .popup-gmaps').length > 0)
		{	
			/* magnificPopup for Play video function end */
			jQuery('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
				disableOn: 700,
				type: 'iframe',
				mainClass: 'mfp-fade',
				removalDelay: 160,
				preloader: false,
				fixedContentPos: false
			});		
		}		
	}
	
	var header_blog_carousel = function(){
		
		/* image-carousel function by = owl.carousel.js */
		jQuery('.header-blog-carousel').owlCarousel({
			loop:true,
			margin:20,
			autoplaySpeed: 3000,
			navSpeed: 3000,
			paginationSpeed: 3000,
			slideSpeed: 3000,
			smartSpeed: 3000,
			autoplay: 3000,
			nav:true,
			dots: false,
			rtl: (rtl_on == 'Yes')?true:false,
			navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{
					items:1,
					margin:10,
					center: true,
					stagePadding: 30
				},
				480:{
					items:1,
					margin:10,
					center: true,
					stagePadding: 30
				},			
				1024:{
					items:3
				},
				1200:{
					items:4
				},
				1400:{
					items:4
				}
			}
		});
	}
	
	var handleSubscription = function(){
		/* Subscription Element */
		jQuery(".dz-subscription").on('submit',function(e){
			e.preventDefault(); 
			var formSelector = jQuery(this);
			var data = jQuery(this).serializeArray();
			data.push({ name: "action", value: "dz_mailchimp" });
			formSelector.find('.dz-loading').removeClass('d-none').addClass('active');
			formSelector.find('.input-group').addClass('dz-ajax-overlay');
			jQuery.ajax({
				type : "post",
				url : jobzilla_js_data.admin_ajax_url,
				data : data,
				success: function(response) {
					formSelector[0].reset();
					formSelector.find('.dz-subscription-msg').hide('slow').html(response).show('slow');
					formSelector.find('.dz-loading').addClass('d-none').removeClass('active');
					formSelector.find('.input-group').removeClass('dz-ajax-overlay');
					setTimeout(function(){
						formSelector.find('.dz-subscription-msg').hide('slow');
					}, 5000);
				}
			})   
		});
		/* Subscription Element END */
	}
	/* Function ============ */
  
	
	
	/* Countdown ============ */
	var handleCountDown = function(){
		/* Time Countr Down Js */
		if($(".countdown").length){			
			var launchDate = jQuery('.countdown').data('date');			
			if(launchDate != undefined && launchDate != ''){
				WebsiteLaunchDate = launchDate;
			}			
			$('.countdown').countdown({date: WebsiteLaunchDate+' 23:5'}, function() {
				jQuery.ajax({
					type: 'POST',
					url: jobzilla_js_data.admin_ajax_url,
					data: "action=change_theme_status_ajax&security="+jobzilla_js_data.ajax_security_nonce,
					success: function(data) {
						location.reload();
					}
				});
			});
		}
		/* Time Countr Down Js End */
	}

	var handleFinalCountDown = function(){
	
		if(jQuery('#countdown-timer').length > 0 ){
			var launchDate = jQuery("#countdown-timer").attr("data-endtime");

			if(launchDate != undefined && launchDate != ''){
				WebsiteLaunchDate = launchDate;
			}
			
			var endTime = new Date(WebsiteLaunchDate);
			endTime = Date.parse(endTime) / 1000;

			  var now = new Date();
			  now = Date.parse(now) / 1000;

			  var timeLeft = endTime - now;

			  var days = Math.floor(timeLeft / 86400);
			  var hours = Math.floor((timeLeft - days * 86400) / 3600);
			  var minutes = Math.floor((timeLeft - days * 86400 - hours * 3600) / 60);
			  var seconds = Math.floor(
			    timeLeft - days * 86400 - hours * 3600 - minutes * 60
			  );

			  

			  if (days < 10) {
			    days = "0" + days;
			  }else if (days < 1) {
			    days = 0;
			  }

			  if (hours < 10) {
			    hours = "0" + hours;
			  }else if (hours < 1) {
			    hours = "0";
			  }

			  if (minutes < 10) {
			    minutes = "0" + minutes;
			  }else if (minutes < 1) {
			    minutes = "0";
			  }

			  if (seconds < 10) {
			    seconds = "0" + seconds;
			  }else if (seconds < 1) {
			    seconds = "0";
			  }

			  $("#countdown-timer").html(
			    "<span id='days'>" +
			    days +
			    "<span>Days</span></span>" +
			    "<span id='hours'>" +
			    hours +
			    "<span>Hrs</span></span>" +
			    "<span id='minutes'>" +
			    minutes +
			    "<span>Mins</span></span>" +
			    "<span id='seconds'>" +
			    seconds +
			    "<span>Secs</span></span>"
			  );

		}
	}
	
	/* Masonry Box ============ */
	var masonryBoxFilter = function(){
		if(jQuery('.filters').length > 0){	
			var masonryContainer = jQuery("#masonry, .masonry");			
			
			var $params = {
				itemSelector: ".card-container",
				filtersGroupSelector:".filters",
				selectorType: "list"
			};

			setTimeout(function(){
				/* Do masonry with filtering */ 
				masonryContainer.multipleFilterMasonry($params);			
			}, 300);
			
			setTimeout(function(){
				jQuery(".filters li").removeClass('active');
				jQuery(".filters li:first").addClass('active');
			}, 800);			
		}
	}
	/* Subscription Element END */
	var setCookie = function(cname, cvalue, exhours) {
		var d = new Date();
		d.setTime(d.getTime() + (exhours*60*60*1000)); /* exhours=30 means 30 Minutes*/
		var expires = "expires="+ d.toString();
		var sameSite = 'SameSite=strict;';
		document.cookie = cname + "=" + cvalue + ";" + expires + ";" + sameSite + "path=/";
	
	}

	var getCookie = function(cname) {
		var name = cname + "=";
		var decodedCookie = decodeURIComponent(document.cookie);
		var ca = decodedCookie.split(';');
		for(var i = 0; i <ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}

	var deleteCookie = function(cname) {
		var d = new Date();
		d.setTime(d.getTime() + (1)); /* 1/1000 second*/
		var expires = "expires="+ d.toString();
		document.cookie = cname + "=1;" + expires + ";path=/";
	}
	
	
	
	var handleJobAlertSubscription = function(){
		/* Job Alert Subscription Element */
		var close_interval = jQuery('#JobAlert').data('close_interval');
		var subscription_interval = jQuery('#JobAlert').data('subscription_interval');
		
		jQuery('.close').on('click',function(){
			setCookie('subscription_popup_hide','Yes',close_interval);
			jQuery('.subscription-alert-bx').hide();
		}); 
		
		jQuery("#JobAlertSubscription").on('submit',function(e){
			e.preventDefault(); 
			var formSelector = jQuery(this);
			var data = jQuery(this).serializeArray();
			data.push({ name: "action", value: "dz_create_job_alert_mailchimp" });
			jQuery('.site-button').addClass('disabled');
			jQuery.ajax({
				type : "post",
				url : jobzilla_js_data.admin_ajax_url,
				data : data,
				success: function(response) {
					formSelector[0].reset();
					formSelector.find('#JobMsg').show('slow').html(response);
					jQuery('.site-button').removeClass('disabled');
					setCookie('subscription_popup_successfully ','Yes',subscription_interval);
					jQuery("#JobAlert").hide('slow');
					setTimeout(function(){
						formSelector.find('#JobMsg').hide('slow');
						jQuery("#job_alert").modal('hide');
					}, 5000);
				}
			})   
		});
		if(getCookie('subscription_popup_hide') !='Yes' && getCookie('subscription_popup_successfully') !='Yes'){
			setTimeout(function() {
				jQuery("#JobAlert").show();
			}, 1000)
		}else{
			jQuery("#JobAlert").hide();
		}
		
		
	}
	var header_blog_swiper = function(){
		/*post-swiper*/
		 if(jQuery('.post-swiper-thumb').length > 0){
			var galleryTop = new Swiper('.post-swiper-thumb', {
			  spaceBetween: 10,
			  navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			  },
					loop: true,
					loopedSlides: 4
			});
			var galleryThumbs = new Swiper('.post-swiper-thumbs', {
			  spaceBetween: 10,
			  centeredSlides: true,
			  slidesPerView: 'auto',
			  touchRatio: 0.2,
			  slideToClickedSlide: true,
					loop: true,
					loopedSlides: 4
			});
			galleryTop.controller.control = galleryThumbs;
			galleryThumbs.controller.control = galleryTop;
		}
		if(jQuery('.post-swiper').length > 0){
			var swiper = new Swiper('.post-swiper', {
				speed: 1500,
				parallax: true,
				slidesPerView: 1,
				spaceBetween: 0,
				loop:true,
				autoplay: {
				   delay: 3000,
				},
				navigation: {
					nextEl: '.next-post-swiper-btn',
					prevEl: '.prev-post-swiper-btn',
				}
			});
		}
			
		
	}
	
	
	
	/* Function ============ */
	
	return {
		init:function(){
			handleMegaMenu();
			handleLoadMore();
			handleCommonPageLoadMore();
			handleIndexPageLoadMore();
			handleSubscription();
			handleJobAlertSubscription();
			header_blog_swiper();
			setInterval(function() {
			  handleFinalCountDown();
			}, 1000);
		},				
		load:function(){
			themeWorkOnMobile();
			handleJobAlertSubscription();
		},		
		resize:function(){
			screenWidth = $(window).width();
			
			themeWorkOnMobile();
		},		
	}
}();

/* Document.ready Start */	
jQuery(document).ready(function() {
    'use strict';
	DZWPScript.init();	
});
/* Document.ready END */


/* Window Resize START */
jQuery(window).on('load',function () {
	'use strict'; 
	DZWPScript.load();
});
/*  Window Resize END */

/* Window Resize START */
jQuery(window).on('resize',function () {
	'use strict'; 
	DZWPScript.resize();
});
/*  Window Resize END */

/* messages send by ajax */
})(jQuery);	