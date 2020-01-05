@extends('layouts.default')
@section('title')
    {{$title}}
@endsection
@section('main')
  <div class="">
    <div class="row">
      <div class="x_panel">
        <div class="x_title">
          <h2>Detail Wisata</h2>

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
              <?php if (isset($wisata)): ?>
                <center>
                 <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">   

                        <?php if ($wisata->image==null): ?> 
                        <img src="{{asset('media/no_avatar.png')}}" alt="" width="200" class="img-responsive" id="logo-img">
                        <?php else: ?>
                        <img src="{{url($wisata->image)}}" alt="" width="200" class="img-responsive" id="logo-img">
                        <?php endif ?>
                    </div>
                  </div>
            <?php endif ?>
            </center>
            </div>
            <div class="col-md-9">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama Wisata<span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">

                <input type="text" id="name" name="name"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Nama" required="required" value="{{$wisata->name }}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pengelola">Pengelola<span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">

                <input type="text" id="pengelola" name="pengelola"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Nama" required="required" value="{{$wisata->user->name }}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="email" id="email" name="email"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Email" required="required" value="{{$wisata->email}}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="long_titude">Long Titude <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" id="long_titude" name="long_titude"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Long Titude" required="required" value="{{$wisata->long_titude }}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="late_titude">Late Titude <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" id="late_titude" name="late_titude"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Late Titude" required="required" value="{{$wisata->late_titude }}">
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">No HP <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="phone" name="phone"  required="required" class="form-control col-md-7 col-xs-12" placeholder="No HP" required="required" value="{{$wisata->phone}}">
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Alamat <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <textarea class="form-control" name="address" id="address" required placeholder="Masukan Alamat" rows="5">{{$wisata->address}}</textarea>
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Slug <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="slug" name="slug"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Slug" required="required" value="{{$wisata->slug}}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">URL <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="url" name="url"  required="required" class="form-control col-md-7 col-xs-12" placeholder="URL" required="required" value="{{$wisata->url}}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="htm">Harga Tiket Masuk <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="htm" name="htm"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Harga Tiket Masuk" required="required" value="{{$wisata->htm}}">
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Deskripsi <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <textarea class="form-control" name="description" id="description" required placeholder="Masukan Deskripsi" rows="5">{{$wisata->description}}</textarea>
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Status <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="status" name="status"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Status" required="required" value="{{$status}}">
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <a href="{{route('xwisata.index')}}" class="btn btn-default">Kembali</a>
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
