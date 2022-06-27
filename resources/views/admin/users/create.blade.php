@extends('layouts.main', [
    'title' => 'Tambah User'
])

@include('admin.sidebar-item')

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Tambah User</h1>
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
            <form action="{{ route('users.store') }}" method="POST" class="form-horizontal">
                @csrf
                    <x-forms.input
                                name="name"
                                label="Nama"
                                id="Nama"
                                :isRequired="true"
                                hintText=""
                    />
                    <x-forms.input
                                name="email"
                                label="Email"
                                id="email"
                                :isRequired="true"
                                hintText=""
                    />
                    <x-forms.input
                                name="password"
                                label="Password"
                                id="Password"
                                :isRequired="true"
                                type="password"
                                hintText=""
                    />
                    <div class="form-group row">
                      <label for="kelas" class="col-sm-2 col-form-label">Role</label>
                      <div class="col-sm-1 mt-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="role" id="admin" value="admin" checked>
                          <label for="admin" class="form-check-label">Admin</label>
                        </div>
                      </div>
                      <div class="col-sm-1 mt-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="role" value="spp" id="Petugas SPP">
                          <label for="Petugas SPP" class="form-check-label">SPP</label>
                        </div>
                      </div>
                      <div class="col-sm-1 mt-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="role" value="buku" id="Petugas Buku">
                          <label for="Petugas Buku" class="form-check-label">Buku</label>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer float-right">
                      <button type="submit" class="btn btn-default mr-2">Batal</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
          </div>
        </div>
      </div>
</div>
@push('js')
@include('components.alert')
@endpush
@endsection