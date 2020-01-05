@extends('layouts.default')
@section('title')
    {{$title}}
@endsection
@section('main')
  <div class="">
    <div class="row">
      <div class="x_panel">
        <div class="x_title">
          <h2>{{isset($share) ? 'Ubah Moments' : 'Tambah Momemts'}}</h2>
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
          <form id="" action="{{isset($share)? route('xshare.simpan',$share->id) : route('xshare.simpan')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
            <div class="col-md-3">
              <?php if (isset($share)): ?>
                <center>
                 <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">   
                        <?php if ($share->image==null): ?> 
                        <img src="{{asset('media/no_avatar.png')}}" alt="PMB STMIK Widya Utama" width="200" class="img-responsive" id="logo-img">
                        <?php else: ?>
                        <img src="{{url($share->foto)}}" alt="" width="200" class="img-responsive" id="logo-img">
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
              <label type ="" class="control-label col-md-3 col-sm-3 col-xs-12" for="id">Pengguna <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
               <select class='form-control' name='idname'>
               <?php foreach ($pengguna as $key => $value): ?>
                 <option value="{{$value->id}}" {{$penggunaterpilih==$value->id ? 'selected':''}}>{{$value->name}}</option>
               <?php endforeach ?>
               </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" id="title" name="title"  required="required" class="form-control col-md-7 col-xs-12" placeholder="title" required="required" value="{{isset($share)? $share->title : ''}}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Moment<p><i>*</i></p>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="file" id="image" name="image" class="form-control col-md-7 col-xs-12" {{isset($share)? '' : 'required'}}>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Konten <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <textarea class="form-control" name="content" id="content" required placeholder="Masukan Konten" rows="5">{{isset($share)? $share->content : ''}}</textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Status <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
               <select name="status" class="form-control">
                 <?php foreach ($status as $key => $value): ?>
                   <option value="{{$key}}" {{$statusterpilih==$key? 'selected':''}}> {{$value}}</option>
                 <?php endforeach ?>
               </select>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <a href="{{route('xshare.index')}}" class="btn btn-default">Batal</a>
                <button type="submit" class="btn btn-success">Simpan</button>
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
