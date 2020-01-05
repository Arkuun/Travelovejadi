@extends('layouts.default')
@section('title')
    {{$title}}
@endsection
@section('main')
  <div class="">
    <div class="row">
      <div class="x_panel">
        <div class="x_title">
          <h2>{{isset($pengguna) ? 'Ubah Pengguna' : 'Tambah Pengguna'}}</h2>
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
          <form id="" action="{{isset($pengguna)? route('xpengguna.simpan',$pengguna->id) : route('xpengguna.simpan')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
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
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" id="name" name="name"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Nama" required="required" value="{{isset($pengguna)? $pengguna->name : ''}}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nohp">Foto<p><i>*</i></p>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="file" id="foto" name="foto" class="form-control col-md-7 col-xs-12" {{isset($pengguna)? '' : 'required'}}>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="email" id="email" name="email"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Email" required="required" value="{{isset($pengguna)? $pengguna->email : ''}}">
              </div>
            </div>
            <?php if (!isset($pengguna)): ?>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="password" id="password" name="password"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Password" required="required" value="">
                </div>
              </div>
            <?php endif ?>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nohp">No HP <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="no_hp" name="no_hp"  required="required" class="form-control col-md-7 col-xs-12" placeholder="No HP" required="required" value="{{isset($pengguna)? $pengguna->no_hp : ''}}">
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <textarea class="form-control" name="alamat" id="alamat" required placeholder="Masukan Alamat" rows="5">{{isset($pengguna)? $pengguna->alamat : ''}}</textarea>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{route('xpengguna.index')}}" class="btn btn-default">Batal</a>
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
      $("#foto").change(function(){
          readURL(this);
      });  
</script>
@endpush
