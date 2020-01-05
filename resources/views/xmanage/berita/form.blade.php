@extends('layouts.default')
@section('title')
    {{$title}}
@endsection
@section('main')
  <div class="">
    <div class="row">
      <div class="x_panel">
        <div class="x_title">
          <h2>{{isset($berita) ? 'Ubah berita' : 'Tambah Berita'}}</h2>
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
          <form id="" action="{{isset($berita)? route('xberita.simpan',$berita->id) : route('xberita.simpan')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
            <div class="col-md-3">
             
            </div>
            <div class="col-md-12">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <?php if (isset($berita)): ?>
                 <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">   
                        <?php if ($berita->image==null): ?> 
                        <img src="{{asset('media/no_avatar.png')}}" alt="PMB STMIK Widya Utama" width="200" class="img-responsive" id="logo-img">
                        <?php else: ?>
                        <img src="{{url($berita->image)}}" alt="" width="200" class="img-responsive" id="logo-img">
                        <?php endif ?>
                    </div>
                  </div>
            <?php else :?>
              <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12"> 
                    <img src="{{asset('media/no_avatar.png')}}" alt="" width="200" class="img-responsive" id="logo-img">
                </div>
              </div>
            <?php endif ?>
           <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pengelola">Nama Pengelola <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select name="pengelola" class="form-control">
                  <?php foreach ($pengelola as $key => $value): ?>
                      <option value="{{$value->id}}" {{$namapengelola==$value->id?'selected':''}}>{{$value->name}}</option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="katpilih">Kategori Berita <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select name="katpilih" class="form-control">
                  <?php foreach ($katpilih as $key => $value): ?>
                      <option value="{{$value->id}}" {{$namakat==$value->id?'selected':''}}>{{$value->name}}</option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Foto<p><i>*</i></p>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="file" id="image" name="image" class="form-control col-md-7 col-xs-12" {{isset($berita)? '' : 'required'}}>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Judul Berita<span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="title" id="title" name="title"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Judul Berita" required="required" value="{{isset($berita)? $berita->title : ''}}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Isi Berita <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <textarea class="form-control" name="description" id="editor1" required placeholder="Masukan Isi Berita" rows="5">{{isset($berita)? $berita->description : ''}}</textarea>
              </div>
            </div>
            <div class="control-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Input tag</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="tag" id="tags_1" type="text" class="tags form-control" value="{{isset($berita)? $berita->tag : ''}}" />
                          <div id=tag"suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                        </div>
                      </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{route('xberita.index')}}" class="btn btn-default">Batal</a>
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
<script type="text/javascript">

      $(document).ready(function(){
            
      }); 
       function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              
              reader.onload = function (e) {
                  $('#logo-img').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
          }
      }
      $("#image").change(function(){
          readURL(this);
      });  
</script>
@endpush
