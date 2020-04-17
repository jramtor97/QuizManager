<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <title>Maps</title>
      <div id="map"></div>
      <script type="text/javascript">
      function iniciarMap(){
        var coord = {lat: 38.9888359, lng: -1.86523};
        var map = new google.maps.Map(document.getElementById('map'),{
          zoom: 10,
          center: coord
        });
        var marker = new google.maps.Marker({
          position: coord,
          map: map
        });
      }
    </script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6K1bR4cAd9IEiL8MPvHmfGa6tgPiYM4M&callback=iniciarMap"></script>
</head>
<body>
<style type="text/css">
  #map{
    height: 500px;
    width: 100%;
  }
</style>
    
    
</body>
</html>
