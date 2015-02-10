<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>MINI</title>
    <base href="<?php echo URL ?>">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- JS -->
    <!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
    <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->

    <!-- CSS -->
    <!-- <link href="<?php echo URL; ?>css/style.css" rel="stylesheet"> -->
    <style type="text/css">
    *{
      margin: 0;
      padding: 0;
    }
    html{
      height: 100%;
      width: 100%;
    }
    body{
        background-image: url(<?php echo $this->play->location ?>);
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        height: 100%;
        width: 100%;
    }

div#map-canvas{
        /*min-width: 400px;
        min-height: 280px;*/
        height: calc(100% - 20px);
        opacity: 0.4;
    }

    div#corner{
      position: fixed;
      height: 300px;
      width: 400px;
      bottom: 20px;
      right: 20px;
    }

    button{
      width: 100%;
      background-color: green;
    }
    </style>
    
</head>
<body>


    <div id="corner">
      <div id="map-canvas"></div>
      <button>gues</button>
    </div>
    
    <!-- jQuery, loaded in the recommended protocol-less way -->
    <!-- more http://www.paulirish.com/2010/the-protocol-relative-url/ -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <!-- define the project's URL (to make AJAX calls possible, even when using this in sub-folders etc) -->
    <script>
        var url = "<?php echo URL; ?>";
    </script>

    <!-- our JavaScript -->
    <script src="http://maps.googleapis.com/maps/api/js?libraries=geometry&sensor=false"></script>
    <script src="<?php echo URL; ?>js/application.js"></script>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBc2c4PHstOSC8yufW5V0EHsyZ09QobYzI">
    </script>

    <script type="text/javascript">
    var resize = false;
    var map;
    var marker = null
    var center = new google.maps.LatLng(51.879833, 4.556242);
      function initialize() {
        var mapOptions = {
          streetViewControl: false,
          center: center,
          zoom: 10
        };
        map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);

        google.maps.event.addListener(map, 'idle', function() {
        console.log("idle");
        center = map.getCenter();
      });
        
        google.maps.event.addListener(map, 'click', function(event) {
          addMarker(event.latLng);
        });

function addMarker(location) {
  // if (marker) {
    
    // setAllMap(null);
    // marker = null;
    // addMarker(location);
  // } else {
    if (marker != null) {
      marker.setMap(null);
    };
    
  marker = new google.maps.Marker({
    position: location,
    map: map,
    draggable: true
  })
  console.log(marker.position.lat());
  map.panTo(location);
  // markers.push(marker);
// };
}
}








      google.maps.event.addDomListener(window, 'load', initialize);
    

      



      $("#corner").mouseenter(function() {
        console.log("bigger");
        resize = true;
        $("#map-canvas").animate({opacity:'1'})


        $(this).stop().animate({
          height:'+=20%',
          width:'+=20%'
        },"slow",function() {
          google.maps.event.trigger(map, "resize");
          map.panTo(center);
          
          
        });
      })
      $("#corner").mouseleave(function() {
        console.log("smaller");
        google.maps.event.trigger(map, "resize");
        $(this).stop().animate({
          height:'300px',
          width:'400px'
        },"slow",function() {
          $("#map-canvas").animate({opacity:'0.4'});
          google.maps.event.trigger(map, "resize");
          map.panTo(center);
        });
        
      })

      $("button").click(function () {
        if (marker != null) {
        $.ajax({url: "<?php echo URL ?>game/gues/<?php echo $this->play->id ?>", success: function (result) {
          var obj = JSON.parse(result);
          var realcord = new google.maps.LatLng(obj.lat, obj.lng);
          var cord = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
          var distance = Math.round(google.maps.geometry.spherical.computeDistanceBetween(realcord, cord));
          var score = Math.round(5000 - Math.pow(distance*0.14142136,2));
          var score = score > 0 ? score : 0;
          alert('je heb met deze foto: ' + score + " punten gescoord\nde afstand was "+ distance +" meter");
          window.location.replace("<?php echo URL ?>game");
        }})
        }else {
          alert("om te raden moet je eerst een marker plaatsen.\ndit doe je dooor op de map te klikken!")
        };
      })


    </script>
</body>
</html>