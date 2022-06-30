@extends('layouts.main', [
    'title' => 'Tambah Siswa'
])

@include('admin.sidebar-item')

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Tambah Siswa</h1>
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
            <form action="{{ route('students.store') }}" method="POST" class="form-horizontal">
                @csrf
                    <x-forms.input
                                name="nisn"
                                label="NISN"
                                id="nisn"
                                :isRequired="true"
                                hintText=""
                    />
                    <x-forms.input
                                name="nama"
                                label="Nama Siswa"
                                id="nama"
                                :isRequired="true"
                                hintText=""
                    />
                    <div class="form-group row">
                        <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="kelas_id" id="kelas">
                              <option value="">-- Pilih Kelas --</option>
                                @foreach ($class as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                      <label for="kelas" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                      <div class="col-sm-1 mt-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="jenis_kelamin" id="Laki-laki" value="Laki-laki" checked>
                          <label for="Laki-laki" class="form-check-label">Laki-Laki</label>
                        </div>
                      </div>
                      <div class="col-sm-1 mt-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan" id="Perempuan">
                          <label for="Perempuan" class="form-check-label">Perempuan</label>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer float-right">
                      <button type="submit" class="btn btn-default mr-2">Batal</button>
                      <button type="submit" class="btn btn-primary" name="Simpan">Simpan</button>
                    </div>
                </form>
          </div>
        </div>
      </div>
</div>
@endsection