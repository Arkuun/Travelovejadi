@extends('layouts.default')
@section('title')
    {{$title}}
@endsection
@push('css')
<link href="{{ asset('assets/xbackend/css/rowReorder.dataTables.min.css')}}" rel="stylesheet">
@endpush
@section('main')
  <div class="">
    <div class="row">
      <div class="x_panel">
        <div class="x_title">
          <h2>Daftar Slider</h2>
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
          <p><a href="{{route('slider.tambah')}}" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Slider</a></p>
          <table id="table1" class="table table-striped">
                <thead>
                    <tr>
                        <th width="4">No</th>
                        <th>Media</th>
                        <th>Url</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($slider as $key=>$var)
                    <tr data-id="{{$var->id}}">
                      <td>{{$loop->iteration}}</td>
                      <td> 
                            <img src="{{$var->image}}" class="img-responsive" width="100px">
                      </td>
                      <?php if ($var->url!=null): ?>
                        <td class="text-success"><i class="fa fa-check"></i></td>
                      <?php else: ?>
                        <td class="text-danger"><i class="fa fa-close"></i></td>
                      <?php endif; ?>
                      <td>{{$var->status=='1'?'Aktif':'Tidak Aktif'}}</td>
                      <td>
                          
                          <a href="{{route('slider.ubah',$var->id)}}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> Ubah</a>
                          
                           <a href="#" title="delete" onclick="deleteSlider(this,{{$var->id}})"  class=" btn btn-danger btn-xs text-danger swal-delete"><i class="fa fa-trash"></i> Hapus</a>
                          
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('js')
    <script src="{{ asset('assets/xbackend/js/dataTables.rowReorder.min.js')}}"></script>
    <script>
        var table;
         $(document).ready(function() {
         table = $('#table1').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "rowReorder": true,
            "language": {
                    "decimal":        "",
                    "emptyTable":     "Tidak ada data yang tersedia di tabel",
                    "info":           "Menampilkan _START_ sampai _END_ dari _TOTAL_ masukan",
                    "infoEmpty":      "Menampilkan 0 to 0 of 0 masukan",
                    "infoFiltered":   "(filtered from _MAX_ total entries)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "Menampilkan _MENU_ masukan",
                    "loadingRecords": "Memuat...",
                    "processing":     "Sedang diproses...",
                    "search":         "Pencarian:",
                    "zeroRecords":    "Arsip tidak ditemukan",
                    "paginate": {
                        "first":      "Pertama",
                        "last":       "Terakhir",
                        "next":       "Lanjut",
                        "previous":   "Kembali"
                    },
                    "aria": {
                        "sortAscending":  ": Aktifkan urutan kolom ascending",
                        "sortDescending": ": Aktifkan urutan kolom descending"
                    }

                }
          });
         @if(count($slider) > 0 )
             table.on( 'row-reorder', function ( e, diff, edit ) {
             var urutan = [];
              for ( var i=0, ien=diff.length ; i<ien ; i++ ) {
                urutan[i] = {
                 id: $(diff[i].node).data('id'),
                 sort: diff[i].newPosition+1,
                };
              }
              $.ajax({
                      url: "{{route('slider.sorting',$var->id)}}",
                      method: "GET",
                      data: { "sorting" : urutan },
                      dataType: "json",
                      success: function(data) {},
                      error: function(data) {}
                 });
          } );
          @endif
         $('body .dropdown-toggle').dropdown();
         $('[data-toggle="tooltip"]').tooltip();
         $('#table1')
             .on('draw.dt',function() {
                $('[data-toggle="tooltip"]').tooltip();})
            .DataTable();
        });
        function deleteSlider(e,id){
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
            url: '{{route("slider.hapus",[null])}}/' + id,
            headers: {'X-CSRF-TOKEN': token},
            success: function(data){
                swal('Yes','Data Berhasil dihapus','success');
                window.location = "{{route('slider.index')}}";   
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











