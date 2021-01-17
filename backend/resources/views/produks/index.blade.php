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
            <h1 class="m-0 text-dark">Table Produk</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Produk</li>
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
              <h3 class="card-title">Produk Table</h3>
              <a href="{{route('exportproduk')}}" style="margin:5px;" type="button" class="btn btn-warning float-right"><i class="fas fa-file-download"></i> Export Data</a>
              <a style="margin:5px;" type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#Modalimport"><i class="fas fa-file-import"></i> Import Data</a>
              <button style="margin:5px;" type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Add item</button>
            </div>
            
            <!-- /.card-header -->
            <div class="card-body">
            <div class="table-responsive">
              <table class="table table-responsive" roles="cols">
                  <thead>
                  <tr>
                      <th style="width: 10px">#</th>
                      <th>Nama</th>
                      <th>Stok</th>
                      <!-- <th>Satuan</th> -->
                      <!-- <th>Kategori</th> -->
                      <th>Brand</th>
                      <th>Supplier</th>
                      <!-- <th>Harga Beli</th> -->
                      <th>Harga Jual</th>
                      <th>Diskon</th>
                      <th>Deskripsi</th>
                      <th>Gambar</th>
                      <th style="width: 40px">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($listProduk as $data)
                      <tr>
                          <td>{{ $data->id }}</td>
                          <td>{{ $data->name }}</td>
                          <td>{{ $data->stok }}</td>
                          <!-- <td>{{ $data->satuan }}</td> -->
                          <!-- <td>{{ $data->category }}</td> -->
                          <td>{{ $data->brand }}</td>
                          <td>{{ $data->supplier }}</td>
                          <!-- <td>{{ "Rp.".number_format($data->harga_beli) }}</td> -->
                          <td>{{ "Rp.".number_format($data->harga_jual) }}</td>
                          <td>{{ number_format($data->diskon)." %" }}</td>
                          <td>{{ $data->deskripsi }}</td>
                          <td>
                          <img src="{{ asset('storage/img_produk/'.$data->image) }}" width="75px" height="70px"/>
                          </td>
                          <td>
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <form name="myform" id="myform" style="display: inline;" action="{{route('produk.edit', $data->id)}}" method="get">
                                                    {{ method_field('DELETE') }}
                                                    @csrf
                                                    <button type="submit">
                                                        <i class="fa fa-edit blue"></i>
                                                    </button>
                                    </form>
                                </div>
                              </div>
                              <!-- <a href="{{route('produk.edit', $data->id)}}">
                                <i class="fa fa-edit blue"></i>
                              </a> -->
                              <!-- <a href="#">
                                  <i class="fa fa-trash red"></i>
                              </a> -->
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <form name="myform" id="myform" style="display: inline;" action="{{route('produk.destroy', $data->id)}}" method="post" onsubmit="return confirm('Are you sure you want to delete {{$data->name}}');">
                                                    {{ method_field('DELETE') }}
                                                    @csrf
                                                    <button type="submit">
                                                        <i class="fa fa-trash red"></i>
                                                    </button>
                                    </form>
                                </div>
                              </div>
                          </td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>
            </div>
            </div>
            <!-- /.card-body -->

          </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form method="POST" action="{{ route('produk.store') }}" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama" name="name">
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Stok</label>
                        <input type="text" class="form-control" placeholder="Stok ..." name="stok">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Pilih Satuan</label>
                        <select class="form-control" name="satuan">
                          <option value="-">-</option>
                          <option value="GROSS">GROSS</option>
                          <option value="GROSS">LUSIN</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Pilih Kategori</label>
                        <select class="form-control" name="category">
                        <option value="-">-</option>
                          <option value="Eye">Eye</option>
                          <option value="Make Up">Make Up</option>
                          <option value="Lipstick">Lipstick</option>
                          <option value="Skin Care">Skin Care</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Pilih Brand</label>
                        <select class="form-control" name="brand">
                        <option value="-">-</option>
                        
                          <option value="WARDAH">WARDAH</option>
                          <option value="MAYBELLINE">MAYBELLINE</option>
                          <option value="LOREAL MAKE UP">LOREAL MAKE UP</option>
                          <option value="Lipstick">DEX</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Pilih Supplier</label>
                        <select class="form-control" name="supplier">
                        <option value="-">-</option>
                          <option value="PT.Mensa Bina sukses">PT.Mensa Bina sukses</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Harga Beli</label>
                        <input type="text" class="form-control" placeholder="Harga Beli..." name="harga_beli">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Harga Jual</label>
                        <input type="text" class="form-control" placeholder="Harga Jual..." name="harga_jual">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Harga Diskon</label>
                        <input type="text" class="form-control" placeholder="Harga Diskon..." name="harga_sdiskon">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Diskon</label>
                        <input type="text" class="form-control" placeholder="Diskon..." name="diskon">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" rows="3" placeholder="Deskripsi ..." name="deskripsi"></textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">File Gambar</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
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

          <!-- Modal -->
          <div class="modal fade" id="Modalimport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Import Data Produk WM</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                  <form action="{{ route('importproduk') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">

                      {{ csrf_field() }}
                      <div class="form-group">
                        <input type="file" name="file" required="required" />
                      </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                  </form>
              </div>
            </div>
          </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
