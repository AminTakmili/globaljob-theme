(function($) {
	
	'use strict';
	
	jQuery(document).ready(function() {
		
		// Wrap every letter in a span
		$('.ml2').each(function(){
		  $(this).html($(this).text().replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>"));
		});

		anime.timeline({loop: true})
		  .add({
			targets: '.ml2 .letter',
			scale: [4,1],
			opacity: [0,1],
			translateZ: 0,
			easing: "easeOutExpo",
			duration: 950,
			delay: function(el, i) {
			  return 70*i;
			}
		  }).add({
			targets: '.ml2',
			opacity: 0,
			duration: 1000,
			easing: "easeOutExpo",
			delay: 1000
		  });
		  
		// Wrap every letter in a span
		$('.ml12').each(function(){
		  $(this).html($(this).text().replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>"));
		});

		anime.timeline({loop: true})
		  .add({
			targets: '.ml12 .letter',
			translateX: [40,0],
			translateZ: 0,
			opacity: [0,1],
			easing: "easeOutExpo",
			duration: 1200,
			delay: function(el, i) {
			  return 500 + 30 * i;
			}
		  }).add({
			targets: '.ml12 .letter',
			translateX: [0,-30],
			opacity: [1,0],
			easing: "easeInExpo",
			duration: 1100,
			delay: function(el, i) {
			  return 100 + 30 * i;
			}
		  });
	});
})(jQuery);	