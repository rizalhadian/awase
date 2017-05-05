<style type="text/css">
  #map-canvas { height: 400px; width: 100%; margin: 0; padding: 0; }
</style>

<script
  src="{{ asset("/dist/js/js-cluster/markerclusterer.js") }}">
  //JS for Clusterer
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#CancelOnMap').hide();
    $('#update').hide();
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

      markerTemporary = new google.maps.Marker({
        map: null,
      });
      //Marker moveable sementara yang akan dimunculkan pada aksi penambahan marker sebelum dikonfirmasi

      google.maps.event.addListener(map, 'mouseover', function(event){

        if(add==true){
          markerTemporary.setMap(map);
          markerTemporary.setPosition(event.latLng);

          google.maps.event.addListener(map, 'mousemove', function(event){
              markerTemporary.setPosition(event.latLng);
          });
          //End listener mousemove
          //Merubah posisi markerTemporary agar mengikuti gerakan cursor mouse
          google.maps.event.addListener(map, 'mouseout', function(event){
              markerTemporary.setMap();
          });
          //End listener mouseout
          //Menghilangkan markerTemporary apabila cursor keluar dari map
          google.maps.event.addListener(map, 'click', function(event){
            $('#lat').val(event.latLng.lat());
            $('#lng').val(event.latLng.lng());
            $('#update').hide();
            $('#save').show();
            $('#name').val(null);
            $('#address').val(null);
            $('#FormModal').modal('show');
          });
          //End listener click
          //Menampilkan form untuk menambahkan data sesuai marker yang dituju
        }
        //End If
      });
      //End listener mouseover

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
