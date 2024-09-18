/* =====================================
All JavaScript fuctions Start
======================================*/
(function ($) {
	
    'use strict';

    var screenWidth = $( window ).width();
/*--------------------------------------------------------------------------------------------
	document.ready ALL FUNCTION START
---------------------------------------------------------------------------------------------*/	

/*  selectpicker function by = bootstrap-select.min.js ==========================  */
	function select_picker_select(){
		jQuery('.my-select').selectpicker();
	}



/*  Video responsive function by = custom.js ========================= 	 */
	function video_responsive(){	
		jQuery('iframe[src*="youtube.com"]').wrap('<div class="embed-responsive embed-responsive-16by9"></div>');
		jQuery('iframe[src*="vimeo.com"]').wrap('<div class="embed-responsive embed-responsive-16by9"></div>');	
	}  


/*  magnificPopup for video function	by = magnific-popup.js =====================  */
	function magnific_video(){	
		jQuery('.mfp-video').magnificPopup({
			type: 'iframe',
		});
	}

/*  Vertically center Bootstrap modal popup function by = custom.js ============== */
	function popup_vertical_center(){	
		jQuery(function() {
			function reposition() {
				var modal = jQuery(this),
				dialog = modal.find('.modal-dialog');
				modal.css('display', 'block');
				
				 /* Dividing by two centers the modal exactly, but dividing by three 
				 or four works better for larger screens. */
				dialog.css("margin-top", Math.max(0, (jQuery(window).height() - dialog.height()) / 2));
			}
			/*  Reposition when a modal is shown */
			jQuery('.modal').on('show.bs.modal', reposition);
			/*  Reposition when the window is resized */
			jQuery(window).on('resize', function() {
				jQuery('.modal:visible').each(reposition);
			});
		});
	}

/*  Sidebar sticky  when scroll down function by = theia-sticky-sidebar.js ==========  */
	function sticky_sidebar(){		
		$('.rightSidebar')
			.theiaStickySidebar({
				additionalMarginTop: 100
			});		
	}

/*  page scroll top on button click function by = custom.js =====================  */
	function scroll_top(){
		jQuery("button.scroltop").on('click', function() {
			jQuery("html, body").animate({
				scrollTop: 0
			}, 1000);
			return false;
		});

		jQuery(window).on("scroll", function() {
			var scroll = jQuery(window).scrollTop();
			if (scroll > 900) {
				jQuery("button.scroltop").fadeIn(1000);
			} else {
				jQuery("button.scroltop").fadeOut(1000);
			}
		});
	}
	
/*  input type file function by = custom.js ==========================   */	 
	function input_type_file_form(){
		jQuery(document).on('change', '.btn-file :file', function() {
			var input = jQuery(this),
				numFiles = input.get(0).files ? input.get(0).files.length : 1,
				label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [numFiles, label]);
		});

		jQuery('.btn-file :file').on('fileselect', function(event, numFiles, label) {
			var input = jQuery(this).parents('.input-group').find(':text'),
				log = numFiles > 10 ? numFiles + ' files selected' : label;
			if (input.length) {
				input.val(log);
			} else {
				if (log) alert(log);
			}
		});	
	}

 /* input Placeholder in IE9 function by = custom.js ======================== 	 */
	function placeholderSupport(){
	/* input placeholder for ie9 & ie8 & ie7 */
		jQuery.support.placeholder = ('placeholder' in document.createElement('input'));
		/* input placeholder for ie9 & ie8 & ie7 end*/
		/*fix for IE7 and IE8  */
		if (!jQuery.support.placeholder) {
			jQuery("[placeholder]").on('focus', function () {
				if (jQuery(this).val() === jQuery(this).attr("placeholder")) jQuery(this).val("");
			}).on('blur', function () {
				if (jQuery(this).val() === "") jQuery(this).val(jQuery(this).attr("placeholder"));
			}).blur();

			jQuery("[placeholder]").parents("form").on('submit', function () {
				jQuery(this).find('[placeholder]').each(function() {
					if (jQuery(this).val() === jQuery(this).attr("placeholder")) {
						 jQuery(this).val("");
					}
				});
			});
		}
		/*fix for IE7 and IE8 end */
	}	

	/*  Nav submenu show hide on mobile by = custom.js */
	function mobile_nav(){
		jQuery(".sub-menu").parent('li').addClass('has-child');
		
		if(screenWidth <= 991 ){
			jQuery('.navbar-nav > li > a, .sub-menu > li > a').unbind().on('click', function(e){
				
				if(jQuery(this).parent('li').has('ul').length > 0){e.preventDefault();}
				
				if(jQuery(this).parent().hasClass('open'))
				{
					jQuery(this).parent().removeClass('open');
				}else{
					if(jQuery(this).hasClass('sub-menu'))
					{
						jQuery(this).parent().addClass('open');
					}else{
						jQuery(this).parent().parent().find('li').removeClass('open');
						jQuery(this).parent().addClass('open');
					}
				}  
			});			
		}
	}
	
	/* header-sidebar */
	function sidebar_nav(){
		jQuery(".sub-menu").parent('li').addClass('has-child');
		
			jQuery('.navbar-nav > li > a, .sub-menu > li > a').unbind().on('click', function(e){
				
				if(jQuery(this).parent('li').has('ul').length > 0){e.preventDefault();}
				
				if(jQuery(this).parent().hasClass('open'))
				{
					jQuery(this).parent().removeClass('open');
				}else{
					if(jQuery(this).hasClass('sub-menu'))
					{
						jQuery(this).parent().addClass('open');
					}else{
						jQuery(this).parent().parent().find('li').removeClass('open');
						jQuery(this).parent().addClass('open');
					}
				}  
			});			
	} 
	 
	/*  Mobile side drawer function by = custom.js */
	function mobile_side_drawer(){
		jQuery('#mobile-side-drawer').on('click', function () { 
			jQuery('.mobile-sider-drawer-menu').toggleClass('active');
		});
	}	
	
//  Top Search bar Show Hide function by = custom.js =================== //	

	function site_search(){
		jQuery('a[href="#search"]').on('click', function(event) {                    
		jQuery('#search').addClass('open');
		jQuery('#search > form > input[type="search"]').focus();
	});
				
	jQuery('#search, #search button.close').on('click keyup', function(event) {
		if (event.target === this || event.target.className === 'close') {
			jQuery(this).removeClass('open');
		}
	});  
 	}	

 /*  Client logo Carousel function by = owl.carousel.js ==========================  */
	function home_client_carousel(){
	jQuery('.home-client-carousel').owlCarousel({
		loop:true,
		nav:false,
		dots: true,				
		margin:5,
		autoplay:true,
		navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
		responsive:{
			0:{
				items:2,
			},
			480:{
				items:3,
			},			
			767:{
				items:4,
			},
			1000:{
				items:4
			}
		}
	});
	}

	
	/*   Related jobs Carousel function by = owl.carousel.js ==========================  */
	function twm_related_jobs_carousel(){
		jQuery('.twm-related-jobs-carousel').owlCarousel({
			loop:true,
			nav:false,
			dots: true,				
			margin:30,
			autoplayTimeout:3000,
			navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{
					items:1,
				},
				480:{
					items:1,
				},			
				767:{
					items:2,
				},
				1000:{
					items:3
				}
			}
		});
	}

	
	/*  Trusted logo Carousel function by = owl.carousel.js ========================== */ 
	function trusted_logo(){
		jQuery('.trusted-logo').owlCarousel({
			loop:true,
			nav:false,
			dots: false,				
			margin:5,
			autoplay:true,
			navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{
					items:2,
				},
				480:{
					items:2,
				},			
				767:{
					items:2,
				},
				991:{
					items:2
				}
			}
		});
	}

	
	
	/*   Counter Section function by = counterup.min.js */
	function counter_section(){
		jQuery('.counter').counterUp({
			delay: 10,
			time: 3000
		});	
	}	

		
	/*  sidebarCollapse function by = custom.js */
	function msg_user_list_slide(){
		jQuery('.user-msg-list-btn-open, .user-msg-list-btn-close').on('click', function () { 
			jQuery('.wt-admin-dashboard-msg-2').toggleClass('active');
		});
	}		

	/*  sidebarCollapse function by = custom.js */
	function sidebarCollapse(){
		jQuery('.nav-open-btn').on('click', function(){ 
			jQuery('.page-wraper').toggleClass('active');
		});
	}

	/*  dashboard Notification function by = custom.js */
	function dashboard_noti_dropdown(){
		jQuery('.dashboard-noti-dropdown').on('click', function () { 
			jQuery('.dashboard-noti-panel').toggleClass('active');
		});
	}	
	
	/*  dashboard Message function by = custom.js */
	function dashboard_message_dropdown(){
		jQuery('.dashboard-message-dropdown').on('click', function () { 
			jQuery('.dashboard-message-panel').toggleClass('active');
		});
	}			

	/*  CustomScrollbar function by = jquery.scrollbar.js */
	function scroll_bar_custome(){	
		jQuery('.scrollbar-macosx').scrollbar();
	}


	/*  Jobs Bookmark table function by = dataTables.bootstrap5.js */
    function jobs_bookmark_table(){
        jQuery('#jobs_bookmark_table').DataTable(
            {     
                "aLengthMenu": [[3, 5, 10, -1], [3, 5, 10, "All"]],
                "iDisplayLength": 3
            } 
        );
    }
	
	/*  candidate_data_table function by = dataTables.bootstrap5.js */
    function candidate_data_table(){
        jQuery('#candidate_data_table').DataTable(
            {     
                "aLengthMenu": [[5, 8, 10, -1], [5, 8, 10, "All"]],
                    "iDisplayLength": 5
                } 
            );

		function checkAll(bx) {
			var cbs = document.getElementsByTagName('input');
			for(var i=0; i < cbs.length; i++) {
				if(cbs[i].type == 'checkbox') {
				cbs[i].checked = bx.checked;
				}
			}
    	}
	}

	/*  datepicker function by = dbootstrap-datepicker.js */
    function datepicker_function(){
		$('.datepicker').datepicker({
			format: 'dd/mm/yyyy'
		});
	}


	/*  view map sidebar function by = custom.js */
	function view_map_sidebar(){
		jQuery('.map-show-btn-open, .map-show-btn-close').on('click', function () { 
			jQuery('.half-map-section').toggleClass('active');
		});
	}
	/*   Radius Range Slider function by = bootstrap-slider.min.js ========================== */ 
	function radius_range(){
		if(jQuery("#ex2").length > 0){
			jQuery("#ex2").slider({});
		}
	}

	/* DropZone File Uploading Function Start========================= */
	function Dropzone_infut_file(){	
		if(jQuery('#demo-upload').length){
		var dropzone = new Dropzone('#demo-upload', {
		previewTemplate: document.querySelector('#preview-template').innerHTML,
		parallelUploads: 2,
		thumbnailHeight: 120,
		thumbnailWidth: 120,
		maxFilesize: 3,
		filesizeBase: 1000,
		thumbnail: function(file, dataUrl) {
			if (file.previewElement) {
			file.previewElement.classList.remove("dz-file-preview");
			var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
			for (var i = 0; i < images.length; i++) {
				var thumbnailElement = images[i];
				thumbnailElement.alt = file.name;
				thumbnailElement.src = dataUrl;
			}
			setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
			}
		}
	
		});
	
	
		/*  Now fake the file upload, since GitHub does not handle file uploads
		 and returns a 404 */
	
		var minSteps = 6,
			maxSteps = 60,
			timeBetweenSteps = 100,
			bytesPerStep = 100000;
	
		dropzone.uploadFiles = function(files) {
		var self = this;
	
		for (var i = 0; i < files.length; i++) {
	
			var file = files[i];
			totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));
	
			for (var step = 0; step < totalSteps; step++) {
			var duration = timeBetweenSteps * (step + 1);
			setTimeout(function(file, totalSteps, step) {
				return function() {
				file.upload = {
					progress: 100 * (step + 1) / totalSteps,
					total: file.size,
					bytesSent: (step + 1) * file.size / totalSteps
				};
	
				self.emit('uploadprogress', file, file.upload.progress, file.upload.bytesSent);
				if (file.upload.progress == 100) {
					file.status = Dropzone.SUCCESS;
					self.emit("success", file, 'success', null);
					self.emit("complete", file);
					self.processQueue();
					/* document.getElementsByClassName("dz-success-mark").style.opacity = "1"; */
				}
				};
			}(file, totalSteps, step), duration);
			}
		}
		}
		}
	} 
	/* DropZone File Uploading Function End =========================	 */


	/* Maximum input box fields function Start by custom.js============== */

	var max_fields      = 100; /* //maximum input boxes allowed */
	var wrapper   		= $(".input_fields_youtube"); /* //Fields wrapper */
	var wrapper_2   		= $(".input_fields_vimeo"); /* //Fields wrapper */
	var wrapper_3   		= $(".input_fields_custom"); /* //Fields wrapper */
	var add_button_youtube      = $(".add_field_youtube"); /* //Add button ID */
	var add_button_vimeo      = $(".add_field_vimeo"); /* //Add button ID */
	var add_custom_field      = $(".add_field_custom"); /* //Add button ID */
	
	var x = 1; /* //initlal text box count */
	$(add_button_youtube).on('click', function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ /* //max input box allowed */
			x++; /* //text box increment */
			$(wrapper).append('<div class="ls-inputicon-box"><input class="form-control wt-form-control m-tb10" name="mytext[]" type="text" placeholder="https://www.youtube.com/"><i class="fs-input-icon fab fa-youtube"></i><a href="#" class="remove_field"><i class="fa fa-times"></i></a></div>'); //add input box
		}
	});
	
	var x = 1; /* //initlal text box count */
	$(add_button_vimeo).on('click', function(e){ /* //on add input button click */
		e.preventDefault();
		if(x < max_fields){ /* //max input box allowed */
			x++; /* //text box increment */
			$(wrapper_2).append('<div class="ls-inputicon-box"><input class="form-control m-tb10 wt-form-control" name="mytext[]" type="text" placeholder="https://vimeo.com/"><i class="fs-input-icon fab fa-vimeo-v"></i><a href="#" class="remove_field"><i class="fa fa-times"></i></a></div>'); //add input box
		}
	});	

	var x = 1; /* //initlal text box count */
	$(add_custom_field).on('click', function(e){ /* //on add input button click */
		e.preventDefault();
		if(x < max_fields){ /* max input box allowed */
			x++; /* text box increment */
			$(wrapper_3).append('<div class="ls-inputicon-box"><input class="form-control m-tb10 wt-form-control" name="mytext[]" type="text" placeholder="Selet the role that you work in"><i class="fs-input-icon fa fa-user"></i><a href="#" class="remove_field"><i class="fa fa-times"></i></a></div>'); //add input box
		}
	});	
	
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})
	$(wrapper_2).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})	
	$(wrapper_3).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})	
	
/* Maximum input box fields function End by custom.js============== */

 /* Tooltip function by = isotope.pkgd.min.js =========================  */
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
	return new bootstrap.Tooltip(tooltipTriggerEl)
	
	
	
	
	
	
	
})
/*--------------------------------------------------------------------------------------------
	Window on load ALL FUNCTION START
---------------------------------------------------------------------------------------------*/
	/*  masonry function function by = isotope.pkgd.min.js =========================  */

	function masonryBox() {
		if ( jQuery().isotope ) {      
			var $container = jQuery('.masonry-wrap');
				$container.isotope({
					itemSelector: '.masonry-item',
					transitionDuration: '1s',
					originLeft: true,
					stamp: '.stamp',
				});

			$container.imagesLoaded().progress( function() {
				$container.isotope('layout');
			});

			jQuery('.masonry-filter li').on('click',function() {                           
				var selector = jQuery(this).find("a").attr('data-filter');
				jQuery('.masonry-filter li').removeClass('active');
				jQuery(this).addClass('active');
				$container.isotope({ filter: selector });
				return false;
			});
		};
	}
	

/*  page loader function by = custom.js =========================  */	
	function page_loader() {
		$('.loading-area,#loading-area').fadeOut(1000);
	}

/*--------------------------------------------------------------------------------------------
    Window on scroll ALL FUNCTION START
---------------------------------------------------------------------------------------------*/

    function color_fill_header() {
        var scroll = $(window).scrollTop();
        if(scroll >= 100) {
            $(".is-fixed").addClass("color-fill");
        } else {
            $(".is-fixed").removeClass("color-fill");
        }
    }
	/* Header Fixed ============ */
	function headerFix(){
		'use strict';
		/* Main navigation fixed on top  when scroll down function custom */		
		jQuery(window).on('scroll', function () {
			if(jQuery('.sticky-header').length > 0){
				var menu = jQuery('.sticky-header');
				if ($(window).scrollTop() > menu.offset().top) {
					menu.addClass('is-fixed');
				} else {
					menu.removeClass('is-fixed');
				}
			}
		});
		/* Main navigation fixed on top  when scroll down function custom end*/
	}
	/* Header Height ============ */
	
	function handleResizeElement(){
		var headerTop = 0;
		var headerNav = 0;
		
		$('.header .sticky-header').removeClass('is-fixed');
		$('.header').removeAttr('style');
		
		setTimeout(function(){

			if(jQuery('.header .top-bar').length > 0 &&  screenWidth > 991)
			{
				headerTop = parseInt($('.header .top-bar').outerHeight());
			}

			if(jQuery('.header .main-bar').length > 0 )
			{
				
				headerNav =	parseInt($('.header .main-bar').outerHeight());
			}	
			
			var headerHeight = headerNav + headerTop;
			
			jQuery('.header').css('height', headerHeight);
		
		}, 500);
		
	}
	
	function mobile_btn_fillter(){
		jQuery('.btn-fillter').on('click',function(){
			$('.fillter-sidebar').addClass('open');
			$('.sidebar-close').addClass('open');
		});
		jQuery('.sidebar-close').on('click',function(){
			$('.fillter-sidebar').removeClass('open');
			$('.sidebar-close').removeClass('open');
		});
	}
	function resize(){
		  if ($(window).width() <= 1199) {
			jQuery('.dz-mega-menu-mobile').removeClass('d-none');
			jQuery('.dz-mega-menu').addClass('d-none');
		  }
		 else {
			jQuery('.dz-mega-menu').removeClass('d-none');
			jQuery('.dz-mega-menu-mobile').addClass('d-none');
		 }
		if($(window).width() <= 991) {
		 jQuery('.masonry-item').parent().addClass("masonry-wrap");
		}else{
			jQuery('.masonry-item').parent().removeClass("masonry-wrap");
		}
	};
		

	function handleMenuPosition(){


		if(screenWidth > 1024){
			var elm , offff, l, w, docH, docW, isEntirelyVisible, aaaa;

			$(".navbar-nav li").unbind().each(function (e) {
				if ($('ul', this).length > 0) {
					
					elm = $('ul:first', this).css('display','block');
					aaaa = $('a:first', this).text();
					offff = elm.offset();
					l = offff.left;
					w = elm.width();
					
					elm = $('ul:first', this).removeAttr('style');
					docH = $("body").height();
					docW = $("body").width();
					
				
					isEntirelyVisible = (l + w >= docW) ? false : true;	

					
					if(jQuery('html').hasClass('rtl')){
						isEntirelyVisible = (l + w <= docW) ? false : true;	
					}else{
						isEntirelyVisible = (l + w >= docW) ? false : true;	
					}

					if (!isEntirelyVisible) {
						$(this).find('ul:first').addClass('left');
					} else {
						$(this).find('ul:first').removeClass('left');
					}
				}
			});
		}	
		
		
	}	
	function twm_side_navigation(){
		jQuery('#twm-side-navigation , .vnav-close').on('click', function () { 
			jQuery('.twm-side-navigation-menu').toggleClass('active');
		});
	}	

	function ordering_value(){
		jQuery('#orderby_id').on('change', function(){
			var value = jQuery(this).val();
			jQuery('#order_id, #sort_id').val(value);
		});
	} 
	
	
	function passwordStrength(){
		jQuery('#UserRegisterForm  [type="password"]').on('keyup',function() {
			
			
			var number = /([0-9])/;
			var alphabets = /([a-zA-Z])/;
			var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
			var password = jQuery(this).val().trim();
			var strengthBlock = jQuery('.password-strength');
			var strengthMessage = '';
			if(password.length<8) {
				strengthMessage = '<div class="weak-password">Weak should be at least 8 characters.</div>';
				strengthBlock.html(strengthMessage);
			} else {
				if(password.match(number) && password.match(alphabets) && password.match(special_characters)) {
					strengthMessage = '<div class="strong-password">Password is Strong.</div>';
					strengthBlock.html(strengthMessage);
				}else{
					strengthMessage = '<div class="medium-password">Medium should be include alphabets, numbers and special characters.</div>';
					strengthBlock.html(strengthMessage);
				}
			}

		});
		
	}
	
		/* Magnific Popup ============ */
	var MagnificPopup = function(){
		'use strict';	
		
		if(jQuery('.mfp-gallery').length > 0)
		{
			/* magnificPopup function */
			jQuery('.mfp-gallery').magnificPopup({
				delegate: '.mfp-link',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				mainClass: 'mfp-img-mobile',
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					/* preload: [0,1]  Will preload 0 - before current, and 1 after the current image */
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
					titleSrc: function(item) {
						return item.el.attr('title') + '<small></small>';
					}
				}
			});
			/* magnificPopup function end */
		}
		
		if(jQuery('.mfp-video').length > 0)
		{
			/* magnificPopup for Play video function */		
			jQuery('.mfp-video').magnificPopup({
				type: 'iframe',
				iframe: {
					markup: '<div class="mfp-iframe-scaler">'+
							 '<div class="mfp-close"></div>'+
							 '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
							 '<div class="mfp-title">Some caption</div>'+
							 '</div>'
				},
				callbacks: {
					markupParse: function(template, values, item) {
						values.title = item.el.attr('title');
					}
				}
			});			
		}

		if(jQuery('.popup-youtube, .popup-vimeo, .popup-gmaps').length > 0)
		{	
			/* magnificPopup for Play video function end */
			$('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
				disableOn: 700,
				type: 'iframe',
				mainClass: 'mfp-fade',
				removalDelay: 160,
				preloader: false,

				fixedContentPos: true
			});
		
		}		
	}
	
	
	
/*--------------------------------------------------------------------------------------------
	document.ready ALL FUNCTION START
---------------------------------------------------------------------------------------------*/
	jQuery(document).ready(function() {
		resize();
		
		headerFix();
		handleResizeElement();
		 /*  selectpicker function by = bootstrap-select.min.js ==========================  */
	    select_picker_select(),
		
		/*  Top Search bar Show Hide function by = custom.js  	 */	
		site_search(),	
		/*  Video responsive function by = custom.js  */
		video_responsive(),
		
		/*  magnificPopup for video function	by = magnific-popup.js */
		magnific_video(),
		/*  Vertically center Bootstrap modal popup function by = custom.js */
		popup_vertical_center();
		
	    /*  Sidebar sticky  when scroll down function by = theia-sticky-sidebar.js ========== 	 */
		sticky_sidebar(),
		
		/*  page scroll top on button click function by = custom.js	 */
		scroll_top(),
		/*  input type file function by = custom.js	 	 */
		input_type_file_form(),
		/*  input Placeholder in IE9 function by = custom.js		 */
		placeholderSupport(),
		/*  Nav submenu on off function by = custome.js ===================  */
		mobile_nav(),
		
		/* if(jQuery(document).data('sidebar') == 'header-sidebar'){ */
			sidebar_nav(),
		/* } */
		/*  Mobile side drawer function by = custom.js */
		mobile_side_drawer(),
		 /*  Client logo Carousel function by = owl.carousel.js ==========================  */
		home_client_carousel(),
		
		/*   Related jobs Carousel function by = owl.carousel.js ==========================  */
	    twm_related_jobs_carousel(),
		
		/*   Trusted logo Carousel function by = owl.carousel.js ==========================  */
		trusted_logo(),
		
		/*   Counter Section function by = counterup.min.js ==========================  */
		counter_section(),
		/* massage user list show hide function by = custom.js	 ==========================  */
		msg_user_list_slide(),
		/*  sidebarCollapse function by = custom.js */
		sidebarCollapse(),
		 /* dashboard Notification function by = custom.js */
	    dashboard_noti_dropdown(),	
		 /* dashboard Message function by = custom.js */
		dashboard_message_dropdown(),
		 /* CustomScrollbar function by = jquery.scrollbar.js	 */
		scroll_bar_custome(),
		 /* Jobs Bookmark table function by = dataTables.bootstrap5.js */
		jobs_bookmark_table(),
		 /* candidate_data_table function by = dataTables.bootstrap5.js */
		candidate_data_table(),
		 /* datepicker function by = dbootstrap-datepicker.js */
		datepicker_function(),
		
		 /* view map sidebar function by = custom.js */
	    view_map_sidebar(),
		  /* Radius Range Slider function by = bootstrap-slider.min.js ========================== // */
	     radius_range(),
		/* DropZone File Uploading Function Start========================= */
	    Dropzone_infut_file();
		 /* job fillter button  */
		mobile_btn_fillter();
		twm_side_navigation();
		ordering_value();	
		
		MagnificPopup();
		
	    jQuery('.navicon').on('click',function(){
			$(this).toggleClass('open');
		});
	
	 	
		
		passwordStrength();
	
	}); 	




/*--------------------------------------------------------------------------------------------
	Window Load START
---------------------------------------------------------------------------------------------*/
jQuery(window).on('load', function () {
	// > masonry function function by = isotope.pkgd.min.js		
	masonryBox(),
	/*  page loader function by = custom.js	 */	
	page_loader();

	handleMenuPosition();
	
});

 /*===========================
	Window Scroll ALL FUNCTION START
===========================*/

jQuery(window).on('scroll', function () {
/* > Window on scroll header color fill  */
	color_fill_header();
	
});
	

	/*upload profile pic function*/

    const fileUploader = document.getElementById('file-uploader');
    const reader = new FileReader();
    const imageGrid = document.getElementById('avtar-img');
	if(fileUploader){
		fileUploader.addEventListener('change', (event) => {
			const files = event.target.files;
			const file = files[0];
			const img = document.createElement('img');
			
			if(file){
				$('#avtar-img').html('');
				imageGrid.appendChild(img);
				img.src = URL.createObjectURL(file);
				img.alt = file.name;
			}
		});
		
	}
	
/* Window Resize START */
jQuery(window).on('resize',function () {
	'use strict'; 
	
	screenWidth = $( window ).width();
	
	resize();
	mobile_nav();
	sidebar_nav();
	//handleMenuPosition();
});

jQuery(document).ready(function() {
	
	/*===============================
		Text Type Animation Function	
	=================================*/

    /*  text animation function start  */
	
	var TxtType = function(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function() {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

        var that = this;
        var delta = 200 - Math.random() * 100;

        if (this.isDeleting) { delta /= 2; }

        if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500;
        }

        setTimeout(function() {
        that.tick();
        }, delta);
    };
		
    /* window.onload = function() { */
        var elements = document.getElementsByClassName('typewrite');
        for (var i=0; i<elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
              new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
         /* INJECT CSS */
        var css = document.createElement("style");
        css.type = "text/css";
        /* css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}"; */
        document.body.appendChild(css);
   
	 /* text animation function End // */
	
	 /* sidebar navigation function by = custom.js */
	

});

	
})(window.jQuery);