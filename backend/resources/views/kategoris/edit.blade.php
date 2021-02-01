@extends('layouts.wm')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Table Kategori</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Kategori</li>
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
              <h3 class="card-title">Kategori Table</h3>
              <a href="{{ route('kategori.index') }}" style="margin:5px;" type="button" class="btn btn-info float-right"><i class="fas fa-plus"></i> Add item</a>
            </div>
            
            <form method="POST" action="{{ route('kategori.update', $kategori->id) }}" role="form" enctype="multipart/form-data">
            {{method_field('PUT')}}
                @csrf
                <div class="modal-body">
                  <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" class="form-control" id="name" placeholder="Nama Kategori ..." name="name" value="{{$kategori->name}}">
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
                      <img src="{{ asset ('uploads/'.$kategori->image) }}" width="100px" height="95px"/>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="modal-footer">
                  <input type="hidden" name="id" id="id">
                  <a href="{{ route('kategori.index') }}" type="button" class="btn btn-secondary">Close</a>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            

          </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
