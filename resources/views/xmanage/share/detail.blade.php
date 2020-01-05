@extends('layouts.default')
@section('title')
    {{$title}}
@endsection
@section('main')
  <div class="">
    <div class="row">
      <div class="x_panel">
        <div class="x_title">
          <h2>Detail moments</h2>
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
              <?php if (isset($share)): ?>
                <center>
                 <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">   
                        <?php if ($share->foto==null): ?> 
                        <img src="{{asset('media/no_avatar.png')}}" alt="PMB STMIK Widya Utama" width="200" class="img-responsive" id="logo-img">
                        <?php else: ?>
                        <img src="{{url($share->foto)}}" alt="" width="200" class="img-responsive" id="logo-img">
                        <?php endif ?>
                    </div>
                  </div>
            <?php endif ?>
            </center>
            </div>
            <div class="col-md-9">
              
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">Pengguna <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" id="id" name="id"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Nama" required="required" value="{{$share->user->name }}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" id="title" name="title"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Nama" required="required" value="{{$share->title }}">
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Konten <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <textarea class="form-control" name="content" id="content" required placeholder="Masukan Konten" rows="5">{{$share->content}}</textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">Status <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" id="Status" name="Status"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Status" required="required" value="{{$status}}">
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <a href="{{route('xshare.index')}}" class="btn btn-default">Kembali</a>
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
