@extends('admin/admin_template')

@section('content')


    @if($sesi == 'Earthquakes Impacts' || $sesi == 'Help Status' || $sesi == 'Disaster Status')
    @else
<!--Info-->
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Info</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <!-- <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                <div class="box-body ">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                            <h3>{{ $dataCount or null }}</h3>
                            <p>Jumlah Data</p>
                            </div>
                            <div class="icon">
                            <i class="ion ion-ios-list-outline"></i>
                            </div>

                        </div>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer" >
                    <!--<button class="btn"  data-toggle="tooltip" title="Tambah" id="TambahTitik"><i class="fa fa-plus"></i> Tambah Titik</button>
                    <button class="btn"  id="CancelOnMap"><i class="fa fa-times"></i> Cancel</button>                                                                                -->
                </div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
    @endif

    @if($sesi == 'Earthquakes Impacts' || $sesi == 'Help Status' || $sesi == 'Disaster Status')
    @else
<!--Map-->
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Map</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <!-- <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>
                    <div class="box-body " id="map-canvas" >
                </div><!-- /.box-body -->
                <div class="box-footer" >
                    <button class="btn"  data-toggle="tooltip" title="Tambah" id="TambahTitik"><i class="fa fa-plus"></i> Tambah Titik</button>
                    <button class="btn"  id="CancelOnMap"><i class="fa fa-times"></i> Cancel</button>
                    <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                    <!-- <form action='gempa/getdetail' method='post'>
                      <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                      <input type='hide' name='id' value='2'>
                      <input type='submit'>
                    </form> -->
                    <!-- <button class="btn" data-toggle="modal" data-target="#modalConf"><i class="fa fa-times"></i> Tes</button>                                                                                       -->
                </div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
    @endif
<!-- Data-->
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Data</h3>
                    <button class="btn btn-xs btn-success"  data-toggle="tooltip" title="Tambah" id="tableAdd"><i class="fa fa-plus"></i></button>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body ">
                  <table class='table table-bordered'>
                    <thead>
                      <tr>
                      @foreach ($thead as $th)
                        <th>{{ $th }}</th>
                      @endforeach
                      </tr>
                    </thead>
                    @if($sesi == 'Earthquakes Impacts')
                    @foreach ($dataTable as $dt)
                    <tr>
                      <td>{{ $dt->mag_max }}</td>
                      <td>{{ $dt->mag_min }}</td>
                      <td>{{ $dt->deep_max }}</td>
                      <td>{{ $dt->deep_min }}</td>
                      <td>{{ $dt->impact_area }}</td>
                      <td>
                        <button class="tableUpdateBtn btn btn-xs btn-info " name='tableUpdateBtn{{ $dt->id }}' value="{{ $dt->id }}"><i class="fa fa-pencil-square-o"></i></button>
                        <button class="tableDeleteBtn btn btn-xs btn-danger"  name='tableDeleteBtn{{ $dt->id }}' value="{{ $dt->id }}"><i class="fa fa-times"></i></button>
                      </td>
                    </tr>
                    @endforeach
                    @endif

                    @if($sesi == "Help Status")
                    @foreach ($dataTable as $dt)
                    <tr>
                      <td>{{ $dt->name }}</td>
                      <td>
                        <button class="tableUpdateBtn btn btn-xs btn-info " name='tableUpdateBtn{{ $dt->id }}' value="{{ $dt->id }}"><i class="fa fa-pencil-square-o"></i></button>
                        <button class="tableDeleteBtn btn btn-xs btn-danger"  name='tableDeleteBtn{{ $dt->id }}' value="{{ $dt->id }}"><i class="fa fa-times"></i></button>
                      </td>
                    </tr>
                    @endforeach
                    @endif

                    @if($sesi == "Disaster Status")
                    @foreach ($dataTable as $dt)
                    <tr>
                      <td>{{ $dt->name }}</td>
                      <td>
                        <button class="tableUpdateBtn btn btn-xs btn-info " name='tableUpdateBtn{{ $dt->id }}' value="{{ $dt->id }}"><i class="fa fa-pencil-square-o"></i></button>
                        <button class="tableDeleteBtn btn btn-xs btn-danger"  name='tableDeleteBtn{{ $dt->id }}' value="{{ $dt->id }}"><i class="fa fa-times"></i></button>
                      </td>
                    </tr>
                    @endforeach
                    @endif

                    @if($sesi == "Earthquakes")
                    @foreach ($dataTable as $dt)
                    <tr>
                      <td>{{ $dt->mag }}</td>
                      <td>{{ $dt->deep }}</td>
                      <td>{{ $dt->date }}</td>
                      <td>{{ $dt->lat }}</td>
                      <td>{{ $dt->lng }}</td>
                      <td>
                        <button class=" btn btn-xs btn-info tableUpdateBtn" name='tableUpdateBtn{{ $dt->id }}' value="{{ $dt->id }}"><i class="fa fa-plus">  Add Disaster</i></button>
                      </td>
                    </tr>
                    @endforeach
                    @endif

                  </table>
                  <div class="pagination"> {{ $dataTable->links() }} </div>
                </div>
             </div><!-- /.box -->
         </div><!-- /.col -->
     </div><!-- /.row  -->
@endsection
