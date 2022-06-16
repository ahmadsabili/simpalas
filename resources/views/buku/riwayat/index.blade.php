@extends('layouts.main', [
    'title' => 'Riwayat Pembayaran Buku'
])

@push('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@include('buku.sidebar-item')

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Riwayat Pembayaran Buku</h1>
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