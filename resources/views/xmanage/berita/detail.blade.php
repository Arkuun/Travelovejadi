@extends('layouts.default')
@section('title')
    {{$title}}
@endsection
@section('main')
  <div class="">
    <div class="row">
      <div class="x_panel">
        <div class="x_title">
          <h2>Detail Berita</h2>

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
              <?php if (isset($berita)): ?>
                <center>
                 <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">   

                        <?php if ($berita->image==null): ?> 
                        <img src="{{asset('media/no_avatar.png')}}" alt="" width="200" class="img-responsive" id="logo-img">
                        <?php else: ?>
                        <img src="{{url($berita->image)}}" alt="" width="200" class="img-responsive" id="logo-img">
                        <?php endif ?>
                    </div>
                  </div>
            <?php endif ?>
            </center>
            </div>
            <div class="col-md-9">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pengelola">Pengelola<span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">

                <input type="text" id="pengelola" name="pengelola"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Nama" required="required" value="{{$berita->user->name }}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kategori">Kategori Berita<span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">

                <input type="text" id="kategori" name="kategori"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Nama" required="required" value="{{$berita->kategori->name }}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Judul Berita <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="title" id="title" name="title"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Title" required="required" value="{{$berita->title}}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Isi Berita <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <textarea class="form-control" name="description" id="description" required placeholder="Masukan Deskripsi" rows="5">{{$berita->description}}</textarea>
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Slug <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="slug" name="slug"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Slug" required="required" value="{{$berita->slug}}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="view">View<span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="view" name="view"  required="required" class="form-control col-md-7 col-xs-12" placeholder="View" required="required" value="{{$berita->view}}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="love">Love<span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="love" name="love"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Love" required="required" value="{{$berita->love}}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tag">Tag<span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="tag" name="tag"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Tag" required="required" value="{{$berita->tag}}">
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <a href="{{route('xberita.index')}}" class="btn btn-default">Kembali</a>
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
