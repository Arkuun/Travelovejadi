@extends('layouts.default')
@section('title')
    {{$title}}
@endsection
@section('main')
  <div class="">
    <div class="row">
      <div class="x_panel">
        <div class="x_title">
          <h2>{{isset($kategori) ? 'Ubah Kategori Wahana' : 'Tambah Kategori Wahana'}}</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li style="float: right;">
              <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          @if(session('message'))
          <div class="alert alert-{{session('message')['status']}}">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{ session('message')['info'] }}
          </div>
          @endif
          <form id="" action="{{isset($kategori)? route('xkategoriwahana.simpan',$kategori->id) : route('xkategoriwahana.simpan')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
            
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-md-12">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" id="name" name="name"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Nama" required="required" value="{{isset($kategori)? $kategori->name : ''}}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Status <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select name="status" class="form-control">
                  <?php foreach ($status as $key => $value): ?>
                      <option value="{{$key}}" {{$statusterpilih==$key?'selected':''}}>{{$value}}</option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{route('xkategoriwahana.index')}}" class="btn btn-default">Batal</a>
              </div>
            </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('js')
@endpush
