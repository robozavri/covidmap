let tabIsVisible = false;
let map;
let marker;
let Markerlocation;
let markers = [];
let mapIsInit = true;
let reports;
let icon = $('meta[name="domain"]').attr('content')+'/assets/Pin2.svg';

async function getPoints(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    const result = $.ajax({
        url: $('meta[name="domain"]').attr('content')+'/report',
        type: 'get',
        success: function(data) {
            // let markersArr = [];
            // let itemMarker
            // reports = JSON.parse(data);
            // reports.map(function(item){
            //     itemMarker = new google.maps.Marker({
            //         position: new google.maps.LatLng(item.lat,item.lng),
            //         map: map,
            //         icon: icon
            //     });
            //     itemMarker.addListener('click', function() {
            //         // console.log(item)
            //         $('#reportId').text(item.emergency);
            //         $('#peopleId').text(item.people);
            //         $('#descriptionId').text(item.description);
            //         $('#addressId').text(item.address);
            //
            //         $("#over_mapReport").animate({
            //             marginRight: "630px"
            //         },500);
            //
            //     });
            //     markersArr.push(itemMarker);
            // });
            return data;
        }
    });
    return result;
}
function initMap(listener) {
    // tbilisi coordinate
    let lat_lng = {lat: 41.728280, lng: 44.779342};
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: lat_lng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    getPoints().then( (data) => {

            let markersArr = [];
            let itemMarker
            reports = JSON.parse(data);
            reports.map(function(item){
                itemMarker = new google.maps.Marker({
                    position: new google.maps.LatLng(item.lat,item.lng),
                    map: map,
                    icon: icon
                });
                itemMarker.addListener('click', function() {
                    // console.log(item)
                    $('#reportId').text(item.emergency);
                    $('#phoneId').text(item.phone);
                    $('#descriptionId').text(item.description);
                    $('#addressId').text(item.address);

                    $("#over_mapReport").animate({
                        marginRight: "630px"
                    },500);

                });
                markersArr.push(itemMarker);
            });
            // console.log('getPoints async',data);
        }
    );

    // This event listener will call addMarker() when the map is clicked.
    map.addListener('click', function (event) {
        if(tabIsVisible)
        {
            placeMarker(event.latLng);
        }
        // if(mapIsInit)
        // addMarker(event.latLng);
        // mapIsInit = false;
    });

    // Adds a marker at the center of the map.
    // addMarker(lat_lng);
}

// Adds a marker to the map and push to the array.
function addMarker(location) {
    var marker = new google.maps.Marker({
        position: location,
        map: map,
        icon: icon
    });
    markers.push(marker);
}

function placeMarker(location) {
    if ( marker ) {
        marker.setPosition(location);
    } else {
        marker = new google.maps.Marker({
            position: location,
            map: map,
            icon: icon
        });
    }
    Markerlocation = location;
}

// google.maps.event.addListener(map, 'click', function(event) {
//     placeMarker(event.latLng);
// });


$( "#reportForm" ).submit(function( event ) {
    event.preventDefault();

    if(!marker){
        alert('choose point on map');
        return;
    }

    var actionurl = event.currentTarget.action;

    let formData = {};

    formData.emergency = $("[name=emergency]").val();
    formData.address = $("[name=address]").val();
    formData.phone = $("[name=phone]").val();
    formData.description = $("[name=description]").val();
    // formData.location = { lat : Markerlocation.lat(), lng: Markerlocation.lng()};
    formData.lat =  Markerlocation.lat();
    formData.lng =  Markerlocation.lng();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: actionurl,
        type: 'post',
        dataType: 'application/json',
        data: formData,
        success: function(data) {
            console.log('server',data);
            // tabIsVisible = false;
            // location.reload();
        }
    });

    // alert('successfully sent')

    $("[name=emergency]").val('');
    $("[name=address]").val('');
    $("[name=phone]").val('');
    $("[name=description]").val('');
    // $("#over_map").hide('slow');
    // $("#over_map").remove();
    tabIsVisible = false;
    $("#over_map").animate({
        marginRight: "0px"
    },500);
    // location.reload();

});

$( '.reportBtn' ).click(function() {
    tabIsVisible = true;
    $("#over_map").animate({
        marginRight: "630px"
    },500);
});

$( '.arrowRight' ).click(function() {
    tabIsVisible = false;
    $("#over_map").animate({
        marginRight: "0px"
    },500);
});

$( '.arrowRightReport' ).click(function() {
    tabIsVisible = false;
    $("#over_mapReport").animate({
        marginRight: "0px"
    },500);
});
