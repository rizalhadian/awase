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
      url : '/awase/public/admin/helpstatus/create',
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
      url : '/awase/public/admin/helpstatus/update',
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
      url : '/awase/public/admin/helpstatus/show',
      type: "POST",
      headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
      dataType: 'JSON',
      data: $("#modalForm").serialize(),
      success: function (data) {
        $('#modalSaveBtn').hide();
        $('#modalUpdateBtn').show();
        $('#id').val(data[0]['id']);
        $('#name').val(data[0]['name']);
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
      url : '/awase/public/admin/helpstatus/destroy',
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
