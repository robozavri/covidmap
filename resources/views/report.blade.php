<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script async defer src="https://maps.googleapis.com/maps/api/js?signed_in=true&callback=initMap"></script>
        <script>

            let map;
            let marker;
            let markers = [];
            let mapIsInit = true;

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
                }
            }

            // google.maps.event.addListener(map, 'click', function(event) {
            //     placeMarker(event.latLng);
            // });
        </script>
    </head>
    <body>
        <div id="map"></div>
        <style>
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
            #map {
                height: 99%;
                width: 99%;
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
    </body>
</html>
