
var MapScript ;
(function($) {	
	"use strict";

MapScript =  function (){
	
	/*
		References: https://leafletjs.com/reference.html
					https://github.com/digidem/leaflet-bing-layer
					https://learn.microsoft.com/en-us/previous-versions/mt823632(v=msdn.10)?redirectedfrom=MSDN
					https://prnt.sc/h-zoLGjq5J0d
					
		Bing Map:
				//https://learn.microsoft.com/en-us/bingmaps/v8-web-control/map-control-concepts/infoboxes/infobox-when-pushpin-clicked
				//https://learn.microsoft.com/en-us/bingmaps/v8-web-control/map-control-concepts/infoboxes/custom-html-infobox
				//https://learn.microsoft.com/en-us/bingmaps/v8-web-control/map-control-concepts/infoboxes/?source=recommendations
				
			Imagenary Set: https://learn.microsoft.com/en-us/bingmaps/rest-services/imagery/get-imagery-metadata	
	
	*/	
	var screenWidth = jQuery( window ).width();
	var mapMarkerList = [];
	var map_center = [];
	var map_type, bing_mapkey, bing_maptypeid, bing_map_lang, bing_map_style, bing_map_customstyle;
	var bingMapJSOfficial = true;
	var loc_icon	=	''; /* example: https://www.bingmapsportal.com/Content/images/poi_custom.png */
	var loc_icon_color	=	''; 
	if(typeof jobzilla_js_data == 'undefined' || typeof jobzilla_js_data.map_settings == 'undefined'){
		map_type		= 'bingmap';
		map_center		= [42.4275101924038, 12.102446455928826];	
		bing_map_style	= 'default';
		bing_maptypeid  = 'road';
	}else{
		
		
		map_type		= jobzilla_js_data.map_settings.map_type;	
		map_center		= [jobzilla_js_data.map_settings.map_center_lat, jobzilla_js_data.map_settings.map_center_lat];
		bing_mapkey		= jobzilla_js_data.map_settings.bing_mapkey;	
		bing_maptypeid	= jobzilla_js_data.map_settings.bing_maptypeid;	
		bing_map_lang	= jobzilla_js_data.map_settings.bing_map_lang;	
		bing_map_style	= jobzilla_js_data.map_settings.bing_map_style;	
		loc_icon		= jobzilla_js_data.map_settings.loc_icon;
		loc_icon_color	= jobzilla_js_data.map_settings.loc_icon_color;
		bing_map_customstyle	=  '';
		if( typeof jobzilla_js_data.map_settings.bing_map_customstyle != 'undefined' && jobzilla_js_data.map_settings.bing_map_customstyle != ''){
			bing_map_customstyle	= jQuery.parseJSON(jobzilla_js_data.map_settings.bing_map_customstyle);
		}	
	}
	
	var setLoading = function(){
		jQuery('.MicrosoftMap').addClass('dz-ajax-loader');
	}
	var removeLoading = function(){
		jQuery('.MicrosoftMap').removeClass('dz-ajax-loader');
	}
	
	var getJobData = function(currentJob) {
		
	
		var job_link	= currentJob.data('job_link');
		var logo		= currentJob.data('image');
		var job_title	= currentJob.data('title');
		var company_name= currentJob.data('company');
		var job_type	= currentJob.data('job_type');
		var job_type_html = '' ;
		var company_name_html = '';
		if(job_type != ''){
			job_type_html = '<span class="job-type">'+job_type+'</span>'
		}
		if(company_name != ''){
			company_name_html = '<span class="job-title">'+company_name+'</span>'
		}
		var response	= '';
		var img_tag		= '';
		
		if(job_link && logo){
			img_tag = '<div class="logo"><img src="'+logo+'" alt="logo"></div>';
		} 
		
		response = '<a class="job-detail-popup" href="'+job_link+'">'+
						img_tag+
						'<div class="job-content">'+
							'<h4 class="job-company">'+job_title+'</h4>'+company_name_html+job_type_html+
						'</div>'+
					'</a>';

		return response;
    }
	
	var getJobLocationMarkers = function() {
			
			var locationArr = [];
			var itemData = {};
			var latitude = '';
			var longitude = '';
			jQuery('.job_listings .job_listing').each(function(index) {
				
				
				latitude	= jQuery(this).data('latitude');
				longitude	= jQuery(this).data('longitude');
				
				if(latitude != '' && longitude != '') {
					
					itemData = {
								'latitude': latitude,
								'longitude': longitude,
								'template': getJobData(jQuery(this))
							};
					
					locationArr.push(itemData);
					
					
				}
			});
		  
			return locationArr;
	}
	
	var setJobMapListing = function(map)
	{ 
		  
			var mapMarkers = [];
			var isClusterEnabled = true;
			var isAutofitEnabled = true;
          
			mapMarkerList = L.markerClusterGroup({
				spiderfyOnMaxZoom: true,
				showCoverageOnHover: false,
			});
		  
			var locations = [];
		  
			locations = getJobLocationMarkers();
		    if(locations.length == 0){
				return false;
			}
			jQuery.each( locations, function( index, data ) {
				
				
				var listeoIcon = L.divIcon({
					iconAnchor: [0, 0], /* point of the icon which will correspond to marker's location */
					popupAnchor: [0, 0],
					className: 'dz-marker-icon',
					html:  '<div class="marker-container">'+
									 '<div class="marker-card">'+
										'<div class="front face"></div>'+
										'<div class="back face"></div>'+
										'<div class="marker-arrow"></div>'+
									 '</div>'+
								   '</div>'
					
				  }
				);
				
				
				var popupOptions =	{
										'maxWidth': '300',
										'minWidth': '300',
										'className' : 'leaflet-infoBox'
									};	
            
				var marker = new L.marker([data.latitude, data.longitude], {
                  icon: listeoIcon,
                }).bindPopup(data.template,popupOptions );
                
				if(isClusterEnabled){
                  mapMarkerList.addLayer(marker);
                } else {
                  marker.addTo(map);  
                }
				
				mapMarkers.push(L.marker([data.latitude, data.longitude]));
				
			
			});
		  
			/* Set all markers */
			if(isClusterEnabled){
				map.addLayer(mapMarkerList);
			}

			if(isAutofitEnabled && mapMarkers.length > 0 ) {
				var locGroup = L.featureGroup(mapMarkers);
				map.fitBounds(locGroup.getBounds());
				map.setView(locGroup.getBounds().getCenter());
			} 
	}
	
	
	var searchMap = function() {		
		
		var mapOptions = {
            center: map_center,
            zoom: 10,
            zoomControl: false,
            gestureHandling: false,
		}  
	
		var _map = document.getElementById('dz_map');
	
		window.map = L.map('dz_map',mapOptions);
		
		if(map_type == 'openstreetmap'){
	
			L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map)
		}else if(map_type == 'bing'){
			var bing_options = {
				bingMapsKey:bing_mapkey,
				imagerySet:'RoadOnDemand',
			};
			L.tileLayer.bing(bing_options).addTo(map);	
		}else if(map_type == 'googlemap'){
			var roads = L.gridLayer.googleMutant({
			  type: 'roadmap' /* Type: roadmap, satellite, terrain, hybrid */
			}).addTo(map);
		}




		if ( jQuery('#dz_map').attr('data-map-scroll') == 'true') {
            map.scrollWheelZoom.enable();
        }
        
		if( jQuery(window).width() < 992 ){
              map.scrollWheelZoom.disable();
        }

        /* Creating zoom control */
        var zoom = L.control.zoom();
        zoom.addTo(map);
		
		var map_id =  document.getElementById('dz_map');
	
		if (typeof(_map) != 'undefined' && _map != null) {
			setTimeout(function(){
				setJobMapListing(map);	
			}, 2000);
			
		}
		
		jQuery('.tab-content').on('update_results',function(){
			setLoading();
			setTimeout(function(){
				map.removeLayer(mapMarkerList);
				setJobMapListing(map);
				removeLoading();
			}, 3000);
		});
	}
	
	
	/* For Bing Map Location Pop Up */
	var setInfoBox = function(map){
		
		/* previous pushpin remove	 */
		for (var i = map.entities.getLength() - 1; i >= 0; i--) {
			var pushpin = map.entities.get(i);
			if (pushpin instanceof Microsoft.Maps.Pushpin) {
				map.entities.removeAt(i);
			}
		}
		
		
		var center = map.getCenter();
		
		var locationArr = getJobLocationMarkers();
		if(locationArr.length == 0){
			return false;
		}
		var infobox = [];
		var markers = [];
		
		jQuery.each( locationArr, function( index, data ) {
			/* Pass the title and description into the template and pass it into the infobox as an option. */
			infobox[index] = new Microsoft.Maps.Infobox(center, {
				htmlContent: data.template,
				visible: false
			});
			
			//Assign the infobox to a map instance.
			infobox[index].setMap(map);
			
			
			
			/* Create a pushpin at a random location in the map bounds. */
			/* var randomLocation = Microsoft.Maps.TestDataGenerator.getLocations(1, map.getBounds()); */
			
			
			var loc = new Microsoft.Maps.Location(data.latitude, data.longitude);
			
			markers.push(loc);
			/* 
				For pushpin reference: https://www.bing.com/api/maps/sdkrelease/mapcontrol/isdk/createpushpinfromimage
			*/
			//var pin = new Microsoft.Maps.Pushpin(loc);
			var pin = new Microsoft.Maps.Pushpin(loc,{
							icon: loc_icon,
							color : loc_icon_color,
							//icon:'https://i.gifer.com/XDLx.gif',
							anchor: new Microsoft.Maps.Point(0, 0)
						});

			/* Store some metadata with the pushpin.*/
			pin.metadata = {
				//title: data.title,
				//description: data.description,
				//icon:'https://dexignlab.com/images/logo.png'
			}; 
			
			//Add a mouseover event handler to the pushpin.
			Microsoft.Maps.Events.addHandler(pin, 'mouseover', function(e){
				//Set the infobox options with the metadata of the pushpin.
				infobox[index].setOptions({
					location: e.target.getLocation(),
					title: e.target.metadata.title,
					description: e.target.metadata.description,
					icon: e.target.metadata.icon,
					visible: true
				});
			});
			
			//remove a mouseout event handler to the pushpin.
			Microsoft.Maps.Events.addHandler(pin, 'mouseout', function(e){
				
				infobox[index].setOptions({
					visible: false
				});
			});
			
			/* Add pushpin to the map. */
			map.entities.push(pin);
		
		});
		
		var rect = Microsoft.Maps.LocationRect.fromLocations(markers);
		map.setView({ bounds: rect, padding: 80, zoom:10 });	
	}
	
	var bingMapLoad = function()
    {
		
		var map;
		var customMapStyle = '';
		var setUserCurrentLocation = false;
		var mapTypeId;
        var mapStyle1 = {"elements":{"water":{"fillColor":"#a1e0ff"},"waterPoint":{"iconColor":"#a1e0ff"},"transportation":{"strokeColor":"#aa6de0"},"road":{"fillColor":"#b892db"},"railway":{"strokeColor":"#a495b2"},"structure":{"fillColor":"#ffffff"},"runway":{"fillColor":"#ff7fed"},"area":{"fillColor":"#f39ebd"},"political":{"borderStrokeColor":"#fe6850","borderOutlineColor":"#55ffff"},"point":{"iconColor":"#ffffff","fillColor":"#FF6FA0","strokeColor":"#DB4680"},"transit":{"fillColor":"#AA6DE0"}},"version":"1.0"};
		
		var mapStyle2 = {"version":"1.0","settings":{"landColor":"#0B334D"},"elements":{"mapElement":{"labelColor":"#FFFFFF","labelOutlineColor":"#000000"},"political":{"borderStrokeColor":"#144B53","borderOutlineColor":"#00000000"},"point":{"iconColor":"#0C4152","fillColor":"#000000","strokeColor":"#0C4152"},"transportation":{"strokeColor":"#000000","fillColor":"#000000"},"highway":{"strokeColor":"#158399","fillColor":"#000000"},"controlledAccessHighway":{"strokeColor":"#158399","fillColor":"#000000"},"arterialRoad":{"strokeColor":"#157399","fillColor":"#000000"},"majorRoad":{"strokeColor":"#157399","fillColor":"#000000"},"railway":{"strokeColor":"#146474","fillColor":"#000000"},"structure":{"fillColor":"#115166"},"water":{"fillColor":"#021019"},"area":{"fillColor":"#115166"}}};
		
		var mapStyle3 = {"version":"1.0","settings":{"landColor":"#e7e6e5","shadedReliefVisible":false},"elements":{"vegetation":{"fillColor":"#c5dea2"},"naturalPoint":{"visible":false,"labelVisible":false},"transportation":{"labelOutlineColor":"#ffffff","fillColor":"#ffffff","strokeColor":"#d7d6d5"},"water":{"fillColor":"#b1bdd6","labelColor":"#ffffff","labelOutlineColor":"#9aa9ca"},"structure":{"fillColor":"#d7d6d5"},"indigenousPeoplesReserve":{"visible":false},"military":{"visible":false}}};
		
		var mapStyle4 = {"elements":{"water":{"fillColor":"#FF0000","labelColor":"#00FF00"},"road":{"fillColor":"#0000FF"}},"settings":{"landColor":"#FFFFFF"},"version":"1.0"};

		if(bing_map_style == 'style1'){
			customMapStyle =  mapStyle1;
		}else if(bing_map_style == 'style2'){
			customMapStyle = mapStyle2;
		}else if(bing_map_style == 'style3'){
			customMapStyle = mapStyle3;
		}else if(bing_map_style == 'style4'){
			customMapStyle = mapStyle4;
		}else if(bing_map_style == 'custom' && bing_map_customstyle != ''){
			customMapStyle = bing_map_customstyle;
		}
		
		switch(bing_maptypeid){
			case 'road':
				mapTypeId = Microsoft.Maps.MapTypeId.road;break;
			case 'aerial':
				mapTypeId = Microsoft.Maps.MapTypeId.aerial;break;
			case 'canvasDark':
				mapTypeId= Microsoft.Maps.MapTypeId.canvasDark;break;
			case 'canvasLight':
				mapTypeId= Microsoft.Maps.MapTypeId.canvasLight;break;
			default:
				mapTypeId = Microsoft.Maps.MapTypeId.road;
		};
		
		map = new Microsoft.Maps.Map('#dz_map', {
			credentials: bing_mapkey,
			/* center: new Microsoft.Maps.Location(51.50632, -0.12714), */
			customMapStyle: customMapStyle,
			//customMapStyle: jQuery.parseJSON(jobzilla_js_data.map_settings.bing_map_customstyle),
			mapTypeId: mapTypeId,
			zoom: 10
		});
		
		
		/* Request the user's location */
		if(setUserCurrentLocation){
			navigator.geolocation.getCurrentPosition(function (position) {
				var loc = new Microsoft.Maps.Location(
					position.coords.latitude,
					position.coords.longitude);

				//Add a pushpin at the user's location.
				var pin = new Microsoft.Maps.Pushpin(loc);
				map.entities.push(pin);

				//Center the map on the user's location.
				map.setView({ 
				center: map_center, 
				zoom: 15 
				});
			});
		}		
		
		
		
		setTimeout(function(){
			setInfoBox(map);	
		}, 2000)
		
		jQuery('.tab-content').on('update_results',function(){
			setLoading();
			setTimeout(function(){
				setInfoBox(map);
				removeLoading();
			}, 3000);
		});
	} 
	
	var bingMapScriptLoad = function(){
		var bingScript = '<script type="text/javascript" src="https://www.bing.com/api/maps/mapcontrol?callback=GetMap" async defer></script>';
		jQuery('body').append(bingScript);
	}
  
	
	
	return {
		init:function(){
		
			if(map_type == 'openstreetmap' || map_type == 'googlemap' || !bingMapJSOfficial){
				searchMap();
			}else{
				bingMapScriptLoad();	
			}
		},
		getBingMap:function(){
			bingMapLoad();
		},	
		load:function(){
		},		
		resize:function(){
			screenWidth = $(window).width();
		},		
	}
}();

/* Document.ready Start */	
jQuery(document).ready(function() {
    'use strict';
	MapScript.init();	
});
/* Document.ready END */


/* Window Resize START */
jQuery(window).on('load',function () {
	'use strict'; 
	MapScript.load();
});
/*  Window Resize END */

/* Window Resize START */
jQuery(window).on('resize',function () {
	'use strict'; 
	MapScript.resize();
});
/*  Window Resize END */

/* messages send by ajax */
})(jQuery);	