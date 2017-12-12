<html>
  <head>
    <title>Spatial Database</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPxbbcPu_GZsznOXsbaGhnk5ig2631xMM&libraries=places"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>
  </head>
  <body>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h3>Spatial Database</h3>
          <div id="map"></div>
        </div>
      </div>
    </div>

    <script>
      var telkom = {lat: -6.973996, lng: 107.630207};
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom:12,
        center: telkom
      });

      function initMap() {
        var request = {
          location: telkom,
          radius: '3000',
          types: ['gas_station']
        };

        service = new google.maps.places.PlacesService(map);
        service.nearbySearch(request, callback);

        var start = telkom;
        new google.maps.Marker({
          position: start,
          map: map
        });

      }

      function callback(results, status) {
        if (status == google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < results.length; i++) {
            var place = results[i];
            new google.maps.Marker({
              map: map,
              place: {
                placeId: results[i].place_id,
                location: results[i].geometry.location
              }
            });
          }
        }
      }

      initMap();

    </script>
  </body>
</html>
