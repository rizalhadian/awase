<div class="modal fade" id="FormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="FormLabel">Tambah Rumah Sakit</h4>
            </div>
            <div class="modal-body">
                <form id='AssemblyPointForm' action='{{ url('admin/titikkumpul/add') }}' method='post' role="form" data-toggle="validator">
                    <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id" id="id">

                    <div class="form-group">
                        <div class="col-lg-6">
                            <label for="exampleInputEmail1">Latitude</label>
                            <input type="text" class="form-control" id="lat" name="lat" placeholder="" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="exampleInputEmail1">Longitude</label>
                            <input type="text" class="form-control" id="lng" name="lng" placeholder="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Telepon</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Alamat</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id='save'>Save</button>
                <button type="button" class="btn btn-primary" id='update'>Update</button>
                <button type="button" class="btn btn-default" id='cancelOnModal' data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalConf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="deleteTitle">Apakah anda yakin menghapus?</h4>
            </div>
            <div class="modal-body">
              <input type="hidden" id="idForDelete" name="idForDelete">
                    <div class="form-group">
                        <div class="col-lg-6">
                          <button type="button" class="btn btn-danger btn-block" id='confDeleteYes'>Ya</button>
                        </div>
                        <div class="col-lg-6">
                          <button type="button" class="btn btn-default btn-block" id='confDeleteNo' data-dismiss="modal">Tidak</button>
                        </div>
                    </div>
            </div>
            <br>

        </div>
    </div>
</div>
