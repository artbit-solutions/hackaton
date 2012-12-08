/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
const MAP_ZOOM = 16;
const LAT = 44.4360;
const LGN = 26.046210;
var requests = [];
var map;   
var geodesic = null;
google.maps.event.addDomListener(window, 'load', initialize);

function sendRequests( requests ){
    $.post("ajax/manageRequest.php", requests, function(response){
        console.log( response );
    }, "json");
}
function initialize() {
    var mapOptions = {
        zoom: MAP_ZOOM,
        center: new google.maps.LatLng(LAT, LGN),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
    var geodesicOptions = {
        strokeColor: '#CC0099',
        strokeOpacity: 1.0,
        strokeWeight: 3,
        geodesic: true
    }
    geodesic = new google.maps.Polyline(geodesicOptions);
    geodesic.setMap(map);
    google.maps.event.addListener(map, 'click', function(event) {
        placeNewMarkerOnMap( event.latLng, map );
    });
}

function placeNewMarkerOnMap( location, map ) {
	
    var newMarker = new google.maps.Marker({
        position: location, 
        icon: {
            path: google.maps.SymbolPath.CIRCLE,
            scale: 10
        },
        map: map,
        draggable:true
    });
					
    newMarker.info = null;
    newMarker.text = "";
    //var gPath = geodesic.getPath();
    //gPath.push( location );
    google.maps.event.addListener( newMarker, 'position_changed', function(){
        markerPositionChanged( newMarker );
    });
    var contentString = '<div id="content">'+
    '<h1>Uluru</h1>'+
    '<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large ' +
    'sandstone rock formation in the southern part of the '+
    'Northern Territory, central Australia. It lies 335&#160;km (208&#160;mi) '+
    'south west of the nearest large town, Alice Springs; 450&#160;km '+
    '(280&#160;mi) by road. Kata Tjuta and Uluru are the two major '+
    'features of the Uluru - Kata Tjuta National Park. Uluru is '+
    'sacred to the Pitjantjatjara and Yankunytjatjara, the '+
    'Aboriginal people of the area. It has many springs, waterholes, '+
    'rock caves and ancient paintings. Uluru is listed as a World '+
    'Heritage Site.</p>'+
    '<p>Attribution: Uluru, <a href="http://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">'+
    'http://en.wikipedia.org/w/index.php?title=Uluru</a> '+
    '(last visited June 22, 2009).</p>'+
    '</div>';

    infoBubble = new InfoBubble({
        maxWidth: 100,
        maxHeight:40
    });

       
     var label = new Label({
       map: map
     });
     label.bindTo('position', newMarker, 'position');
     label.bindTo('text', newMarker, 'position');
    infoBubble.open(map, newMarker);
        

    var div = document.createElement('DIV');
    $(div).addClass("input-container");
    var input = $('<input type="text" class="input-subnet"/>');
    $(div).append(input);
    infoBubble.addTab("", div );

    google.maps.event.addListener( newMarker, 'click', function() {
	
    });
	

}

