<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="FormLabel">Earthquake Impact</h4>
            </div>
            <div class="modal-body">
                <form id='modalForm' action='{{ url('admin/titikkumpul/add') }}' method='post' role="form" data-toggle="validator">
                    <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id" id="id">

                    <div class="form-group">
                        <div class="col-lg-6">
                            <label for="exampleInputEmail1">Magnitude Maximum</label>
                            <div class='input-group'>
                              <input type="text" class="form-control" id="mag_max" name="mag_max" placeholder="" required>
                              <span class="input-group-addon">SR</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="exampleInputEmail1">Magnitude Minimum</label>
                            <div class="input-group">
                              <input type="text" class="form-control" id="mag_min" name="mag_min" placeholder="" required>
                              <span class="input-group-addon">SR</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-6">
                            <label for="exampleInputEmail1">Kedalaman Maximum</label>
                            <div class="input-group">
                              <input type="text" class="form-control" id="deep_max" name="deep_max" placeholder="" required>
                              <span class="input-group-addon">Km</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="exampleInputEmail1">Kedalaman Minimum</label>
                            <div class="input-group">
                              <input type="text" class="form-control" id="deep_min" name="deep_min" placeholder="" required>
                              <span class="input-group-addon">Km</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Impact Area</label>
                        <div class='input-group'>
                          <input type="text" class="form-control" id="impact_area" name="impact_area" placeholder="" required>
                          <span class="input-group-addon">Km</span>
                        </div>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id='modalSaveBtn'>Save</button>
                <button type="button" class="btn btn-primary" id='modalUpdateBtn'>Update</button>
                <button type="button" class="btn btn-default" id='modalCancelBtn' data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="deleteTitle">Are you sure to delete this?</h4>
            </div>
            <div class="modal-body">
              <input type="hidden" id="idModalDelete" name="id">
                    <div class="form-group">
                        <div class="col-lg-6">
                          <button type="button" class="btn btn-danger btn-block" id='modalDeleteYes'>Yes</button>
                        </div>
                        <div class="col-lg-6">
                          <button type="button" class="btn btn-default btn-block" id='modalDeleteNo' data-dismiss="modal">No</button>
                        </div>
                    </div>
            </div>
            <br>

        </div>
    </div>
</div>
