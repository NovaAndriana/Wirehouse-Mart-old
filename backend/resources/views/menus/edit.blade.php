@extends('layouts.wm')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Table Menu</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Menu</li>
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
              <h3 class="card-title">Menu Table</h3>
              <a href="{{ route('menu.index') }}" style="margin:5px;" type="button" class="btn btn-info float-right"><i class="fas fa-plus"></i> Add item</a>
            </div>
            
            <form method="POST" action="{{ route('menu.update', $menu->id) }}" role="form" enctype="multipart/form-data">
            {{method_field('PUT')}}
                @csrf
                <div class="modal-body">
                  <div class="form-group">
                    <label>Nama Menu</label>
                    <input type="text" class="form-control" id="name" placeholder="Nama" name="name" value="{{$menu->name}}">
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputFile">File Icon Menu</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="image" name="image">
                          <input name="hidden_image" type="hidden" value="{{$menu->image}}" /> 
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="div col-sm-6">
                    <div class="form-group">
                      <img src="{{ asset ('uploads/'.$menu->image) }}" width="100px" height="95px"/>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="modal-footer">
                  <input type="hidden" name="id" id="id">
                  <a href="{{ route('menu.index') }}" type="button" class="btn btn-secondary">Close</a>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            

          </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
