(function($) {	
	"use strict";

var DZWPJMScript =  function (){
	
	var siteUrl = '';	
	var screenWidth = jQuery( window ).width();	
	
	/* Send Message From Frontend user to employer */
	var handleMessageModel = function (){		
		jQuery('#DZMessageForm').on('submit',function (e) {
			e.preventDefault();
			var message ='<div class="alert alert-warning  alert-dismissible fade show" role="alert">Sending...</div>';
			jQuery('.message_open').html(message);
			var formData = jQuery(this).serializeArray();
			formData.push({ name: 'action', value: 'jobzilla_candidate_send_message' });
			jQuery.ajax({
				type:'post',
				url :jobzilla_js_data.admin_ajax_url,
				data: formData,
				dataType:'JSON',
				success: function(response) {
					if(response.status == true){
						var success = response.msg;
						var message =
							'<div class="alert alert-success alert-dismissible fade show" role="alert"> '+ success + '</div>';
							jQuery('#Messageid').val('');
							setTimeout(function() { 
								$('#message').modal('hide');
							}, 1000);					
					}else{
						var error = response.msg;
						var message =
						'<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Error!</strong> '+ error +' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
					}
					jQuery('.message_open').html(message);
				}
			}); 
			
		});
	}
	
	/* Companies, Jobs, Resumes */
	var handlePostViewGraphUpdate = function (){
		
		/* 1. get select box value 
		   2. pass to ajax
			
		*/
		
		
		/* get data series attribute from canvas */
		var graphDataSeries = $('#profileViewChart').data('values');
		var graphDataLabels = $('#profileViewChart').data('labels');
		
		
		handlePostViewGraph(graphDataSeries, graphDataLabels);
		jQuery('#ProfileViewPost, #ProfileViewYear').on("change", function(){
			jQuery(".twm-pro-view-chart").addClass("dz-ajax-loader");
			var post_id = $('#ProfileViewPost').val();
			var year = $('#ProfileViewYear').val();
			 $.ajax({
				type: 'post',
				url: jobzilla_js_data.admin_ajax_url,
				data: {
						year : year,
						post_id: post_id,
						action : 'jobzilla_ajax_get_views_by_date'
					},
				dataType: 'JSON',
				success:function(response){
					jQuery(".twm-pro-view-chart").removeClass("dz-ajax-loader");
					var dataSeries = response.dataSeries;
					var dataSerieslabel = response.dataSerieslabel;
					var canvas = '<canvas id="profileViewChart" data-labels="'+ dataSerieslabel +'" data-values="'+ dataSeries +'"></canvas>';
					jQuery('.profile-View-Chart').html(canvas);
					handlePostViewGraph(dataSeries, dataSerieslabel);
					
				}
			});	 
		});
	}	
	
	var handlePostViewGraph = function(dataSeries, dataSerieslabel){
		if(jQuery('#profileViewChart').length){
			var profileViewChart = document.getElementById('profileViewChart').getContext('2d');
			var profileViewChart = new Chart(profileViewChart, {
				type: 'line',
				data: {
					labels: dataSerieslabel,
					datasets: [{
						label: 'Viewers',
						data: dataSeries,
						pointHoverBorderColor: '#1967d2',
						pointBorderWidth: 10,
						pointHoverBorderWidth: 3,
						pointHitRadius: 20,
						borderWidth: 3,
						borderColor: '#1967d2',
						pointBackgroundColor: 'rgba(255, 255, 255, 0)',
						pointHoverBackgroundColor: 'rgba(255, 255, 255, 1)',
						pointBorderColor: 'rgba(66, 133, 244, 0)',
						cubicInterpolationMode: 'monotone',
						fill: true,
						backgroundColor: 'rgba(212, 230, 255, 0.2)',
					}]
				},
			});
		}
	}
	/* Send Message From Frontend user to employer */
	var handleUserLogin = function (){		
		jQuery('.userloginform').on('submit',function(e) {
			e.preventDefault();
			var redirect_request = jQuery(this).data('redirect');
			jQuery(".page-loader").addClass("dz-ajax-loader");
			var formData = jQuery(this).serializeArray();
			formData.push({ name: 'action', value: 'jobzilla_user_login' });
			jQuery('#loginid').html('<div></div>');
			jQuery.ajax({
				type:'post',
				url:jobzilla_js_data.admin_ajax_url,
				data: formData,
				dataType:'json',
				success: function(response, status, xhr) {
					jQuery(".page-loader").removeClass("dz-ajax-loader");
					 if(response.status == true){
						var success = response.msg;
						var redirect_url = response.redirect_url;
						var message = '<div class="alert alert-success alert-dismissible fade show" role="alert"> '+ success + '</div>';
							setTimeout(function() { 
								if(redirect_url && redirect_request == '1'){
									document.location.href = redirect_url;
								}else{
									location.reload();
								}
							}, 1000);					
					}else{
						var error = response.msg;
						var message =
						'<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Error!</strong> '+ error +' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
					} 
					jQuery('.loginid').html(message);
				},
				error:function(xhr, exception){
					jQuery(".page-loader").removeClass("dz-ajax-loader");
					var msg = '';
					if (xhr.status === 0) {
						msg = 'Not connect.\n Verify Network.';
					} else if (xhr.status == 404) {
						msg = 'Requested page not found. [404]';
					} else if (xhr.status == 500) {
						msg = 'Internal Server Error [500].';
					} else if (exception === 'parsererror') {
						msg = 'Requested JSON parse failed. It may you are using weak password. Please contact to website support.';
					} else if (exception === 'timeout') {
						msg = 'Time out error.';
					} else if (exception === 'abort') {
						msg = 'Ajax request aborted.';
					} else if (xhr.responseText === '-1') {
						msg = 'Please refresh page and try again.';
					} else {
						msg = 'Uncaught Error.\n' + xhr.responseText;
					}
					
					var message =
						'<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Error!</strong> '+ msg +' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
					jQuery('.loginid').html(message);
				}
			}); 

		});
	}
	
	var handleUserRegister = function(){	
		jQuery('#agree2').on('click',function() {
			if(jQuery(this).is(":checked")){
				jQuery(".btn_disabled").removeClass("disabled");
				jQuery("#agree2").val("on");
			}else{
				jQuery(".btn_disabled").addClass("disabled");
				jQuery("#agree2").val("off");
				
			}	
		});
		jQuery('#UserRegisterForm').on('submit',function(e) {
			e.preventDefault();
			var this_val = jQuery('#agree2').val();
			if(this_val == 'on'){
			jQuery(".page-loader").addClass("dz-ajax-loader");
			var formData = jQuery(this).serializeArray();
			formData.push({ name: 'action', value: 'jobzilla_user_registration' });
			jQuery('#registerid').html('<div></div>');
			jQuery.ajax({
				type:'post',
				url :jobzilla_js_data.admin_ajax_url,
				data: formData,
				dataType:'JSON',
	
				success: function(response) {
					jQuery(".page-loader").removeClass("dz-ajax-loader");
					 if(response.status == true){
						var success = response.msg;
						var redirect_url = response.redirect_url;
						var message =
							'<div class="alert alert-success alert-dismissible fade show" role="alert"> '+ success + '</div>';
							jQuery('#registerid').append(message);
							setTimeout(function(){ 
								window.location.href = redirect_url;
							}, 1000);					
					}else{
						var error = response.msg;
						jQuery.each( error, function(key, value ) {
						var message =
						'<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Error!</strong> '+ value +' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						jQuery('#registerid').append(message);
						});
					} 
				}
			}); 
			}else{
				jQuery('#registerid').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">Terms and conditions </div>');
				
			}
		});
	}
	var handleForgotPassword = function(){		
		jQuery('#ResetPassword').on('submit',function(e) {
			e.preventDefault();
			jQuery(".page-loader").addClass("dz-ajax-loader");
			var formData = jQuery(this).serializeArray();
			formData.push({ name: 'action', value: 'jobzilla_forgot_password' });
			jQuery('#fesetmsg').html('<div></div>');
			jQuery.ajax({
				type:'post',
				url :jobzilla_js_data.admin_ajax_url,
				data: formData,
				dataType:'json',
				success: function(response) {
	
					jQuery(".page-loader").removeClass("dz-ajax-loader");
					 if(response.status == true){
						var success = response.msg;
						var message =
							'<div class="alert alert-success alert-dismissible fade show" role="alert"> '+ success + '</div>';
							setTimeout(function(){ 
								location.reload();
							}, 1000);					
					}else{
						var error = response.msg;
						
						var message =
						'<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Error!</strong> '+ error +' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
					} 
					jQuery('#fesetmsg').append(message);
				}
			}); 

		});
	} 
	
	var handleUserProfile = function(){		
		jQuery('#edit_user').on('submit',function(e) {
			e.preventDefault();
			jQuery('.site-button').prop('disabled', true);
			jQuery('#profile_btn').html('<i class="spinner-border text-white spinner-border-sm" role="status"></i>Loading...');
			var formdata = new FormData(this);
			jQuery('#profile_msg').html('<div></div>');
			jQuery.ajax({
				type:'post',
				url :jobzilla_js_data.admin_ajax_url,
				data: formdata,
				contentType:false,
				processData: false,
				dataType:'JSON',
				success: function(response) {
					 if(response.status == true){
						var success = response.msg;
						var message =
							'<div class="alert alert-success alert-dismissible fade show" role="alert"> '+ success + '</div>';
							setTimeout(function(){ 
								location.reload();
							}, 2000);					
					}else{
						var error = response.msg;
						
						var message =
						'<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Error!</strong> '+ error +' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
					} 
					jQuery('#profile_msg').append(message);
				}
			}); 

		});
	} 
	var handleRecentActivitie = function(){	
		jQuery('.close-list-item').on("click", function(e){
			e.preventDefault();
			var id = $(this).data('id');
			jQuery(".delete-" + id + "").addClass("collapse");
			jQuery.ajax({
				type:'post',
				url :jobzilla_js_data.admin_ajax_url,
				data:{
					action : 'jobzilla_user_activity',
					id : id,
				},
				dataType:'JSON',
				success: function(response) {
					 if(response.status == true){
						var success = response.msg;
						var message =
							'<div class="alert alert-success alert-dismissible fade show" role="alert"> '+ success + '</div>';					
					}else{
						var error = response.msg;
						var message =
						'<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Error!</strong> '+ error +' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
					} 
					jQuery('#profile_msg').append(message);
				}
			});   
		}); 	
	} 

	var handleChangePassword = function(){		
		jQuery('#ChangePassword').on('submit',function(e) {
			e.preventDefault();
			
			jQuery('#Massagechange').html('');
			
			var formData = jQuery(this).serializeArray();
			formData.push({ name: 'action', value: 'jobzilla_change_password' });
			
			jQuery.ajax({
				type:'post',
				url :jobzilla_js_data.admin_ajax_url,
				data: formData,
				dataType:'JSON',
				success: function(response){
					 if(response.status == true){
						var success = response.msg;
						var message =
							'<div class="alert alert-success alert-dismissible fade show" role="alert"> '+ success + '</div>';
							jQuery('#Massagechange').html(message);
							setTimeout(function(){ 
								location.reload();
							}, 500);					
					}else{
						var error = response.msg;
						jQuery.each( error, function(key, value ){
						var message =
						'<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Error!</strong> '+ value +' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						jQuery('#Massagechange').append(message);
						});
					} 
				}
			});  
			
		});
	}
	var handleFilterAjax = function(){
		jQuery('#FilterForm').on('submit', function(e){
			e.preventDefault();
			var formData = jQuery(this).serializeArray();
			formData.push({ name: 'action', value: 'jobzilla_job_listing_filter' });
			jQuery.ajax({
				type:'post',
				url : jobzilla_js_data.admin_ajax_url,
				data: formData,
				dataType:'html',
				success: function(data){
					
					jQuery('#AJAXDATA').html(data);
				}
			});
		});
	}
	
	return {
		init:function(){
		},				
		load:function(){
			handleMessageModel();
			handlePostViewGraphUpdate();
			handleForgotPassword();
			handleUserRegister();
			handleUserLogin();
			handleUserProfile();
			handleRecentActivitie();
			handleChangePassword();
		},		
		resize:function(){
		},		
	}
}();

/* Document.ready Start */	
jQuery(document).ready(function() {
    'use strict';
	DZWPJMScript.init();	
});
/* Document.ready END */

/* Window Resize START */
jQuery(window).on('load',function () {
	'use strict'; 
	DZWPJMScript.load();
});
/*  Window Resize END */

/* Window Resize START */
jQuery(window).on('resize',function () {
	'use strict'; 
	DZWPJMScript.resize();
});
/*  Window Resize END */

jQuery(document).ready(function () {
    jQuery( "#bookmark" ).on('click', function() {
		setTimeout(function() { 
			form.submit();
		}, 100);
		
    });
	jQuery('#Employer').on('click', function(){
		 jQuery('#Username').val('employer');
		 jQuery('#Password').val('123456');
	});
	 jQuery('#Candidate').on('click', function(){
		 jQuery('#Username').val('candidate');
		 jQuery('#Password').val('123456');
	});
}); 


})(jQuery);	