<html>
  <head>
    <title>Spatial Database</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPxbbcPu_GZsznOXsbaGhnk5ig2631xMM"></script>
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
      function initMap() {
        var uluru = {lat: -6.973996, lng: 107.630207};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom:14,
          center: uluru
        });

        var start;
        $.ajax({
          dataType: "json",
          url: 'http://localhost:8000/kfn.php',
          success: function(data){
            start = data.start;
            finish = data.finish;
            max = data.max + 1;

            finish.forEach(function(item) {

              if(max === item.index){
                icn = 'http://localhost:8000/icon/mark.png';
              }else{
                icn = '';
              }

                var marker = new google.maps.Marker({
                  position: item.coordinate,
                  label: item.index,
                  map: map,
                  icon:icn,
                  title: item.distance
                });

            });

            var image = 'http://localhost:8000/icon/home.png';
            var marker = new google.maps.Marker({
              position: start,
              map: map,
              icon:image
            });
          }
        });

      }
      initMap();

    </script>
  </body>
</html>
