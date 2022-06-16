@extends('layouts.main', [
    'title' => 'Tagihan Buku'
])

@push('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@include('buku.sidebar-item')

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Status Pembayaran Buku</h1>
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
            <a href="{{ route('tagihan-buku.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-circle-left"></i> &nbsp; Kembali</a>
            <div class="float-right">
                <a href="{{ route('tagihan-buku.create', $siswa->nisn) }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> &nbsp; Tambah Tagihan</a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="status-table">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Judul Buku</th>
                    <th>Nominal</th>
                    <th>Tanggal Bayar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                      $i = 0
                  @endphp
                    @foreach ($tagihan  as $row)
                        <tr>
                          <td>{{ ++$i }}</td>
                          <td>{{ $row->siswa->nisn }}</td>
                          <td>{{ $row->siswa->nama }}</td>
                          <td>{{ $row->kelas }}</td>
                          <td>{{ $row->buku->judul }}</td>
                          <td>@currency($row->nominal)</td>
                          <td>{{ $row->tanggal_bayar }}</td>
                          <td>
                            @if ($row->status == 'Belum Dibayar')
                              <span class="badge bg-danger">BELUM DIBAYAR</span>
                            @else
                              <span class="badge bg-success">DIBAYAR</span>
                            @endif
                          </td>
                          <td>
                            <div class="d-flex">
                            @if ($row->status == 'Belum Dibayar')
                            <form action="{{ route('tagihan-buku.update', $row->id) }}" method="POST" class="mr-1">
                              @csrf
                              <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check-circle"></i>&nbsp; Bayar</button>
                          </form>
                            @endif
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>&nbsp; Hapus</button>
                          </div>
                          </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $(function () {
      $('#status-table').DataTable();
    });
    $(function () {
      $('#table').DataTable({
        "lengthMenu": [
                      [ 12, 24, 36, -1 ],
                      [ '12', '24', '36', 'All' ]
                  ],
      });
    });
  </script>
  @include('components.alert')
@endsection