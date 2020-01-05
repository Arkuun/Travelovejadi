@extends('layouts.default')
@section('title')
    {{$title}}
@endsection
@section('main')
  <div class="">
    <div class="row">
      <div class="x_panel">
        <div class="x_title">
          <h2>Detail Pengguna</h2>
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
              <?php if (isset($pengguna)): ?>
                <center>
                 <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">   
                        <?php if ($pengguna->foto==null): ?> 
                        <img src="{{asset('media/no_avatar.png')}}" alt="PMB STMIK Widya Utama" width="200" class="img-responsive" id="logo-img">
                        <?php else: ?>
                        <img src="{{url($pengguna->foto)}}" alt="" width="200" class="img-responsive" id="logo-img">
                        <?php endif ?>
                    </div>
                  </div>
            <?php endif ?>
            </center>
            </div>
            <div class="col-md-9">
              
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" id="name" name="name"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Nama" required="required" value="{{$pengguna->name }}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="email" id="email" name="email"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Email" required="required" value="{{$pengguna->email}}">
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nohp">No HP <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="no_hp" name="no_hp"  required="required" class="form-control col-md-7 col-xs-12" placeholder="No HP" required="required" value="{{$pengguna->no_hp}}">
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <textarea class="form-control" name="alamat" id="alamat" required placeholder="Masukan Alamat" rows="5">{{$pengguna->alamat}}</textarea>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <a href="{{route('xpengguna.index')}}" class="btn btn-default">Kembali</a>
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
