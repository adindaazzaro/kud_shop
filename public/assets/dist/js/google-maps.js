let directionsService;
let directionsRenderer;
let autocomplete;
var latDt = -7.941678237212647;
var longDt = 112.63239295245197;
var lat = 0;
var long = 0;
var map;

//-7.941678237212647, 112.63239295245197
// -7.9416788,112.6302044
var markers = []; // Create a marker array to hold your markers

var nama = ""
var latitude = 0;
var longitude = 0;
var jarak = 0;
var alamat = "";

function initialize() {

    var mapOptions = {
        zoom: 17,
        mapTypeControl: false,
        draggable: false,
        scaleControl: false,
        scrollwheel: false,
        navigationControl: false,
        streetViewControl: false,
        disableDefaultUI: true,
        center: new google.maps.LatLng(latDt, longDt),
        mapTypeId: google.maps.MapTypeId.PETA
    }

    map = new google.maps.Map(document.getElementById('map'), mapOptions);

    setMarkers(latDt, longDt);
    map.addListener("click", (mapsMouseEvent) => {
        console.log(mapsMouseEvent.latLng.lat());
        lat = mapsMouseEvent.latLng.lat();
        long = mapsMouseEvent.latLng.lng();
        reloadMarkers(lat, long);
    });
    // Bind event listener on button to reload markers
    // document.getElementById('reloadMarkers').addEventListener('click', reloadMarkers);
}


// $(document).on('change', "#autocomplete", function (e) {
//     // alert("aaa");
//     if($(this).val() == ""){
//         $("#btn-alamat").addClass('btn-disabled');
//         $("#btn-alamat").attr('disabled', 'disabled');
//     }    
// });

function setMarkers(lat, long) {


    var myLatLng = new google.maps.LatLng(lat, long);
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        animation: google.maps.Animation.DROP,
        title: "Nama Kota",
        zIndex: 4
    });
    map.setCenter(new google.maps.LatLng(lat, long))
    // Push marker to markers array
    markers.push(marker);
}

function reloadMarkers(lat, long) {

    // Loop through markers and set map to null for each
    for (var i = 0; i < markers.length; i++) {

        markers[i].setMap(null);
    }

    // Reset the markers array
    markers = [];

    // Call set markers to re-add markers
    setMarkers(lat, long);
}


function calculateAndDisplayRoute(directionsService, directionsRenderer, lat,long) {
    console.log("start :" + latDt + " | " + longDt);
    console.log("end :" + lat + " | " + long);
    directionsService
        .route({
            origin: new google.maps.LatLng(latDt, longDt),

            destination: new google.maps.LatLng(lat, long),

            travelMode: google.maps.TravelMode.DRIVING,
        })
        .then((response) => {
            directionsRenderer.setDirections(response);
            var directionsData = response.routes[0].legs[0];
            console.log(directionsData);
            // alert("jaraknya :" + directionsData.distance.value);
            $("input[name='jarak']").val(directionsData.distance.value);
            $("input[name='detail-alamat-jarak']").val(directionsData.distance.value);
        })
        .catch((e) => window.alert("Directions request failed due to " + e));
        
}