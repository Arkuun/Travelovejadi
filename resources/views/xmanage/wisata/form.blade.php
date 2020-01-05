@extends('layouts.default')
@section('title')
    {{$title}}
@endsection
@section('main')
  <div class="">
    <div class="row">
      <div class="x_panel">
        <div class="x_title">
          <h2>{{isset($wisata) ? 'Ubah wisata' : 'Tambah wisata'}}</h2>
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
          <form id="" action="{{isset($wisata)? route('xwisata.simpan',$wisata->id) : route('xwisata.simpan')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
            <div class="col-md-3">
              <?php if (isset($wisata)): ?>
                <center>
                 <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">   
                        <?php if ($wisata->image==null): ?> 
                        <img src="{{asset('media/no_avatar.png')}}" alt="PMB STMIK Widya Utama" width="200" class="img-responsive" id="logo-img">
                        <?php else: ?>
                        <img src="{{url($wisata->image)}}" alt="" width="200" class="img-responsive" id="logo-img">
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
            </center>
            </div>
            <div class="col-md-9">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama Wisata <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" id="name" name="name"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Nama" required="required" value="{{isset($wisata)? $wisata->name : ''}}">
              </div>
            </div>
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
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Foto<p><i>*</i></p>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="file" id="image" name="image" class="form-control col-md-7 col-xs-12" {{isset($wisata)? '' : 'required'}}>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="email" id="email" name="email"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Email" required="required" value="{{isset($wisata)? $wisata->email : ''}}">
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="long_titude">Long Titude <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="long_titude" name="long_titude"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Long Titude" required="required" value="{{isset($wisata)? $wisata->long_titude : ''}}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="late_titude">Late Titude <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="late_titude" name="late_titude"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Late Titude" required="required" value="{{isset($wisata)? $wisata->late_titude : ''}}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">No HP <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="phone" name="phone"  required="required" class="form-control col-md-7 col-xs-12" placeholder="No HP" required="required" value="{{isset($wisata)? $wisata->phone : ''}}">
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Alamat <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <textarea class="form-control" name="address" id="address" required placeholder="Masukan Alamat" rows="5">{{isset($wisata)? $wisata->address : ''}}</textarea>
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">URL <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="url" name="url"  required="required" class="form-control col-md-7 col-xs-12" placeholder="URL" required="required" value="{{isset($wisata)? $wisata->url : ''}}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="htm">Harga Tiket Masuk <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="htm" name="htm"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Harga Tiket Masuk" required="required" value="{{isset($wisata)? $wisata->htm : ''}}">
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Deskripsi <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <textarea class="form-control" name="description" id="description" required placeholder="Masukan Deskripsi" rows="5">{{isset($wisata)? $wisata->description : ''}}</textarea>
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
                <a href="{{route('xwisata.index')}}" class="btn btn-default">Batal</a>
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
