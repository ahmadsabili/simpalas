@extends('layouts.main', [
    'title' => 'Tambah Tagihan Buku'
])

@push('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@include('buku.sidebar-item')

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Tambah Tagihan Buku</h1>
      </div>
    </div>
  </div>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-4">
        <div class="card">
          <div class="card-header bg-secondary">
            <h5>
              Tagihan yang sudah ada
            </h5>
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <th>No</th>
                <th>Judul</th>
                <th>Harga</th>
              </thead>
              <tbody>
                @php
                  $i = 0;
                @endphp
                @foreach ($items as $item)
                  <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $item->buku->judul }}</td>
                    <td>@currency($item->nominal)</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-8">
        <div class="card">
          <form action="{{ route('tagihan-buku.store') }}" method="POST">
            @csrf
            <div class="card-header">
              <a href="{{ url()->previous() }}" class="btn btn-sm btn-danger">
                <i class="fas fa-window-close"></i>&nbsp; Batalkan
              </a>
            </div>
            <div class="card-body">
              @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button>	
                  {{ $message }}
                </div>
              @endif
              <div class="row">
                <input type="hidden" name="id_siswa" value="{{ $siswa->id }}">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>NISN</label>
                      <input type="text" class="form-control" value="{{ $siswa->nisn }}" readonly>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Nama Siswa</label>
                      <input type="text" class="form-control" name="nama_siswa" value="{{ $siswa->nama }}" readonly>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Kelas</label>
                      <input type="text" class="form-control" name="kelas" value="{{ $siswa->kelas->nama_kelas }}" readonly>
                      @php
                          $kelas = explode(' ', $siswa->kelas->nama_kelas);
                      @endphp
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm table-bordered" id="books-table">
                            <thead>
                                <th>
                                    <input id="checkall" class='' type="checkbox" name="id_buku[]">
                                    <label class="form-check-label" for="checkall">
                                        Pilih semua
                                    </label>
                                </th>
                                <th>Kelas</th>
                                <th>Judul</th>
                                <th>Harga</th>
                            </thead>
                            <tbody>
                                @foreach ($buku as $book)
                                <tr>
                                    <td>
                                        <input type="checkbox" value="{{ $book->id }}" class="checkboxes" name="id_buku[]">
                                    </td>
                                    <td>{{ $book->kelas }}</td>
                                    <td>{{ $book->judul }}</td>
                                    <td>
                                      <input type="hidden" name="harga" value="{{ $book->harga }}">
                                      @currency($book->harga)
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp; Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ url('/plugins/select2/js/select2.full.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() {
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $('#books-table').DataTable({
            "lengthMenu": [
                      [-1 ],
                      [ 'All' ]
                  ],
        });
  });
  $("#checkall").click(function (){
     if ($("#checkall").is(':checked')){
        $(".checkboxes").each(function (){
           $(this).prop("checked", true);
           });
        }else{
           $(".checkboxes").each(function (){
                $(this).prop("checked", false);
           });
        }
 });
</script>
@endsection