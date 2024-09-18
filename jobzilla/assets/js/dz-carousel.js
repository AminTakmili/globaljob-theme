/* Banner Carousel 1 */
function handleTwmH1BnrCarousal(){	
	if(jQuery('.twm-h1-bnr-carousal').length > 0){
		jQuery('.twm-h1-bnr-carousal').owlCarousel({
			animateIn: 'fadeIn',
			animateOut: 'fadeOut',
			items: 1,
			loop: true,
			nav:false,
			dots: false,
			autoplay:true,
			autoplayHoverPause:false,
			touchDrag  : false,
			mouseDrag  : false,
		});
	}
}

/* Job Categories Carousel */
function handleJobCategoriesCarousel(){	
	if(jQuery('.job-categories-carousel').length > 0){
		jQuery('.job-categories-carousel').owlCarousel({
			loop:true,
			nav:true,
			dots: false,
			center:false,				
			margin:30,
			autoplay:true,
			navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
			responsive:{
				0:{
					items:1,
				},
				400:{
					items:1.5,
					
				},			
				767:{
					items:1.5,
					autoWidth:true,
					center: true,
				},
				991:{
					items:1.5,
				},
				1024:{
					items:3
				}
			}
		});
	}
}


/* Home Client Carousel 2 */
function handleHomeClientCarousel2(){	
	if(jQuery('.home-client-carousel2').length > 0){
		jQuery('.home-client-carousel2').owlCarousel({
			loop:true,
			nav:true,
			dots: false,				
			margin:30,
			autoplay:true,
			navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
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
					items:6
				}
			}
		});
	}
}

/* Home Client Carousel 3 */
function handleHomeClientCarousel3(){	
	if(jQuery('.home-client-carousel3').length > 0){
		jQuery('.home-client-carousel3').owlCarousel({
			loop:true,
			nav:false,
			dots: false,				
			margin:30,
			autoplay:true,
			autoplayTimeout: 1500,
			navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
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
					items:5
				}
			}
		});
	}
}

/* Home Client Carousel 4 */
function handleHomeClientCarousel4(){	
	if(jQuery('.home-client-carousel4').length > 0){
		jQuery('.home-client-carousel4').owlCarousel({
			loop:true,
			nav:false,
			dots: false,				
			margin:0,
			autoplay:true,
			autoplayTimeout: 1500,
			navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
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
					items:5
				}
			}
		});
	}
}

/* Testimonial Carousel 1 */
function handleTwmTestimonial1Carousel(){	
	if(jQuery('.twm-testimonial-1-carousel').length > 0){
		jQuery('.twm-testimonial-1-carousel').owlCarousel({
			loop:true,
			nav:true,
			dots: false,				
			margin:30,
			autoplay:true,
			navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
			responsive:{
				0:{
					items:1,
				},
				480:{
					items:1,
				},			
				991:{
					items:2,
				}

			}
		});
	}
}

/* testimonial Carousel 2 */
function handleTwmTestimonial2Carousel(){	
	if(jQuery('.twm-testimonial-2-carousel').length > 0){
		jQuery('.twm-testimonial-2-carousel').owlCarousel({
			loop:true,
			nav:true,
			dots: false,				
			margin:5,
			autoplay:true,
			navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
			responsive:{
				0:{
					items:1,
				},
				480:{
					items:1,
				},			
				991:{
					items:2,
				},
				1199:{
					items:3,
				}

			}
		});
	}
}


//  Latest Article Blogs Carousel function by = owl.carousel.js ========================== //
	function twm_la_home_blog(){
		if(jQuery('.twm-la-home-blog').length > 0){
			jQuery('.twm-la-home-blog').owlCarousel({
				loop:true,
				nav:true,
				dots: false,				
				margin:30,
				autoplay:false,
				navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
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
					1199:{
						items:3,
					}

				}
			});
		}
		
		if(jQuery('.twm-la-home-blog2').length > 0){
			jQuery('.twm-la-home-blog2').owlCarousel({
				loop:true,
				nav:true,
				dots: false,				
				margin:30,
				autoplay:false,
				navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
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
					1199:{
						items:3,
					}

				}
			});
		}
	}
	/* Not Use */
	function handlePostSlider() {
		// Blog Swiper
		if(jQuery('.post-swiper-two').length > 0){
			var swiper = new Swiper('.post-swiper-two', {
				loop: true,
				spaceBetween: 10,
				slidesPerView: 4,
				freeMode: true,
				watchSlidesVisibility: true,
				watchSlidesProgress: true,
			});
			var swiper2 = new Swiper('.post-swiper-2', {
				loop: true,
				spaceBetween: 10,
				navigation: {
				  nextEl: ".swiper-button-next",
				  prevEl: ".swiper-button-prev",
				},
				thumbs: {
				  swiper: swiper,
				},
			});
		}
		// Blog Swiper
		if(jQuery('.post-swiper').length > 0){
			var swiper2 = new Swiper('.post-swiper', {
				slidesPerView: 1,
				spaceBetween: 0,
				speed: 1500,
				loop:true,
				autoplay: {
				   delay: 3000,
				},
				navigation: {
					nextEl: '.prev-post-swiper-btn',
					prevEl: '.next-post-swiper-btn',
				},
			});
		}
	}
	//  Client logo Carousel 
	function handleHomeClientCarousel6(){
		jQuery('.home-client-carousel6').owlCarousel({
			loop:true,
			nav:false,
			dots: false,
			center:false,				
			margin:30,
			autoplay:true,
			autoplayTimeout: 1500,
			navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
			responsive:{
				0:{
					items:1,
				},
				480:{
					items:2,
				},			
				767:{
					items:2,
				},
				991:{
					items:3,
				},
				1366:{
					items:3
				}
			}
		});
	}
	
	function handleCategory5Slider(){
		const swiper = new Swiper('.category-5-slider', {
			slidesPerView: 6,
			spaceBetween: 30,
			grid: { 
				rows: 2,  
				fill: "row",
			}, 
			pagination: {                       
				el: '.swiper-pagination',
			},
			navigation: {                       
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},


			breakpoints: {
				0: {
					slidesPerView: 1,
					grid: { 
						rows: 2,  
						fill: "row",
					}, 
				},
				360: {
					slidesPerView: 1,
					grid: { 
						rows: 2,  
						fill: "row",
					}, 
				},
				640: {
					slidesPerView: 2,
					grid: { 
						rows: 2,  
						fill: "row",
					}, 
				},
				991: {
					slidesPerView: 3,
					grid: { 
						rows: 2,  
						fill: "row",
					}, 
				},
				1366: {
					slidesPerView: 4,
					grid: { 
						rows: 2,  
						fill: "row",
					}, 
				},
				1440: {
					slidesPerView: 5,
					grid: { 
						rows: 2,  
						fill: "row",
					}, 
				},
				1720: {
				  slidesPerView: 5,
				  grid: { 
					rows: 2,  
					fill: "row",
					}, 
				},
				1721: {
				  slidesPerView: 6,
				  grid: { 
					rows: 2,  
					fill: "row",
					}, 
				}
			},
		})
	}
	// Vertical slider function by = swiper-bundle.min.js
	function handleTwmTestimonial3Carousel(){
		const swiper = new Swiper('.v-testimonial-slider', {
			slidesPerView: 2,
			spaceBetween: 20,
			//loop: true,
			
			autoplay: {
				delay: 2500,
				disableOnInteraction: false,
			  },
			direction: "vertical",
			pagination: {
				el: ".swiper-pagination",
				clickable: true,
			},
			breakpoints: {
				0: {
					direction: "horizontal",
					slidesPerView: 1,
				},
				 767: {
					direction: "vertical",
				} 

			},

		})
	}
	// Testimonial Thumb slider function by = swiper-bundle.min.js
	function handleThumbTestimonialSlider(){
		var swiper = new Swiper(".testimonial-thumbpic-1", {
			loop: true,
			spaceBetween: 10,
			slidesPerView: 3,
			freeMode: true,
			watchSlidesProgress: true,
			autoplay: {
				delay: 5000,
				disableOnInteraction: false,
			  },
		  });
		  var swiper2 = new Swiper(".testimonial-thumb-1", {
			loop: true,
			spaceBetween: 10,
			navigation: {
			  nextEl: ".swiper-button-next",
			  prevEl: ".swiper-button-prev",
			},
			thumbs: {
			  swiper: swiper,
			},
			autoplay: {
				delay: 5000,
				disableOnInteraction: false,
			  },
		  });
	}
	//________ h-page7-jobs-slider carousel  function by = owl.carousel.js________//
	function handlePage7JobsSlider(){
		var swiper = new Swiper(".h-page7-jobs-slider", 
			{
				slidesPerView: 8,
				spaceBetween: 30,
				loop: true,
				centeredSlides: false,
				freeMode: true,
				grabCursor: true,
				//slidesPerView: "auto",
				pagination: {
					el: ".swiper-pagination",
					clickable: true,
				},
				autoplay: {
					delay: 2500,
					disableOnInteraction: false,
				},
				breakpoints: {
					0: {
					slidesPerView: 1,
					centeredSlides: false,
					},
					420: {
					slidesPerView: 2,
					centeredSlides: false,
					},
					640: {
					slidesPerView: 3,
					centeredSlides: true,
					},
					768: {
					slidesPerView: 3,
					centeredSlides: true,
					},
					1024: {
					slidesPerView: 4,
					centeredSlides: true,
					},
					1366: {
					slidesPerView: 6,
					centeredSlides: true,
					},
					1440: {
					slidesPerView:6,
					centeredSlides: true,
					},

					1800: {
					slidesPerView: 8,
					centeredSlides: false,
					},
				},
			}
		);
	}

	function handleJobTypeFilter(){
		var owl = jQuery('.owl-carousel-filter').owlCarousel({
		loop:false,
		autoplay:false,
		margin:30,
		nav:true,
		dots: false,
		navText: ['<i class="feather-chevron-left"></i>', '<i class="feather-chevron-right"></i>'],
		responsive:{
			0:{
				items:1,
			},
			540:{
				items:2,
			},
			768:{
				items:2,
			},			
			1024:{
				items:3
			},
			1136:{
				items:3
			},					
			1366:{
				items:3
			}	
			}
		})

	
		/* Filter Nav */
		 var owlAnimateFilter = function(even) { }

		jQuery('.btn-filter-wrap').on('click', '.btn-filter', function(e) {
			var filter_data = jQuery(this).data('filter');

			/* return if current */
			if(jQuery(this).hasClass('btn-active')) return;

			/* active current */
			jQuery(this).addClass('btn-active').siblings().removeClass('btn-active');
			if(filter_data != ''){
			/* Filter */
				owl.owlFilter(filter_data, function(_owl) { 
					jQuery(_owl).find('.item').each(owlAnimateFilter); 
				});
			}
		});
	
	
	
	}	



	//  Job Categories Carousel function by = owl.carousel.js ========================== //
	function handleJobCategoriesCarouselHpage8(){
		jQuery('.h-page8-jobs-slider').owlCarousel({
			loop:true,
			nav:false,
			dots: true,
			center:false,				
			margin:30,
			autoplay:true,
			navText: ['<i class="feather-chevron-left"></i>', '<i class="feather-chevron-right"></i>'],
			responsive:{
				0:{
					items:1.5,
					margin:10,
				},
				480:{
					items:2,
				},			
				575:{
					items:2,
				},
				991:{
					items:3,
					
				},
				1024:{
					items:4,
				},
				1200:{
					items:5
				}
			}
		});
	}
	
	//  Job categories Carousel function by = owl.carousel.js ========================== //
	function handleTwmJobCategoriesCarousal(){
		jQuery('.twm-job-categories-carousal').owlCarousel({
			loop:true,
			nav:false,
			dots: true,
			center:false,				
			margin:30,
			autoplay:true,
			navText: ['<i class="feather-chevron-left"></i>', '<i class="feather-chevron-right"></i>'],
			responsive:{
				0:{
					items:1,
				},
				480:{
					items:2,
				},			
				575:{
					items:2,
				},
				991:{
					items:3,
					
				},
				1024:{
					items:4,
				},
				1200:{
					items:6
				}
			}
		});
	}

	//  Testimonial Carousel function by = owl.carousel.js ========================== //
	function handleTwmTestimonial8Carousel(){
		jQuery('.twm-testimonial-8-carousel').owlCarousel({
			loop:true,
			nav:true,
			dots: false,				
			margin:30,
			autoplay:true,
			navText: ['<i class="feather-chevron-left"></i>', '<i class="feather-chevron-right"></i>'],
			responsive:{
				0:{
					items:1,
				},
				480:{
					items:1,
				},			
				991:{
					items:2,
				}

			}
		});
	}
	//  Job city Carousel function by = owl.carousel.js ========================== //
	function handleTwmFeaturedCityCarousal(){
		jQuery('.twm-featured-city-carousal').owlCarousel({
			loop:true,
			nav:false,
			dots: true,
			center:false,				
			margin:30,
			autoplay:true,
			navText: ['<i class="feather-chevron-left"></i>', '<i class="feather-chevron-right"></i>'],
			responsive:{
				0:{
					items:1,
				},
				480:{
					items:1,
				},			
				575:{
					items:2,
				},
				991:{
					items:3,
				},
				1024:{
					items:3,
				},
				1366:{
					items:5
				},
				1600:{
					items:6
				}
			}
		});
	}
	
	function handleVJobSwiper(){
		var swiper = new Swiper(".v-jobSwiper", {
			direction: 'vertical',
			slidesPerView: 6,
			loop: true,
			speed: 4000,
			pauseOnMouseEnter:true,
			freeMode: true,
			autoplay:{
				delay: 0,
				disableOnInteraction: false,
				pauseOnMouseEnter: true,
			},
			breakpoints: {
				0: {
					direction: "horizontal",
					slidesPerView: 1,
					spaceBetween: 20,
					pauseOnMouseEnter:false,
					freeMode: false,
				},
				480: {
					direction: "horizontal",
					slidesPerView: 2,
					spaceBetween: 20,
					pauseOnMouseEnter:false,
					freeMode: false,
				},
				767: {
					direction: "vertical",
					slidesPerView: 6,
				}

			},
		});   
	}
		
	//  Job Categories Carousel function by = owl.carousel.js ========================== //
	function handlePage15BnrCarousal(){
		jQuery('.h-page-15-bnr-carousal').owlCarousel({
			loop:true,
			nav:false,
			dots: false,
			center:false,				
			margin:0,
			autoplay:true,
			animateOut: 'fadeOut',
			navText: ['<i class="feather-chevron-left"></i>', '<i class="feather-chevron-right"></i>'],
			responsive:{
				0:{
					items:1,
				}
			}
		});
	}
	function v_notiinfoSwiper(){
		var swiper = new Swiper(".v-notiinfoSwiper", {
			direction: 'vertical',
			slidesPerView: 1,
			loop: true,
			speed: 4000,
			//pauseOnMouseEnter:true,
			freeMode: true,
			autoplay:{
				delay: 0,
				disableOnInteraction: false,
				//pauseOnMouseEnter: true,
			},
			breakpoints: {
				0: {
					direction: "horizontal",
					slidesPerView: 1,
					spaceBetween: 20,
					pauseOnMouseEnter:false,
					freeMode: false,
				},
				360: {
					slidesPerView: 1,
					spaceBetween: 20,
					pauseOnMouseEnter:false,
					freeMode: false,
				}
			},
		});   
	}
/* Window Load START */
jQuery(document).ready(function(){
	handleTwmH1BnrCarousal();
	handleJobCategoriesCarousel();
	handleHomeClientCarousel2();
	handleHomeClientCarousel3();
	handleHomeClientCarousel4();
	handleTwmTestimonial1Carousel();
	handleTwmTestimonial2Carousel();
	handleTwmTestimonial3Carousel();
	twm_la_home_blog();
	handlePostSlider();
	handleHomeClientCarousel6();
	handleCategory5Slider(); // 
	handlePage7JobsSlider();
	handleJobTypeFilter();
	handleThumbTestimonialSlider();// home page 8
	handleJobCategoriesCarouselHpage8();
	handleTwmJobCategoriesCarousal();
	handleTwmTestimonial8Carousel();
	handleTwmFeaturedCityCarousal();
	handleVJobSwiper();
	handlePage15BnrCarousal();
	v_notiinfoSwiper();
});
