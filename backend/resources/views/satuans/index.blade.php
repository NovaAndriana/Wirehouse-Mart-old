@extends('layouts.wm')
@section('head')
    <link href="{{asset('/inpos/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
    <style class="css">
      button {
    background-color: Transparent;
    background-repeat:no-repeat;
    border: none;
    cursor:pointer;
    overflow: hidden;
    outline:none;
}
    
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #76a1da;
  color: white;
}
</style>
@endsection
@section('footer')
    <script src="{{asset('inpos/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('inpos/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('inpos/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('inpos/js/pages/tables/jquery-datatable.js')}}"></script>
@endsection
@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Satuan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Satuan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      @include('layouts.messages')
          <div class="card">

            <div class="card-header">
              <h3 class="card-title">Satuan Table</h3>
              <!-- <a href="{{route('exportproduk')}}" style="margin:5px;" type="button" class="btn btn-warning float-right"><i class="fas fa-file-download"></i> Export Data</a>
              <a style="margin:5px;" type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#Modalimport"><i class="fas fa-file-import"></i> Import Data</a> -->
              <button style="margin:5px;" type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Add item</button>
            </div>
            
            <!-- /.card-header -->
            <div class="card-body">
              <table cellspacing="10" width="100%" class="table table-bordered" roles="cols">
                  <thead>
                  <tr>
                      <th style="width: 10px">#</th>
                      <th>Nama</th>
                      <th>Keterangan</th>
                      <th style="width: 40px">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($listSatuan as $data)
                      <tr>
                          <td>{{ $data->id }}</td>
                          <td>{{ $data->name }}</td>
                          <td>{{ $data->keterangan }}</td>
                          <td>
                                  <a href="{{route('satuan.edit', $data->id)}}">
                                    <i class="fa fa-edit blue"></i>
                                  </a>
                                  <form name="myform" id="myform" style="display: inline;" action="{{route('satuan.destroy', $data->id)}}" method="post" onsubmit="return confirm('Are you sure you want to delete {{$data->name}}');">
                                                    {{ method_field('DELETE') }}
                                                    @csrf
                                                    <button type="submit">
                                                        <i class="fa fa-trash red"></i>
                                                    </button>
                                    </form>
                               
                          </td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>
            </div>
            <!-- /.card-body -->

          </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Satuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form method="POST" action="{{ route('satuan.store') }}" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" placeholder="Nama ..." name="name">
                  </div>
                  

                  <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" rows="3" placeholder="Keterangan ..." name="keterangan"></textarea>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
