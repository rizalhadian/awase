<style type="text/css">
              #map-canvas { height: 400px; width: 100%; margin: 0; padding: 0; }
</style>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzf-1tMeYs2Eur4MIo_TCN_WV3ruZR8hU" async defer>
</script>
<script
    src="{{ asset("/dist/js/js-cluster/markerclusterer.js") }}">
</script>

<script type="text/javascript">

    $(document).ready( function(){
        $('#TambahTitik').hide();
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
            }, {
                featureType: "road",
                elementType: "geometry",
                stylers: [
                    {lightness: 100},
                    {visibility: "simplified"}
                ]
            }, {
                featureType: "road",
                elementType: "labels",
                stylers: [
                    {visibility: "off"}
                ]
            }
        ];

        function initialize(){
            var styledMap = new google.maps.StyledMapType(styles, {name : "Styled Map"});

            var mapOptions = {
                // center: myLatlng,
                zoom: 14,
                //mapTypeId: google.maps.MapTypeId.ROADMAP,
                mapTypeControl: false,
                mapTypeControlOptions: {
                    mapTypeId: [google.maps.MapTypeId.ROADMAP, 'map_style']
                }
            }


            var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            map.mapTypes.set('map_style', styledMap);
            map.setMapTypeId('map_style');
            if(navigator.geolocation){
                navigator.geolocation.getCurrentPosition(function(position){
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    map.setCenter(pos);
                }, function(){
                   handleNoGeolocation(true);
                });
            }else{
                handleNoGeolocation(false);
            }

            function handleNoGeolocation(errorFlag){
                if(errorFlag){
                    var content = "Error: Geolocation Service Gagal";
                }else{
                    var content = "Error: Browser tidan mensupport Geolocation Service";
                }

                var options = {
                    map: map,
                    position: new google.maps.LatLng(-8.7966617, 115.1767623),
                    content: content
                };
                var infowindow = new google.maps.InfoWindow(options);
                map.setCenter(options.position);
            }

            var markerClusterer = new MarkerClusterer(map, false, {
                ignoreHidden: true,
                gridSize: 20,
                averageCenter: true,
                maxZoom: 16
            });

            //Objek Marker
            markerMoving = new google.maps.Marker({
                    map: null,
                    animation: google.maps.Animation.DROP,
            });
            //Listener untuk menambah titik
            google.maps.event.addListener(map, 'mouseover', function(event){

                if(add == true){
                    markerMoving.setMap(map);
                    markerMoving.setPosition(event.latLng);

                    google.maps.event.addListener(map, 'mousemove', function(event){
                        markerMoving.setPosition(event.latLng);
                    });

                    google.maps.event.addListener(map, 'click', function(event){
                        if(add==true){
                            $('#lat').val(event.latLng.lat());
                            $('#lng').val(event.latLng.lng());
                            $('#update').hide();
                            $('#save').show();
                            // $('#AssemblyPointForm')[0].reset();
                            // $('#lat').val(null);
                            // $('#lng').val(null);
                            $('#name').val(null);
                            $('#address').val(null);
                            $('#FormModal').modal('show');

                        }
                    });
                }

            });



            loadMarkers();

            // Method menggambar marker
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
                     url : 'tsunami/getdetail',
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

                      $("#confDeleteYes").click(function(){
                        // alert(marker.id);
                        $.ajax({
                           url : 'rumahsakit/delete',
                           headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                           type: 'POST',
                           data: {id:$('#idForDelete').val()},
                           dataType: 'JSON',
                           success: function (data){
                             $("#idForDelete").val(null);
                             $('#modalConf').modal('hide');
                             marker.setMap(null);
                             alert(data);
                           },
                           error: function (jXHR, textStatus, errorThrown) {
                                // alert(errorThrown);
                           }
                        });
                      });

                      $("#confDeleteNo").click(function(){
                        $("#idForDelete").val(null);
                      });

                     },
                     error: function (jXHR, textStatus, errorThrown) {
                          alert(errorThrown);
                     }
                  });




                });



            }
            // Method me-load markers
            function loadMarkers(){
              // markerClusterer.clearMarkers();
                $.ajax({
                   url : 'tsunami/get',
                   headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                   type: 'GET',
                   data: $("#AssemblyPointForm").serialize(),
                   dataType: 'JSON',
                   success: function (data){
                       for(var i = 0; i < data.length; i++){
                           drawMarker(data[i]);
                       }
                      // alert(data);

                   },
                   error: function (jXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                   }
                });
            }




            $("#TambahTitik").click(function(){
                add = true;
                // alert(add);
                $('#CancelOnMap').show();
                $('#CancelOnModal').show();
                $("#TambahTitik").hide();
            });

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
                // loadMarkers();
            });

            $('#update').click(function(){
              $data = $('#AssemblyPointForm').serialize();

              $.ajax({
                  url : 'rumahsakit/edit',
                  type: "POST",
                  headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                  dataType: 'JSON',
                  data: $("#AssemblyPointForm").serialize(),
                  success: function (data) {
                    alert(data);
                  },
                  error: function (jXHR, textStatus, errorThrown) {
                      alert(errorThrown);
                  }
              });
              $('#AssemblyPointForm').trigger("reset");
              $('#FormModal').modal('hide');
            });

            $('update').click(function(){
              $data = $('#AssemblyPointForm').serialize();
              $.ajax({
                  url : 'rumahsakit/update',
                  type: "POST",
                  headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                  dataType: 'JSON',
                  data: $("#AssemblyPointForm").serialize(),
                  success: function (data) {
                    // drawMarker(data[0]);
                  },
                  error: function (jXHR, textStatus, errorThrown) {
                      alert(errorThrown);
                  }
              });

              $('#AssemblyPointForm').trigger("reset");
              $('#FormModal').modal('hide');
              $('#CancelOnMap').click();
            });



            $('#CancelOnMap').click(function(){
                add = false;
                markerMoving.setMap(null);
                $('#CancelOnMap').hide();
                $("#TambahTitik").show();

                $('#AssemblyPointForm').trigger("reset");
            });

        }

        google.maps.event.addDomListener(window, 'load', initialize);
    });

</script>
