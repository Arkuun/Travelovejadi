@extends('layouts.default')
@section('title')
    {{$title}}
@endsection
@section('main')
  <div class="">
    <div class="row">
      <div class="x_panel">
        <div class="x_title">
          <h2>Daftar Admin</h2>
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
          <p><a href="{{route('xadmin.tambah')}}" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</a></p>
          <table id="table1" class="table table-bordered">
            <thead>
              <tr>
                <th width="5">#</th>
                <th>Photo</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No HP</th>
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
                   "url": "{{ route("xadmin.getdata") }}",
                   "dataType": "json",
                   "type": "POST",
                   "data":{ _token: "{{csrf_token()}}"}
                 },
          "columns": [
              { "data": "no" },
              { "data": "foto" },
              { "data": "name" },
              { "data": "email" },
              { "data": "no_hp" },
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
      function deleteadmin(e,id){
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
            url: '{{route("xadmin.hapus",[null])}}/' + id,
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
