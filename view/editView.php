<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2eLW_x_6iOu_5aIz1ZBv4gsigu-UzaYo"></script>
    <link rel="icon" href="https://cookieless.MySite.com/favicon.ico" type="image/x-icon"/>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Conferences</title>
    <style>
        input {
            margin-top: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header clearfix">
        <nav>
            <ul class="nav nav-pills float-right">
                <li class="nav-item">
                    <a class="btn btn-outline-dark" href="../index.php"">Back</a>
                </li>
                <li class="nav-item">
                </li>
            </ul>
        </nav>
        <h3 class="text-muted">Conferences<br></h3>
    </div>
    <div class="jumbotron">
        <h4>Edit Conference</h4>
        <hr/>
        <form name="update" action="../index.php?controller=conference&action=update" method="post">
            <input type="hidden" name="id" value="<?php echo $data['conference']->ConferenceID ?>"/>
            Title: <input type="text" name="title" value="<?php echo $data['conference']->ConferenceTitle ?>"
                          class="form-control" minlength="2" maxlength="255" required/>
            Date: <input type="date" name="date" value="<?php echo $data['conference']->ConferenceDate ?>"
                         class="form-control" min="<?php echo date("Y-m-d") ?>" required/>
            Country <select name="country" class="custom-select" id="inputGroupSelect01" required>
                <option value="1" <?php if ($data['conference']->CountryName == "Ukraine") echo "selected" ?>>Ukraine
                </option>
                <option value="2" <?php if ($data['conference']->CountryName == "Poland") echo "selected" ?>>Poland
                </option>
                <option value="3" <?php if ($data['conference']->CountryName == "France") echo "selected" ?>>France
                </option>
                <option value="4" <?php if ($data['conference']->CountryName == "Germany") echo "selected" ?>>Germany
                </option>
            </select>

            Latitude <input type="text"
                            id="x"
                            value="<?php
                            if ($data['conference']->AddressX != null)
                                echo $data['conference']->AddressX; ?>"
                            name="addressX"
                            class="form - control"/>
            Longitude <input type="text"
                             id="y"
                             value="<?php
                             if ($data['conference']->AddressY != null)
                                 echo $data['conference']->AddressY; ?>"
                             name="addressY"
                             class="form - control"/>

            <div id="mapCanvas" style="width: 100 %;height: 400px;">
                <script>
                    var position = [<?php
                        if ($data['conference']->AddressX != null && $data['conference']->AddressY != null)
                            echo $data['conference']->AddressX . "," . $data['conference']->AddressY;
                        else echo "40.748774" . "," . "-73.985763"; ?>];

                    function initialize() {
                        var latlng = new google.maps.LatLng(position[0], position[1]);
                        var myOptions = {
                            zoom: 16,
                            center: latlng,
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
                        map = new google.maps.Map(document.getElementById("mapCanvas"), myOptions);

                        marker = new google.maps.Marker({
                            position: latlng,
                            title: "Latitude:" + position[0] + " | Longitude:" + position[1]
                        });

                        if (x.value == null || y.value == null)
                            marker.setMap(null);

                        google.maps.event.addDomListener(map, 'click', function (event) {
                            var result = [event.latLng.lat(), event.latLng.lng()];
                            transition(result);
                        });
                    }

                    google.maps.event.addDomListener(window, 'load', initialize);

                    var numDeltas = 100;
                    var delay = 10;
                    var i = 0;
                    var deltaLat;
                    var deltaLng;

                    function transition(result) {
                        i = 0;
                        deltaLat = (result[0] - position[0]) / numDeltas;
                        deltaLng = (result[1] - position[1]) / numDeltas;
                        moveMarker();
                    }

                    function moveMarker() {
                        position[0] += deltaLat;
                        position[1] += deltaLng;
                        var latlng = new google.maps.LatLng(position[0], position[1]);
                        marker.setMap(map);
                        marker.setTitle("Latitude:" + position[0] + " | Longitude:" + position[1]);
                        document.forms['update']['addressX'].value = position[0];
                        document.forms['update']['addressY'].value = position[1];
                        marker.setPosition(latlng);
                        if (i != numDeltas) {
                            i++;
                            setTimeout(moveMarker, delay);
                        }
                    }

                    x.onkeyup = wait(function (e) {
                        if (x.value == null || y.value == null)
                            marker.setMap(null);
                        else {
                            var result = [x.value, y.value];
                            transition(result);
                        }
                    }, 1000);

                    y.onkeyup = wait(function (e) {
                        if (x.value == null || y.value == null)
                            marker.setMap(null);
                        else {
                            var result = [x.value, y.value];
                            transition(result);
                        }
                    }, 1000);

                    function wait(callback, ms) {
                        var timer = 0;
                        return function () {
                            var context = this, args = arguments;
                            clearTimeout(timer);
                            timer = setTimeout(function () {
                                callback.apply(context, args);
                            }, ms || 0);
                        };
                    }
                </script>
            </div>
            <input type="submit" value="Save" class="btn btn-outline-success"/>
            <a href=" ../index.php?controller=conferences&action=delete&id=<?php echo $data['conference']->ConferenceID ?>"
               class="btn btn-outline-danger">Delete</a>
        </form>
    </div>
</body>
</html>