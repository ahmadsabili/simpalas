@extends('layouts.main', [
    'title' => 'Edit SPP'
])

@include('spp.sidebar-item')

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit SPP</h1>
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
            <form action="{{ route('spp.daftar.update', $spp->id) }}" method="POST" class="form-horizontal">
                @csrf
                @method('PUT')
                    <x-forms.input
                                name="tahun_ajaran"
                                label="Tahun Ajaran"
                                id="Tahun Ajaran"
                                :isRequired="true"
                                hintText=""
                                value="{{ $spp->tahun_ajaran }}"
                    />
                    <div class="form-group row">
                        <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-1 mt-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="kelas" id="X" value="X" {{ $spp->kelas == 'X' ? 'checked' : '' }}>
                            <label for="X" class="form-check-label">X</label>
                          </div>
                        </div>
                        <div class="col-sm-1 mt-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="kelas" value="XI" id="XI" {{ $spp->kelas == 'XI' ? 'checked' : '' }}>
                            <label for="XI" class="form-check-label">XI</label>
                          </div>
                        </div>
                        <div class="col-sm-1 mt-2">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="kelas" value="XII" id="XII" {{ $spp->kelas == 'XII' ? 'checked' : '' }}>
                              <label for="XII" class="form-check-label">XII</label>
                            </div>
                        </div>
                    </div>
                    <x-forms.input
                                name="nominal"
                                label="Nominal"
                                id="Nominal"
                                :isRequired="true"
                                hintText=""
                                type="number"
                                value="{{ $spp->nominal }}"
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