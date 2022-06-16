@extends('layouts.main', [
    'title' => 'Daftar Siswa'
])

@push('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@include('spp.sidebar-item')

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Daftar Siswa</h1>
      </div>
    </div>
  </div>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="students-table">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $(function () {
        var table = $('#students-table').DataTable({
          "lengthMenu": [
                      [ 10, 25, 50, 100, -1 ],
                      [ '10', '25', '50', '100', 'All' ]
            ],
            processing: true,
            serverSide: true,
            ajax: "{{ route('spp.pembayaran.index') }}", 	
            order: [ 1, 'asc' ],
            columns: [
              {data: null, sortable: false,
                  render: function (data, type, row, meta) {
                      return meta.row + meta.settings._iDisplayStart + 1;
                  }
              },
                {data: 'nisn', name: 'nisn'},
                {data: 'nama', name: 'nama'},
                {data: 'kelas.nama_kelas', name: 'kelas.nama_kelas'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
      });

      $('body').on('click', '.delete', function () {
        if (confirm("Hapus siswa?") == true) {
          var id = $(this).data('id');
          // ajax
          $.ajax({
            type:"POST",
            url: "{{ url('delete-student') }}",
            data: { id: id},
            dataType: 'json',
            success: function(res){
              var oTable = $('#students-table').dataTable();
              oTable.fnDraw(false);
              toastr.success("Siswa berhasil dihapus !")
            }
          });
        }
      });
    });
  </script>
  @include('components.alert')
@endsection