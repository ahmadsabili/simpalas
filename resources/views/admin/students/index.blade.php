@extends('layouts.main', [
    'title' => 'Daftar Siswa'
])

@push('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@include('admin.sidebar-item')

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
          <div class="card-header">
            <div class="float-left" id="buttons"></div>
            <div class="float-right">
              <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="input-group">
                  <input type="file" name="student-excel" class="form-control" required>
                  <button class="btn btn-info mr-2" type="submit" id="button-addon2"><i class="fas fa-file-import"></i>&nbsp; Impor Data</button>
                  <a href="{{ route('students.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp; Tambah Siswa</a>
              </div>
              </form>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="students-table">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jenis Kelamin</th>
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
  @include('admin.students.ajax')
  @include('components.alert')
@endsection