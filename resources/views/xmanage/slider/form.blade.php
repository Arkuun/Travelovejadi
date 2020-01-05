@extends('layouts.default')
@section('title')
    {{$title}}
@endsection
@section('main')
  <div class="">
    <div class="row">
      <div class="x_panel">
        <div class="x_title">
          <h2>{{isset($slider) ? 'Ubah Slider' : 'Tambah Slider'}}</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li style="float:right;"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
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
          <form action="{{isset($slider)? route('slider.simpan',$slider->id) : route('slider.simpan')}}" class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
             <div class="col-md-3">
              <center>
              <?php if (isset($slider)): ?>
                 <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">   
                        <?php if ($slider->image==null): ?> 
                        <img src="{{asset('media/no_avatar.png')}}" alt="" width="200" class="img-responsive" id="profile-img">
                        <?php else: ?>
                        <img src="{{$slider->image}}" alt="" width="200" class="img-responsive" id="profile-img">
                        <?php endif ?>
                    </div>
                  </div>
            <?php else :?>
              <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12"> 
                    <img src="{{asset('media/no_avatar.png')}}" alt="" width="200" class="img-responsive" id="profile-img">
                </div>
              </div>
            <?php endif ?>
            <h5 class="text-center">Slider</h5>
            </center>
            </div>
            <div class="col-md-9">
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Image {{isset($slider->image)? '':'*'}} </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="file" id="image" name="image" class="form-control col-md-7 col-xs-12" {{isset($slider->image)? '':'required'}}>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">Url Link</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="url" id="url" class="form-control" value="{{isset($slider)? $slider->url : ''}}">
              </div>
            </div>
            <div class="form-group">
              <label for="active" class="control-label col-md-3">Status</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" name="status" id="status" required>
                    <option value=''>Pilih Status</option>
                    <?php foreach ($status as $key => $value): ?>
                      <option value='{{$key}}'{{ $statusselected == $key ? 'selected=""' : '' }}>{{$value}}</option>
                    <?php endforeach ?>
                  </select>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-3">
                <a href="{{route('slider.index')}}" class="btn btn-primary">Batal</a>
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
    function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              
              reader.onload = function (e) {
                  $('#profile-img').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
          }
      }
      $("#image").change(function(){
          readURL(this);
      }); 
  </script>
@endpush











