/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
const MAP_ZOOM = 16;
const LAT = 44.4360;
const LGN = 26.046210;
var requests = [];
var id = 0;
var markers = [];
var map;   
var geodesic = null;
google.maps.event.addDomListener(window, 'load', initialize);

function sendRequests(){
    $.post("ajax/manageRequest.php", {"req":requests}, function(response){
        console.log( response );
    }, "json");
}
function addRequest( marker ){
    requests.push({
        "space":marker.get("label"), 
        "loc":{
            lat:marker.getPosition().lat(), 
            lng:marker.getPosition().lng()
        },
        "id" : marker.get("id")
    });
}
function initialize() {
    $("#send_request").click( function(event){
       sendRequests();
    });
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
    var image = "images/state_1.png";
    var iconG = new google.maps.MarkerImage(image, null, null, new google.maps.Point(25, 25));
    var newMarker = new MarkerWithLabel({
       position: location, 
       icon: iconG,
       map: map,
       draggable:false,
       labelAnchor: new google.maps.Point(13,14),
       labelClass : 'label-text'
     });
    newMarker.info = null;
    newMarker.text = "";
    newMarker.set("id", id++);
   
    markers.push( newMarker );
    //var gPath = geodesic.getPath();
    //gPath.push( location );
    google.maps.event.addListener( newMarker, 'click', function(){
        if( infoBubble.get("visible") ){
            infoBubble.close();
            

        }else{
            input.val(newMarker.get("label"));
            infoBubble.open();
            
        }
    });
   
    infoBubble = new InfoBubble({
        maxWidth: 100,
        maxHeight:40,
        pixelOffset:new google.maps.Point(25, 25)
    });

       
    
    infoBubble.open(map, newMarker);
        
    var div = document.createElement('DIV');
    $(div).addClass("input-container");
    var input = $('<input type="text" class="input-subnet"/>');
    input.keyup( function(event){
        if( event.keyCode == 13 ){
            var val = $(this).val();
            regex = /^\/{0,1}[2-3][0-9]$/g;
            regex2 = /^\/+[2-3][0-9]$/g;
            if( regex.test(val) ){
                if( regex2.test( val ) ){
                    val = val.substr(1,val.length);
                    console.log( val );
                }
                if( val > 30 ){
                    alert("Format gresit : se accepta numere intre 20 - 30 optional prefixat cu  /" );
                    $(this).val("");
                    $(this).focus();
                    event.preventDefault();
                    return false;
                }
                newMarker.set("visible", true);
                newMarker.set("label", val);
                newMarker.set("labelContent", "/"+val);
                addRequest( newMarker );
                infoBubble.close();
                
            }
            else{
                alert("Format gresit : se accepta numere intre 20 - 30 optional prefixat cu  /" );
                $(this).val("");
                $(this).focus();
            }
            event.preventDefault();
            return false;
            
           
        } 
       
    });
    $(div).append(input);
    infoBubble.addTab("", div );

    google.maps.event.addListener( newMarker, 'click', function() {
	
    });
	
    input.focus();
}



