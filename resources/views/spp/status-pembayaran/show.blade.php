@extends('layouts.main', [
    'title' => 'Status Pembayaran'
])

@push('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@include('spp.sidebar-item')

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Status Pembayaran</h1>
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
            <a href="{{ route('spp.status.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-circle-left"></i> &nbsp; Kembali</a>
          </div>
          <div class="card-body">
            @if ($pembayaran->count() > 0)
            <div class="table-responsive">
              <table class="table table-bordered" id="status-table">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Tanggal Bayar</th>
                    <th>Untuk Bulan</th>
                    <th>Untuk Tahun Ajaran</th>
                    <th>Nominal</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                      $i = 0
                  @endphp
                    @foreach ($pembayaran as $row)
                        <tr>
                          <td>{{ ++$i }}</td>
                          <td>{{ $row->siswa->nisn }}</td>
                          <td>{{ $row->siswa->nama }}</td>
                          <td>{{ $row->kelas }}</td>
                          <td>{{ $row->updated_at }}</td>
                          <td>{{ $row->bulan }}</td>
                          <td>{{ $row->tahun_ajaran }}</td>
                          <td>{{ $row->nominal }}</td>
                          <td>
                            <span class="badge bg-success">DIBAYAR</span>
                          </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            @else
            <div class="alert alert-danger" role="alert">
              <h5 class="alert-heading">Data Pembayaran Tidak Tersedia!</h5>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header bg-secondary">
            <h5>Status Pembayaran</h5>
          </div>
          <div class="card-body">
            @php
                use App\Helpers\Bulan;
            @endphp
            @if ($pembayaran->count() > 0)
            <table class="table table-striped table-bordered" id="table">
              <thead>
                <th>Tahun Ajaran</th>
                <th>Bulan</th>
                <th>Status</th>
              </thead>
              <tbody>
                  @foreach (Bulan::bulanAll() as $key => $value)
                    <tr>
                      <td>{{ $row->tahun_ajaran }}</td>
                      <td>{{ $value['nama_bulan'] }}</td>
                      <td>
                        @if(Bulan::statusPembayaran($row->id_siswa, $row->tahun_ajaran, $value['nama_bulan']) == 'DIBAYAR')
                          <a href="javascript:(0)" class="btn btn-success btn-sm"><i class=""></i> 
                            {{ Bulan::statusPembayaran($row->id_siswa, $row->tahun_ajaran, $value['nama_bulan']) }}
                          </a>
                        @else
                          <a href="javascript:(0)" class="btn btn-danger btn-sm"><i class=""></i> 
                            {{ Bulan::statusPembayaran($row->id_siswa, $row->tahun_ajaran, $value['nama_bulan']) }}
                          </a>
                        @endif
                      </td>
                    </tr>
                  @endforeach
              </tbody>
            </table>
            @else
            <div class="alert alert-danger" role="alert">
              <h5 class="alert-heading">Data Status Pembayaran Tidak Tersedia!</h5>
            </div>
            @endif
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