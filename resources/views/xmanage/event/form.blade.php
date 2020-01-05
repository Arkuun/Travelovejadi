@extends('layouts.default')
@section('title')
    {{$title}}
@endsection
@section('main')
  <div class="">
    <div class="row">
      <div class="x_panel">
        <div class="x_title">
          <h2>{{isset($event) ? 'Ubah event' : 'Tambah event'}}</h2>
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
          <form id="" action="{{isset($event)? route('xevent.simpan',$event->id) : route('xevent.simpan')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
            <div class="col-md-3">
              <?php if (isset($event)): ?>
                <center>
                 <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">   
                        <?php if ($event->image==null): ?> 
                        <img src="{{asset('media/no_avatar.png')}}" alt="PMB STMIK Widya Utama" width="200" class="img-responsive" id="logo-img">
                        <?php else: ?>
                        <img src="{{url($event->image)}}" alt="" width="200" class="img-responsive" id="logo-img">
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
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Wisata<span class="required">*</span></label>
             <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="form-control" name="wisata">
                  <?php foreach ($wisata as $key => $value): ?>
                      <option value="{{$value->id}}" {{$namawisata==$value->id?'selected':''}}>{{$value->name}}</option>
                  <?php endforeach ?>
                </select>
             </div>
           </div>
           <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Pengguna<span class="required">*</span></label>
             <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="form-control" name="pengguna">
                 <?php foreach ($pengguna as $key => $value): ?>
                 <option value="{{$value->id}}" {{$penggunaterpilih==$value->id ? 'selected':''}}>{{$value->name}}</option>
                <?php endforeach ?>
                           </select>
                       </div>
           </div>
              <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama Event <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" id="nama" name="nama"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Nama Event" required="required" value="{{isset($event)? $event->nama : ''}}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Image<p><i>*</i></p>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="file" id="image" name="image" class="form-control col-md-7 col-xs-12" {{isset($event)? '' : 'required'}}>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Deskripsi <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <textarea class="form-control" name="description" id="editor1" required placeholder="Masukan Deskripsi" rows="5">{{isset($event)? $event->description : ''}}</textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date">Date Start <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="date" id="date_start" name="date_start"  required="required" class="form-control col-md-7 col-xs-12" placeholder="date_start" required="required" value="{{isset($event)? $event->date_start : ''}}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date">Date End <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="date" id="date_end" name="date_end"  required="required" class="form-control col-md-7 col-xs-12" placeholder="date_end" required="required" value="{{isset($event)? $event->date_end : ''}}">
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tag">Tag<span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="tag" name="tag"  required="required" class="form-control col-md-7 col-xs-12" placeholder="Tag" required="required" value="{{isset($event)? $event->tag : ''}}">
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status <span class="required">*</span>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
               <select class="form-control" name="status" id="status" required>
              <?php foreach ($status as $key => $value): ?>
              <option value="{{$key}}" {{$statusterpilih==$key? 'selected':''}}> {{$value}}</option>
              <?php endforeach ?>
               </select>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{route('xevent.index')}}" class="btn btn-default">Batal</a>
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
