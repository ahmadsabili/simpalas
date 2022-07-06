@extends('layouts.main', [
    'title' => 'Edit Buku'
])

@include('buku.sidebar-item')

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Buku</h1>
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
            <form action="{{ route('buku.daftar.update', $book->id) }}" method="POST" class="form-horizontal">
                @csrf
                    <x-forms.input
                                name="judul"
                                label="Judul Buku"
                                id="judul"
                                :isRequired="true"
                                hintText=""
                                value="{{ $book->judul }}"
                    />
                    <div class="form-group row">
                        <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-1 mt-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="kelas" id="X" value="X" {{ $book->kelas == 'X' ? 'checked' : '' }}>
                            <label for="X" class="form-check-label">X</label>
                          </div>
                        </div>
                        <div class="col-sm-1 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="kelas" value="XI" id="XI {{ $book->kelas == 'XI' ? 'checked' : '' }}">
                                <label for="XI" class="form-check-label">XI</label>
                            </div>
                        </div>
                        <div class="col-sm-1 mt-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="kelas" value="XII" id="XII" {{ $book->kelas == 'XII' ? 'checked' : '' }}>
                            <label for="XII" class="form-check-label">XII</label>
                          </div>
                        </div>
                    </div>
                    <x-forms.input
                    name="harga"
                    label="Harga"
                    id="harga"
                                :isRequired="true"
                                hintText=""
                                value="{{ $book->harga }}"
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