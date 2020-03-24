<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="domain" content="{{ env('APP_URL')  }}">
        <title>Covid Map</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
{{--        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>--}}
{{--        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" >--}}
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" >

{{--
        <script>
            let tabIsVisible = false;
            let map;
            let marker;
            let Markerlocation;
            let markers = [];
            let mapIsInit = true;
            let reports;
            let icon = '{{ asset("assets/Pin2.svg") }}';

        async function getPoints(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            const result = $.ajax({
                url: '{{ env('APP_URL') }}/report',
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
                            $('#peopleId').text(item.people);
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

        </script>
        --}}
    </head>
    <body style="background-color: #ffffff">
    <nav class="navbar navbar-expand-lg navbar-light bavbatBgColor shadowBottom navbarStyles">
        <span class="logo">Covid Map</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav colorGray mr-auto">
                <li class="nav-item">
                    <a class="nav-link active-link" href="#">Map <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a href="/hot-line" class="nav-link">Contact</a>
                </li>
              {{--  <li class="nav-item">
                    <a class="nav-link" href="#">More official informacion</a>
                </li> --}}
            </ul>
            <ul class=" navbar-nav">
                <li class="nav-item">
                    <button class="borderRadius20 reportBtn">Report</button>
                </li>
            </ul>
        </div>
    </nav>

        <div id="map"></div>
        <div id="over_map" class="shadowBottom">
            <form class="form" id="reportForm" action="/report" method="post">
                <h2 class="cardTitle">Enter data <span class="arrowRight">
                        <i class="far fa-times-circle"></i>
                    </span></h2>

                <div class="form-group">
                    <input required type="text" name="emergency" class="borderRadius20 form-control" placeholder="what`s the emergency ?">
                </div>
                <div class="form-group">
                    <input required type="text" name="address" class="borderRadius20 form-control"  placeholder="what`s the address ?">
                </div>
                <div class="form-group">
                    <input required type="text" name="phone" class="borderRadius20 form-control"  placeholder="Enter contact phone number ?">
                </div>
                <div class="form-group">
                    <textarea required class="form-control" name="description" rows="3"  placeholder="describe what do you need"></textarea>
                </div>
                <div class="form-group" style=" text-align:center;">
                    <button type="submit" class="borderRadius20 btn btn-send">submit</button>
                </div>
            </form>
        </div>
        <div id="over_mapReport" class="shadowBottom">
                <h2 class="cardTitle">Report
                    <span class="arrowRightReport">
                        <i class="far fa-times-circle"></i>
                    </span>
                </h2>
                <p><b>Emergency: </b><span id="reportId"></span></p>
                <p><b>Phone: </b><span id="phoneId"></span></p>
                <p><b>Address: </b><span id="addressId"></span></p>
                <p><b>Descripion: </b><span id="descriptionId"></span></p>
        </div>


    <script src="{{ asset('assets/js/script.js') }}"> </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlrgF8pVRHTF23077VmyciFidkUP4H90k&callback=initMap"></script>
    </body>
</html>
