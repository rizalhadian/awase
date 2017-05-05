$(document).ready(function(){

  $("#tableAdd").click(function(){
      $('#modalForm')[0].reset();
      $('#modalSaveBtn').show();
      $('#modalUpdateBtn').hide();
      $('#modal').modal('show');
      // alert('tes');
  });

  $('#modalSaveBtn').click(function(){
    $.ajax({
      url : '/awase/public/admin/earthquakesimpacts/create',
      type: "POST",
      headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
      dataType: 'JSON',
      data: $("#modalForm").serialize(),
      success: function (data) {
        alert(data);
        location.reload();
      },
      error: function (jXHR, textStatus, errorThrown) {
        alert(errorThrown);
      }
    });
  });

  $('#modalUpdateBtn').click(function(){
    $.ajax({
      url : '/awase/public/admin/earthquakesimpacts/update',
      type: "POST",
      // headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
      dataType: 'JSON',
      data: $("#modalForm").serialize(),
      success: function (data) {
        alert(data);
        location.reload();
      },
      error: function (jXHR, textStatus, errorThrown) {
        alert(errorThrown);
      }
    });
  });

  $('.tableUpdateBtn').click(function(){
    $('#id').val($(this).attr('value'));

    $.ajax({
      url : '/awase/public/admin/earthquakesimpacts/show',
      type: "POST",
      headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
      dataType: 'JSON',
      data: $("#modalForm").serialize(),
      success: function (data) {
        $('#modalSaveBtn').hide();
        $('#modalUpdateBtn').show();
        $('#id').val(data[0]['id']);
        $('#mag_max').val(data[0]['mag_max']);
        $('#mag_min').val(data[0]['mag_min']);
        $('#deep_max').val(data[0]['deep_max']);
        $('#deep_min').val(data[0]['deep_min']);
        $('#impact_area').val(data[0]['impact_area']);
        $('#modal').modal('show');
      },
      error: function (jXHR, textStatus, errorThrown) {
        alert(errorThrown);
      }
    });
  });

  $('.tableDeleteBtn').click(function(){
    $('#id').val($(this).attr('value'));
    $('#modalDelete').modal('show');
    // $.ajax({
    //   url : 'earthquakesimpacts/destroy',
    //   type: "POST",
    //   headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
    //   dataType: 'JSON',
    //   data: $("#modalForm").serialize(),
    //   success: function (data) {
    //     alert(data);
    //     location.reload();
    //   },
    //   error: function (jXHR, textStatus, errorThrown) {
    //     alert(errorThrown);
    //   }
    // });
  });

  $('#modalDeleteYes').click(function(){
    $.ajax({
      url : '/awase/public/admin/earthquakesimpacts/destroy',
      type: "POST",
      headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
      dataType: 'JSON',
      data: $("#modalForm").serialize(),
      success: function (data) {
        // alert(data);
        location.reload();
      },
      error: function (jXHR, textStatus, errorThrown) {
        alert(errorThrown);
      }
    });
  });


});
