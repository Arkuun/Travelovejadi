@extends('layouts.default')
@section('title')
    {{$title}}
@endsection
@section('main')
  <div class="">
    <div class="row">
      <div class="x_panel">
        <div class="x_title">
          <h2>Detail Wahana</h2>

          <ul class="nav navbar-right panel_toolbox">
            <li style="float: right;">
              <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <form id="" action="" class="form-horizontal">
            <div class="col-md-3">
              <?php if (isset($wahana)): ?>
                <center>
                 <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">   

                        <?php if ($wahana->image==null): ?> 
                        <img src="{{asset('media/no_avatar.png')}}" alt="" width="200" class="img-responsive" id="logo-img">
                        <?php else: ?>
                        <img src="{{url($wahana->image)}}" alt="" width="200" class="img-responsive" id="logo-img">
                        <?php endif ?>
                    </div>
                  </div>
            <?php endif ?>
            </center>
            </div>
            <div class="col-md-9">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama wahana<span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">

                <input disabled type="text" id="name" name="name"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Nama" required="required" value="{{$wahana->name }}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pengelola">Pengelola<span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">

                <input  disabled type="text" id="pengelola" name="pengelola"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Nama" required="required" value="{{$wahana->user->name }}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_wisata">Wisata <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input  disabled type="id_wisata" id="id_wisata" name="id_wisata"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Wisata" required="required" value="{{$wahana->id_wisata            = $wahana->id_wisata?$wahana->wisata->name:''}}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_kat_wahana">Kat. Wahana <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input  disabled type="text" id="id_kat_wahana" name="id_kat_wahana"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Kat. Wahana" required="required" value="{{$wahana->id_kat_wahana      = $wahana->kategoriwahana?$wahana->kategoriwahana->name:'' }}">
              </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="htm">Harga Tiket Masuk <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input  disabled type="text" id="htm" name="htm"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Harga Tiket Masuk" required="required" value="{{$wahana->htm}}">
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Deskripsi <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <textarea  disabled class="form-control" name="description" id="description" required placeholder="Masukan Deskripsi" rows="5">{{$wahana->description}}</textarea>
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Status <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="status" name="status"  required="required" class="form-control col-md-7 col-xs-12" placeholder="status" required="required" value="{{$wahana->status}}" disabled>
                  
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <a href="{{route('xwahana.index')}}" class="btn btn-default">Kembali</a>
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
