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
var acceptedMarkers = [];
var selectedMarkers = [];
var map;   
var geodesic = null;
google.maps.event.addDomListener(window, 'load', initialize);
var classes = [];
function clearAllMarkers(){
    console.log( acceptedMarkers );
    for( var i = 0; i < acceptedMarkers.length; ++i ){
        acceptedMarkers[i].set("visible",false);
    }
    acceptedMarkers = [];
}
function sendRequests(){
    var reqs = [];
    for ( var i = 0; i < markers.length; ++i ){
        reqs.push( getJson( markers[i] ) );
    }
    $.post("ajax/manageRequest.php", {"req":reqs}, function(response){
        for( var i = 0; i < response.length; ++i ){
            acceptMarker( response[i] );
        }
        getAvailabilityInfo();
    }, "json");
   
}
function addAvailabilityInfo( infoAv ){
    var container = $("#availability-cont");
    var info = $('<div class="av-info"></div>');
    var infoLabel = $('<span class="av-label"></span>');
    infoLabel.text( "/"+infoAv.space );
    var img = $('<img src="images/state_4_1.png" />');
    if( infoAv.no > 0 ){
        img = $('<img src="images/state_1_1.png" />');
    }
    var divTxt = $("<div></div>");
    divTxt.text( infoAv.no );
    info.append(img);
    info.append( infoLabel );
    info.append(divTxt);
    container.append(info);
}
function getAvailabilityInfo(){
    $.get("ajax/availableClasses.php", function(response){
        $("#availability-cont").empty();
        for( var i = 0; i < response.length; ++i ){
            classes[i] = response[i].no;
            addAvailabilityInfo(response[i]);
        }
        $("#availability-cont").append('<br class="clearfloat"/>');
    }, 'json');
    
}
function getJson(marker){
    return {
        "space":marker.get("label"), 
        "loc":{
            lat:marker.getPosition().lat(), 
            lng:marker.getPosition().lng()
        },
        "id" : marker.get("id")
    };
}

function sendDeleteRequests(){
    var deleteReq = [];
    for ( var i = 0; i < selectedMarkers.length; ++i ){
        deleteReq.push( getJson( selectedMarkers[i] ) );
    }
    $.post("ajax/manageRemove.php", {"req":deleteReq}, function(response){
        for( var i = 0; i < response.length; ++i ){
            deleteMarker( response[i] );
        }
        getAvailabilityInfo();
        $("#delete_request").addClass( "disabled" );
    });
}
function placeAllMarkers(){
    
    $.get("ajax/userMarkers.php", function(response){
        console.log( response );
        for( var i = 0; i < response.length; ++i ){
            placeNewMarkerOnMapStatic( new google.maps.LatLng(response[i].lat, response[i].lng), map, response[i].space, response[i].title );
        }
    }, 'json');
}
function deleteMarker( id ){
    for( var i = 0; i < selectedMarkers.length; ++i ){
        if( selectedMarkers[i].get("id") == parseInt(id) ){
            selectedMarkers[i].set("visible",false);
            selectedMarkers.splice(i,1);
            return;
        }
    }
}
function acceptMarker( id ){
    for( var i = 0; i < markers.length; ++i ){
        if( markers[i].get("id") == parseInt(id) ){
            markers[i].set("icon", getState2Image() );
            markers[i].set("state",2);
            markers[i].set("accepted",true);
            acceptedMarkers.push(markers[i]);
            markers.splice(i,1);
            
            return;
        }
    }
}
function addRequest( marker ){
    requests.push(getJson(marker));
}

function initialize() {
    getAvailabilityInfo();
    $("#send_request").click( function(event){
       sendRequests();
    });
    $("#delete_request").click( function(event){
        sendDeleteRequests();
    });
    $("#reset_network").click( function(event){
       $.get("ajax/reset.php", function(response){
           getAvailabilityInfo();
           alert( response );
           clearAllMarkers();
       }); 
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
    placeAllMarkers();
}
function getImage( url ){
    return new google.maps.MarkerImage(url, null, null, new google.maps.Point(25, 25));
}
function getState1Image(){
    return getImage("images/state_1.png");
}
function getState2Image(){
    return getImage("images/state_2.png")
}
function getState3Image(){
    return getImage("images/state_3.png");
}
function placeNewMarkerOnMap( location, map ) {
    var newMarker = new MarkerWithLabel({
       position: location, 
       icon: getState1Image(),
       map: map,
       draggable:false,
       labelAnchor: new google.maps.Point(13,14),
       labelClass : 'label-text'
     });
    newMarker.info = null;
    newMarker.text = "";
    newMarker.set("id", id++);
    newMarker.set("accepted", false);
    newMarker.set("state",1);
    markers.push( newMarker );
    //var gPath = geodesic.getPath();
    //gPath.push( location );
    google.maps.event.addListener( newMarker, 'click', function(){
        if( !newMarker.get("accepted") ){
            if( infoBubble.get("visible") ){
                infoBubble.close();


            }else{
                input.val(newMarker.get("label"));
                infoBubble.open();

            }
        }else{
            console.log( selectedMarkers );
            switch( newMarker.get("state") ){
                case 2 :
                    newMarker.set("icon", getState3Image() );
                    newMarker.set("state",3);
                    selectedMarkers.push(newMarker);
                    $("#delete_request").removeClass( "disabled" );
                    break;
                case 3 :
                    newMarker.set("icon",getState2Image() );
                    newMarker.set("state",2);
                    var index = selectedMarkers.indexOf( newMarker );
                    selectedMarkers.splice( index, 1 );
                    if( selectedMarkers.length == 0 ){
                       $("#delete_request").addClass( "disabled" ) 
                    }
                    break;
            }
            
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
                if( val > 30 || val < 24 ){
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



function placeNewMarkerOnMapStatic( location, map, label, title ) {
    var newMarker = new MarkerWithLabel({
       position: location, 
       icon: getState2Image(),
       map: map,
       draggable:false,
       labelAnchor: new google.maps.Point(13,14),
       labelClass : 'label-text'
     });
    newMarker.info = null;
    newMarker.text = "";
    newMarker.set("id", id++);
    newMarker.set("accepted", true);
    newMarker.set("state",2);
    newMarker.set("visible", true);
    newMarker.set("label", label);
    newMarker.set("labelContent", "/"+label);
    markers.push( newMarker );
    //var gPath = geodesic.getPath();
    //gPath.push( location );
    google.maps.event.addListener( newMarker, 'click', function(){
       
            switch( newMarker.get("state") ){
                case 2 :
                    newMarker.set("icon", getState3Image() );
                    newMarker.set("state",3);
                    selectedMarkers.push(newMarker);
                    $("#delete_request").removeClass( "disabled" );
                    break;
                case 3 :
                    newMarker.set("icon",getState2Image() );
                    newMarker.set("state",2);
                    var index = selectedMarkers.indexOf( newMarker );
                    selectedMarkers.splice( index, 1 );
                    if( selectedMarkers.length == 0 ){
                       $("#delete_request").addClass( "disabled" ) 
                    }
                    break;
            }
    });
    if( title != null ){
        newMarker.set( "title", title );
    }
   addedMarkers.push(newMarker);
  
}