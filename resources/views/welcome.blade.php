<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Covid Map</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
{{--        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>--}}
{{--        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" >--}}


        <script>

            let map;
            let marker;
            let Markerlocation;
            let markers = [];
            let mapIsInit = true;
            let reports;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ env('APP_URL') }}/report',
                type: 'get',
                success: function(data) {
                    let markersArr = [];
                    let itemMarker
                    reports = JSON.parse(data);
                    reports.map(function(item){
                        // console.log('report item: ',item);
                        itemMarker = new google.maps.Marker({
                            position: new google.maps.LatLng(item.lat,item.lng),
                            map: map,
                            title: item.emergency
                        });
                        itemMarker.addListener('click', function() {
                            // console.log(item)
                            $('#reportId').text(item.emergency);
                            $('#peopleId').text(item.people);
                            $('#descriptionId').text(item.description);
                            $('#addressId').text(item.address);
                        });
                        markersArr.push(itemMarker);
                    });
                        // console.log('reports: ',reports);
                        // console.log('reports: ',data);
                }
            });

            function initMap(listener) {
                // tbilisi coordinate
                let lat_lng = {lat: 41.728280, lng: 44.779342};
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 12,
                    center: lat_lng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });

                // This event listener will call addMarker() when the map is clicked.
                map.addListener('click', function (event) {
                    placeMarker(event.latLng);

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
                    map: map
                });
                markers.push(marker);
            }

            function placeMarker(location) {
                if ( marker ) {
                    marker.setPosition(location);
                } else {
                    marker = new google.maps.Marker({
                        position: location,
                        map: map
                    });
                    Markerlocation = location;
                }
            }

            // google.maps.event.addListener(map, 'click', function(event) {
            //     placeMarker(event.latLng);
            // });

        </script>
    </head>
    <body style="background-color: cadetblue">
    <nav class="navbar navbar-expand-lg navbar-light bavbatBgColor">
        <a class="logo colorGray" href="#">Covid Map</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav colorGray mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Map <span class="sr-only">(current)</span></a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="#">More official informacion</a>--}}
{{--                </li>--}}
            </ul>
            <ul class=" navbar-nav">
                <li class="nav-item">
                    <button class="borderRadius20 reportBtn">Report</button>
                </li>
            </ul>
        </div>
    </nav>

        <div id="map"></div>
        <div id="over_map">
            <form class="form" id="reportForm" action="/report" method="post">
                <h2 class="cardTitle">Enter data <span class="arrowRight"><i class="fas fa-arrow-right"></i></span></h2>

                <div class="form-group">
                    <input required type="text" name="emergency" class="borderRadius20 form-control" placeholder="what`s the emergency ?">
                </div>
                <div class="form-group">
                    <input required type="text" name="address" class="borderRadius20 form-control"  placeholder="what`s the address ?">
                </div>
                <div class="form-group">
                    <input required type="text" class="borderRadius20 form-control" name="people" placeholder="how meny people do you need ?">
                </div>
                <div class="form-group">
                    <textarea required class="form-control" name="description" rows="3"  placeholder="describe what do you need"></textarea>
                </div>
                <div class="form-group" style=" text-align:center;">
                    <button type="submit" class="borderRadius20 btn btn-send">submit</button>
                </div>
            </form>
        </div>
        <div id="over_mapReport">
                <h2 class="cardTitle">Report</h2>
                <p><b>Emergency: </b><span id="reportId"></span></p>
                <p><b>People: </b><span id="peopleId"></span></p>
                <p><b>Address: </b><span id="addressId"></span></p>
                <p><b>Descripion: </b><span id="descriptionId"></span></p>
        </div>

        <style>
            .arrowRight {
                display: inline-block;
                float: right;
                cursor: pointer;
            }
            .bavbatBgColor {
                background-color: white;
            }
            .reportBtn {
                font-size: 20px;
                font-weight: 600;
                margin-right: 100px;
                color: #ffffff;
                background-color: #FF7777;
                border-color: #FF7777;
                padding: 0px 20px 0px 20px;
            }
            .logo {
                display: inline-block;
                padding-top: .3125rem;
                padding-bottom: .3125rem;
                margin-right: 1rem;
                font-size: 1.25rem;
                line-height: inherit;
                white-space: nowrap;
            }
            .colorGray {
                color: #999999;
            }
            .btn-send {
                color: #ffffff;
                background-color: #e94e5d;
                border-color: #e94e5d;
                padding: 10px 20px 10px 20px;
                font-size: 15px;
                font-weight: 900;
            }
            .borderRadius20{
                border-radius: 20px;
            }
            .cardTitle {
               padding-bottom: 1rem;
                margin-bottom: 1rem;
                border-bottom: 1px solid #999999;
            }
            .form {
                border-radius: 20px;
                padding: 40px;
            }
            #over_map {
                border-radius: 20px 0 0 20px;
                right: -640px;
                /*right: 10px;*/
                position: absolute;
                top: 130px;
                z-index: 99;
                /*height: 70%;*/
                width: 40%;
                background-color: #ffffff;
                /*background-color: #ffc37c;*/
            }
            #over_mapReport {
                border-radius: 20px 0 0 20px;
                right: 0px;
                padding: 20px;
                /*right: 10px;*/
                position: absolute;
                top: 130px;
                z-index: 92;
                /*height: 70%;*/
                width: 39%;
                background-color: #ffffff;
                /*background-color: #ffc37c;*/
            }


            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
            #map {
                height: 99%;
                /*width: 99%;*/
            }
            #panel {
                position: absolute;
                top: 10px;
                left: 25%;
                z-index: 5;
                background-color: #fff;
                padding: 5px;
                border: 1px solid #999;
                text-align: center;
            }


            #panel, .panel {
                font-family: 'Roboto','sans-serif';
                line-height: 30px;
                padding-left: 10px;
            }

            #panel select, #panel input, .panel select, .panel input {
                font-size: 15px;
            }

            #panel select, .panel select {
                width: 100%;
            }

            #panel i, .panel i {
                font-size: 12px;
            }

        </style>
    <script>

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
            formData.people = $("[name=people]").val();
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
                    $("#over_map").hide('slow', function(){ $target.remove(); });
                }
            });
        });

        $( '.reportBtn' ).click(function() {
            $("#over_map").animate({
                marginRight: "630px"
            },500);
        });

        $( '.arrowRight' ).click(function() {
            $("#over_map").animate({
                marginRight: "0px"
            },500);
        });

    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?callback=initMap"></script>
    </body>
</html>
