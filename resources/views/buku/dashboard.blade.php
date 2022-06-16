@extends('layouts.main', [
    
])

@include('buku.sidebar-item')

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Dashboard</h1>
      </div>
    </div>
  </div>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <x-card color="bg-info" value="{{ $student }}" icon="ion ion-person-stalker">
        <p>Siswa</p>
      </x-card>
      <x-card color="bg-success" value="{{ $class }}" icon="fas fa-school">
        <p>Kelas</p>
      </x-card>
      <x-card color="bg-warning" value="{{ $class }}" icon="fas fa-school">
        <p>Kelas</p>
      </x-card>
      <x-card color="bg-danger" value="{{ $class }}" icon="fas fa-school">
        <p>Belum Bayar</p>
      </x-card>
    </div>
  </div>
@endsection