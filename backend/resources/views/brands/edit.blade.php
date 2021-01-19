@extends('layouts.wm')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Table Brand</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Brand</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    

      @include('layouts.messages')
          <div class="card">

            <div class="card-header">
              <h3 class="card-title">Brand Table</h3>
              <a href="{{ route('brand.index') }}" style="margin:5px;" type="button" class="btn btn-info float-right"><i class="fas fa-plus"></i> Add item</a>
            </div>
            
            <form method="POST" action="{{ route('brand.update', $brand->id) }}" role="form">
            {{method_field('PUT')}}
                @csrf
                <div class="modal-body">
                  <div class="form-group">
                    <label>Nama Brand</label>
                    <input type="text" class="form-control" id="brand_name" placeholder="Nama" name="brand_name" value="{{$brand->brand_name}}">
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Populer</label>
                        <select class="form-control" name="is_populer">
                          <option value="0">-</option>
                          <option value="1">YA</option>
                          <option value="0">TIDAK</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6">
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
                  <div class="div col-sm-6">
                    <div class="form-group">
                      <img src="{{ asset ('uploads/'.$brand->image) }}" width="100px" height="95px"/>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="modal-footer">
                  <input type="hidden" name="id" id="id">
                  <a href="{{ route('brand.index') }}" type="button" class="btn btn-secondary">Close</a>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            

          </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
