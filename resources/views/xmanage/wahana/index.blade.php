@extends('layouts.default')
@section('title')
    {{$title}}
@endsection
@section('main')
  <div class="">
    <div class="row">
      <div class="x_panel">
        <div class="x_title">
          <h2>Daftar Wahana</h2>
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
          <p><a href="{{route('xwahana.tambah')}}" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</a></p>
          <table id="table1" class="table table-bordered">
            <thead>
              <tr>
                <th width="5">#</th>
                <th>Nama Pengelola</th>
                <th>Wisata</th>
                <th>Nama</th>
                <th>K. Wahana</th>
                <th class="text-center">AKSI</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  

                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                          <h4>Sorry vrooh</h4>
                          <p>Smentara menu edit nya di pending.</p>
                          <p>lagi main tenis dulu :'v.</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                        </div>

                      </div>
                    </div>
                  </div>
@endsection
@push('js')
  <script type="text/javascript">
      var table;
      $(document).ready(function(){
          table= $('#table1').DataTable({
          "processing": true,
          "serverSide": true,
          "pageLength": 25,
          "ajax":{
                   "url": "{{ route("xwahana.getdata") }}",
                   "dataType": "json",
                   "type": "POST",
                   "data":{ _token: "{{csrf_token()}}"}
                 },
          "columns": [
              { "data": "no" },
              { "data": "namauser" },
              { "data": "id_wisata" },
              { "data": "name" },
              { "data": "id_kat_wahana" },
              { "data" : "action",
                "orderable" : false,
                "className" : "text-center",
              },
          ],
          responsive: true,
          language: {
              search: "_INPUT_",
              searchPlaceholder: "Pencarian Data",
          }
        });
      });
      function deletewahana(e,id){
        var token = '{{ csrf_token() }}';
        swal({
          title: "Apakah Anda yakin?",
          text: "Data akan terhapus!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Ya, hapus data!",
          confirmButtonColor: "#ec6c62",
          closeOnConfirm: false
        },
        function(){
          $.ajaxSetup({
            headers: { "X-CSRF-Token" : $("meta[name=csrf-token]").attr("content") }
          });
          $.ajax({
            type: 'DELETE',
            url: '{{route("xwahana.hapus",[null])}}/' + id,
            headers: {'X-CSRF-TOKEN': token},
            success: function(data){
              console.log(data);
              swal('Yes','Data Berhasil dihapus','success');
                table.ajax.reload(null, true);
            },
            error: function(data){
              console.log(data);
              swal("Ups!", "Terjadi kesalahan pada sistem.", "error");
            }
          });
        });
      }
  </script>
@endpush
