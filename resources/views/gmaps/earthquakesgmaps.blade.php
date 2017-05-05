<style type="text/css">
  #map-canvas { height: 400px; width: 100%; margin: 0; padding: 0; }
</style>

<script
  src="{{ asset("/js/markerclusterer.js") }}">
  //JS for Clusterer
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#CancelOnMap').hide();
    $('#update').hide();
    $('#TambahTitik').hide();
    $('#tableAdd').hide();
    var add = false;
    var markers = [];
    var infoWind = new google.maps.InfoWindow({});

    var styles = [
      {
        stylers: [
          {hue: "#0099ff"},
          {saturation: -40}
        ]
      },
      {
        featureType: "road",
        elementType: "geometry",
        stylers: [
          {lightness: 100},
          {visibility: "simplified"}
        ]
      },
      {
        featureType: "road",
        elementType: "labels",
        stylers: [
          {visibility: "off"}
        ]
      }
    ]

    function initMap() {
      var styledMap = new google.maps.StyledMapType(styles, {name : "Styled Map"});
      var mapOptions = {
          center: {lat: -1.7452209, lng: 117.8831808},
          zoom: 5,
          //mapTypeId: google.maps.MapTypeId.ROADMAP,
          mapTypeControl: false,
          mapTypeControlOptions: {
              mapTypeId: [google.maps.MapTypeId.ROADMAP, 'map_style']
          }
      }
      //End of mapOptions

      var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
      map.mapTypes.set('map_style', styledMap);
      map.setMapTypeId('map_style');

      var markerClusterer = new MarkerClusterer(map, false, {
        ignoreHidden: true,
        gridSize: 20,
        averageCenter: true,
        maxZoom: 16
      });

      loadMarkers();

      function drawMarker(data){
        var arr = markers.length+1;
        var marker = new google.maps.Marker({
          position : new google.maps.LatLng(data.lat, data.lng),
          map : map,
          id : data.id,
          arr : arr,
          name : data.name
        });
        markers[arr] = marker;
        markerClusterer.addMarker(marker);

        //Listener klik marker
        google.maps.event.addListener(marker, 'click', function(event){
          var token = $('#_token').val();

          $.ajax({
            url : 'earthquakes/showDetail',
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
            data: {id:marker.id},
            dataType: 'JSON',
            success: function (data){
            //  alert(data);
              if(data[0].tsunami == 0){
                pot = "Tidak Berpotensi Tsunami";
              }else{
                pot = "Berpotensi Tsunami";
              }

              infoWind.setContent(
                "<h4>" + data[0].mag + " SR</h4><br>" +
                "<h6>" + pot + "</h6><br>" +
                "<h6>Tanggal : " + data[0].date + "</h6><br>" +
                "<center>" +
                "</center>"
              ), 'json';
              infoWind.open(map, marker);

              $("#getDetail").click(function(){
                $('#id').val(data[0].id);
                $('#lat').val(data[0].lat);
                $('#lng').val(data[0].lng);
                $('#name').val(data[0].name);
                $('#address').val(data[0].address);
                $('#FormModal').modal('show');
                $('#save').hide();
                $('#update').show();
              });

              $("#confDelete").click(function(){
                $("#deleteTitle").text('Apakah anda yakin menghapus '+marker.name+'?');
                $("#idForDelete").val(marker.id);
                $('#modalConf').modal('show');
              });
            },
            error: function (jXHR, textStatus, errorThrown) {
              alert(errorThrown);
            }
          });
        });
      } //End Of drawMarker
      function loadMarkers(){
        // markerClusterer.clearMarkers();
        $.ajax({
          url : 'earthquakes/showAll',
          headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
          type: 'GET',
          data: $("#AssemblyPointForm").serialize(),
          dataType: 'JSON',
          success: function (data){

            for(var i = 0; i < data.length; i++){
              drawMarker(data[i]);
            }
          },
          error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
          }
        });
      }//End of loadMarkers
    }
    //End Of initMap

    $("#TambahTitik").click(function(){
      add = true;
      $('#CancelOnMap').show();
      $('#CancelOnModal').show();
      $("#TambahTitik").hide();
    });
    //Button untuk menambah marker pada map

    $('#CancelOnMap').click(function(){
      add = false;
      $('#CancelOnMap').hide();
      $("#TambahTitik").show();
      $('#AssemblyPointForm').trigger("reset");
    });
    //Button Cancel untuk menambah marker

    $('#save').click(function(){
      $data = $("#AssemblyPointForm").serialize();
      $.ajax({
        url : 'rumahsakit/add',
        type: "POST",
        headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
        dataType: 'JSON',
        data: $("#AssemblyPointForm").serialize(),
          success: function (data) {
            drawMarker(data[0]);
          },
          error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
          }
      });

      $('#AssemblyPointForm').trigger("reset");
      $('#FormModal').modal('hide');
      $('#CancelOnMap').click();
    });

    google.maps.event.addDomListener(window, 'load', initMap);
  });
  //End document ready
</script>

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-MwemIroiWbHPbJXdZQIMp9jep7ycNoQ" async defer>
    //ApiKey
</script>
