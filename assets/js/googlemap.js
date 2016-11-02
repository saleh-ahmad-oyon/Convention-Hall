var myCenter = new google.maps.LatLng(23.8233556, 90.3668054);
var initMap = function() {
    var mapProp = {
        center : {
            lat: 23.8233556,
            lng: 90.3668054
        },
        scrollwheel: false,
        zoom : 16,
        mapTypeId : google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

    var marker = new google.maps.Marker({
        position : myCenter,
        map : map
        //animation:google.maps.Animation.BOUNCE
    });

    marker.setMap(map);
    var infowindow = new google.maps.InfoWindow({
        content : "Ahmad Convention Hall"
    });

    google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map,marker);
    });
};
google.maps.event.addDomListener(window, 'load', initMap);