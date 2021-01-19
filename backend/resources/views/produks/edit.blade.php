@extends('layouts.wm')

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
    

      @include('layouts.messages')
          <div class="card">

            <div class="card-header">
              <h3 class="card-title">Produk Table</h3>
              <button style="margin:5px;" type="button" class="btn btn-warning float-right" data-toggle="modal" data-target="#"><i class="fas fa-file-download"></i> Export Data</button>
              <button style="margin:5px;" type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#"><i class="fas fa-file-import"></i> Import Data</button>
              <button style="margin:5px;" type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Add item</button>
            </div>
            
            <form method="POST" action="{{ route('produk.update', $produk->id) }}" role="form" enctype="multipart/form-data">
            {{method_field('PUT')}}
                @csrf
                <div class="modal-body">
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" id="name" placeholder="Nama" name="name" value="{{$produk->name}}">
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Stok</label>
                        <input type="text" class="form-control" placeholder="Stok ..." name="stok" id="stok" value="{{$produk->stok}}">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Pilih Satuan</label>
                        <select class="form-control" name="satuan">
                          <!-- <option value="{{$produk->satuan}}">{{$produk->satuan}}</option>
                          <option value="GROSS">GROSS</option>
                          <option value="GROSS">LUSIN</option> -->
                          @foreach ($satuans as $satuan)
                          <option 
                            value="{{ $produk->satuan }}"
                              @if ($satuan->name === $produk->satuan)
                                selected
                              @endif
                            >
                            {{$satuan->name}}
                          </option>
                        @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Pilih Kategori</label>
                        <select class="form-control" name="category">
                        <option value="{{$produk->category}}">{{$produk->category}}</option>
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
                        @foreach ($brands as $brand)
                          <option 
                            value="{{ $produk->brand }}"
                              @if ($brand->brand_name === $produk->brand)
                                selected
                              @endif
                            >
                            {{$brand->brand_name}}
                          </option>
                        @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Pilih Supplier</label>
                        <select class="form-control" name="supplier">
                        @foreach ($suppliers as $supplier)
                          <option 
                            value="{{ $produk->supplier }}"
                              @if ($supplier->name === $produk->supplier)
                                selected
                              @endif
                            >
                            {{$supplier->name}}
                          </option>
                        @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Harga Beli</label>
                        <input type="text" class="form-control" placeholder="Harga Beli..." name="harga_beli" value="{{$produk->harga_beli}}">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Harga Jual</label>
                        <input type="text" class="form-control" placeholder="Harga Jual..." name="harga_jual" value="{{$produk->harga_jual}}">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Harga Diskon</label>
                        <input type="text" class="form-control" placeholder="Harga Jual..." name="harga_sdiskon" value="{{$produk->harga_sdiskon}}">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Diskon</label>
                        <input type="text" class="form-control" placeholder="Diskon..." name="diskon" value="{{$produk->diskon}}">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" rows="3" placeholder="Deskripsi ..." name="deskripsi">{{$produk->deskripsi}}</textarea>
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
                      <img src="{{ asset ('uploads/'.$produk->image) }}" width="100px" height="95px"/>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="modal-footer">
                  <input type="hidden" name="id" id="id">
                  <a href="{{ route('produk.index') }}" type="button" class="btn btn-secondary">Close</a>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            

          </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
