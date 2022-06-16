@extends('layouts.main', [
    'title' => 'Tambah Kelas'
])

@include('admin.sidebar-item')

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Tambah Kelas</h1>
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
            <form action="{{ route('classes.store') }}" method="POST" class="form-horizontal">
                @csrf
                    <x-forms.input
                                name="nama_kelas"
                                label="Nama Kelas"
                                id="nama_kelas"
                                :isRequired="true"
                                hintText=""
                    />
                    
                    <div class="card-footer float-right">
                      <button type="submit" class="btn btn-default mr-2">Batal</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
          </div>
        </div>
      </div>
</div>
@endsection