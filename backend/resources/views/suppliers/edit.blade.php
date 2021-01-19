@extends('layouts.wm')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Table Supplier</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Supplier</li>
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
              <h3 class="card-title">Supplier Table</h3>
              <button style="margin:5px;" type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Add item</button>
            </div>
            
            <form method="POST" action="{{ route('supplier.update', $supplier->id) }}" role="form">
            {{method_field('PUT')}}
                @csrf
                <div class="modal-body">
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" id="name" placeholder="Nama" name="name" value="{{$supplier->name}}">
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Contact Person</label>
                        <input type="text" class="form-control" placeholder="Contact Person ..." name="contact_person" id="contact_person" value="{{$supplier->contact_person}}">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" placeholder="Email..." name="email" value="{{$supplier->email}}" >
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>No Telp</label>
                        <input type="text" class="form-control" placeholder="No Telp..." name="no_telp" value="{{$supplier->no_telp}}">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" rows="3" placeholder="Alamat ..." name="alamat">{{$supplier->alamat}}</textarea>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="modal-footer">
                  <input type="hidden" name="id" id="id">
                  <a href="{{ route('supplier.index') }}" type="button" class="btn btn-secondary">Close</a>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            

          </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
