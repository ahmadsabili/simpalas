@extends('layouts.main', [
    'title' => 'Daftar Kelas'
])

@push('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@include('admin.sidebar-item')

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Daftar Kelas</h1>
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
          <div class="card-header">
            <div class="float-right">
                  <a href="{{ route('classes.create') }}" onclick="add()" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp; Tambah Kelas</a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="classes-table">
                <thead>
                  <tr>
                    <th>No</th>
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
    $(document).ready( function () {
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('#classes-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('classes.index') }}",
        columns: [
          {data: null, sortable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
          { data: 'nama_kelas', name: 'nama_kelas' },
          {data: 'action', name: 'action', orderable: false},
        ],
        order: [[1, 'asc']]
      });

      $('body').on('click', '.delete', function () {
      if (confirm("HAPUS KELAS? Menghapus kelas akan menghapus seluruh data siswa yang ada pada kelas tersebut!") == true) {
      var id = $(this).data('id');

      // ajax
      $.ajax({
        type:"POST",
        url: "{{ url('delete-class') }}",
        data: { id: id},
        dataType: 'json',
        success: function(res){
          var oTable = $('#classes-table').dataTable();
          oTable.fnDraw(false);
          toastr.success("Kelas berhasil dihapus !")
        }
      });
      }
      });
    });
  </script>
  @include('components.alert')
@endsection