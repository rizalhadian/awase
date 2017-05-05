<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="FormLabel">Disaster Status</h4>
            </div>
            <div class="modal-body">
                <form id='modalForm' action='' method='post' role="form" data-toggle="validator">
                    <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id" id="id">



                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                          <input type="text" class="form-control" id="name" name="name" placeholder="" required>
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
