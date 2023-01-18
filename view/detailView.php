<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2eLW_x_6iOu_5aIz1ZBv4gsigu-UzaYo"></script>
    <link rel="icon" href="https://cookieless.MySite.com/favicon.ico" type="image/x-icon"/>
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
        <h4>Conference details</h4>
        <hr/>
        <input type="hidden" name="id" value="<?php echo $data['conference']->ConferenceID ?>"/>
        Title: <input type="text" name="title" value="<?php echo $data['conference']->ConferenceTitle ?>""
        class="form-control" readonly/>
        Date: <input type="date" name="date" value="<?php echo $data['conference']->ConferenceDate ?>""
        class="form-control" readonly/>
        Country <select class="custom-select" id="inputGroupSelect01" disabled>
            <option value="1" <?php if ($data['conference']->CountryName == "Ukraine") echo "selected" ?>>Ukraine
            </option>
            <option value="2" <?php if ($data['conference']->CountryName == "Poland") echo "selected" ?>>Poland
            </option>
            <option value="3" <?php if ($data['conference']->CountryName == "France") echo "selected" ?>>France
            </option>
            <option value="4" <?php if ($data['conference']->CountryName == "Germany") echo "selected" ?>>Germany
            </option>
        </select>

        <div id="mapCanvas"
             style="<?php
             if ($data['conference']->AddressX != null && $data['conference']->AddressY != null)
                 echo "width: 100%;height: 400px;";
             else echo ''
             ?>">
            <script>
                var position = [<?php echo $data['conference']->AddressX ?>, <?php echo $data['conference']->AddressY ?>];

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
                        map: map,
                        title: "Latitude:" + position[0] + " | Longitude:" + position[1]
                    });
                }
                google.maps.event.addDomListener(window, 'load', initialize);
            </script>
        </div>

        <a href="../index.php?controller=conferences&action=delete&id=<?php echo $data['conference']->ConferenceID ?>"
           class="btn btn-outline-danger">Delete</a>
    </div>
</body>
</html>