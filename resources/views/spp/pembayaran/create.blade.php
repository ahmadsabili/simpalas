@extends('layouts.main', [
    'title' => 'Tambah Pembayaran SPP'
])

@push('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@include('spp.sidebar-item')

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Tambah Pembayaran</h1>
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
          <form action="{{ route('spp.pembayaran.store') }}" method="POST">
            @csrf
            <div class="card-header">
              <a href="{{ url()->previous() }}" class="btn btn-sm btn-danger">
                <i class="fas fa-window-close"></i>&nbsp; Batalkan
              </a>
            </div>
            <div class="card-body">
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
                      <input type="text" class="form-control" value="{{ $siswa->kelas->nama_kelas }}" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Untuk Tahun Ajaran</label>
                      <select class="form-control" name="tahun_ajaran" id="tahun_ajaran">
                        <option value="" selected>-- Pilih Tahun Ajaran --</option>
                        @foreach ($tahun_ajaran as $row)
                        <option value="{{ $row->tahun_ajaran }}">{{ $row->tahun_ajaran }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Jenjang Kelas</label>
                      <select class="form-control" id="kelas">
                        <option value="">-- Pilih Kelas --</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Nominal</label>
                      <input type="" class="form-control" value="" id="nominal" name="nominal" readonly required>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Untuk Bulan</label>
                      <div class="select2-purple">
                        <select class="select2" name="bulan[]" multiple="multiple" data-placeholder="Pilih Bulan" data-dropdown-css-class="select2-purple" style="width: 100%;" id="bulan">
                          @foreach ($bulanAll as $bulan)
                          <option value="{{ $bulan['nama_bulan'] }}">{{ $bulan['nama_bulan'] }}</option>
                          @endforeach
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>TOTAL BAYAR</label>
                      <input type="text" class="form-control" id="total_bayar" readonly required>
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
@push('js')
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

     //Initialize Select2 Elements
    $('.select2').select2()
    });

    $('#tahun_ajaran').on('change', function () {
                var tahun_ajaran = this.value;
                $('#kelas').html('');
                $.ajax({
                    url: "{{ route('spp.pembayaran.getKelas') }}?tahun_ajaran="+tahun_ajaran,
                    type: 'get',
                    success: function (res) {
                        $('#kelas').html('<option value="">--Pilih Kelas--</option>');
                        $.each(res, function (key, value) {
                            $('#kelas').append('<option value="' + value
                                .id + '">' + value.kelas + '</option>');
                        });
                    }
                });
            });
            $('#kelas').on('change', function () {
                var kelasId = this.value;
                $.ajax({
                    url: "{{ route('spp.pembayaran.getNominal') }}?kelasId="+kelasId,
                    type: 'get',
                    success: function (res) {
                      $("#nominal").val(res.nominal);
                    }
                });
            });
            $('#bulan').on('change', function() {
              var bulan = $(this).val();
              var total_bulan = bulan.length;
              var nominal = $('#nominal').val();
              var total_bayar = (total_bulan * nominal);
              $('#total_bayar').val(total_bayar);
            });
</script>
@endpush
@endsection