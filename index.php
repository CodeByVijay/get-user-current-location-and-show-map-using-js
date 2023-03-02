<!doctype html>
<html lang="en">

<head>
    <title>Get User Current Location & Show Map</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container my-5">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Get User Current Location & Show Map</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group row">
                            <div class="col-md-2"><label for="latitude">Latitude</label></div>
                            <div class="col-md-9">
                                <input type="text" name="latitude" class="form-control" id="latitude" placeholder="Latitude...">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-2"><label for="longitude">Longitude</label></div>
                            <div class="col-md-9">
                                <input type="text" name="longitude" class="form-control" id="longitude" placeholder="Longitude...">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-2"><label for="address">Address</label></div>
                            <div class="col-md-9">
                                <input type="text" name="address" class="form-control" id="address" placeholder="address...">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div id="map" style="border: 1px solid black;">
                            <iframe width="100%" id="iframeMap" height="170" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="">
                            </iframe>
                            <span id="msg" style="padding: 20px;"></span>
                            <!-- <a href="#" onclick="getLocation()">Location Permission</a> -->
                        </div>
                    </div>
                </div>

                <!-- Address To Map View -->
                <div style="width: 100%; border: 1px solid black; margin: 10px;" id="addressIframeDiv">
                    <iframe width="100%" height="400" id="addressIframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src=""></iframe>
                </div>
                <!-- Address To Map View End -->
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        var latitude = document.getElementById("latitude");
        var longitude = document.getElementById("longitude");
        let iframe = $("#iframeMap");
        let msg = $("#msg");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
                if (latitude.value.length === 0 || longitude.value.length === 0) {
                    iframe.hide()
                    msg.addClass('text-danger')
                    msg.html("Location Permission Denide.");
                }
            } else {
                msg.html("Geolocation is not supported by this browser.");
            }
        }
        getLocation();

        function showPosition(position) {
            iframe.show()
            msg.hide();
            latitude.value = position.coords.latitude;
            longitude.value = position.coords.longitude;
            let url = `https://maps.google.com/maps?q=${latitude.value},${longitude.value}&output=embed`;
            iframe.attr('src', url)
        }

        if ($('#address').val().length === 0) {
            $('#addressIframeDiv').hide()
        }
        $(document).on('keyup', '#address', function() {
            let val = $(this).val()
            let div = $('#addressIframeDiv')
            let iframe = $('#addressIframe')
            if (val.length === 0) {
                div.hide()
            } else {
                div.show()
                let url = `https://maps.google.com/maps?q=${val}&output=embed`;
                iframe.attr('src', url)
            }

        })
    </script>
</body>

</html>