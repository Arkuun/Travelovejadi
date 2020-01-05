@extends('layouts.default')
@section('title')
    {{$title}}
@endsection
@section('main')
  <div class="">
    <div class="row">
      <div class="x_panel">
        <div class="x_title">
          <h2>Detail Event</h2>

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
              <?php if (isset($event)): ?>
                <center>
                 <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">   

                        <?php if ($event->image==null): ?> 
                        <img src="{{asset('media/no_avatar.png')}}" alt="" width="200" class="img-responsive" id="logo-img">
                        <?php else: ?>
                        <img src="{{url($event->image)}}" alt="" width="200" class="img-responsive" id="logo-img">
                        <?php endif ?>
                    </div>
                  </div>
            <?php endif ?>
            </center>
            </div>
            <div class="col-md-9">
            <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Wisata<span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">

                <input disabled type="text" id="name" name="name"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Nama" required="required" value="{{$wisata }}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama Event<span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">

                <input disabled type="text" id="name" name="name"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Nama" required="required" value="{{$event->nama }}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pengelola">Pengguna<span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">

                <input disabled type="text" id="pengguna" name="pengguna"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Nama" required="required" value="{{$event->user->name }}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Deskripsi <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <textarea class="form-control" name="description" id="description" disabled required placeholder="Masukan Deskripsi" rows="5">{{$event->description}}</textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date_start">Date Start <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input disabled type="text" id="date_start" name="date_start"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Date Start" required="required" value="{{$event->date_start }}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Date End">Date End <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input disabled type="text" id="date_end" name="date_end"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Date End" required="required" value="{{$event->date_end }}">
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tag">Tag <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input disabled type="text" id="tag" name="tag"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Tag" required="required" value="{{$event->tag}}">
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Slug <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input disabled type="text" id="slug_event" name="slug"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Slug" required="required" value="{{$event->slug_event}}">
                </div>
            </div>
                                    
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Status <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input disabled type="text" id="status" name="status"  required="required" class="form-control col-md-7 col-xs-12" placeholder="status" required="required" value="{{$status}}">
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <a href="{{route('xevent.index')}}" class="btn btn-default">Kembali</a>
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
