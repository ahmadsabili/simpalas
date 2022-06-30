@extends('layouts.main', [
    'title' => 'Export to Excel'
])

@push('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@include('spp.sidebar-item')

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Export to Excel</h1>
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
            <div class="card-header bg-primary">
                Ekspor Data Pembayaran SPP
            </div>
          <div class="card-body">
            <form action="{{ route('spp.export.excel') }}" method="GET">
                <div class="form-group row">
                    <label for="kelas" class="col-sm-2 col-form-label">Dari Tanggal</label>
                    <div class="col-sm-2">
                        <input type="date" class="form-control" name="startDate" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kelas" class="col-sm-2 col-form-label">Sampai Tanggal</label>
                    <div class="col-sm-2">
                        <input type="date" class="form-control" name="endDate" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ekspor</button>
            </form>
          </div>
        </div>
      </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  @include('components.alert')
@endsection