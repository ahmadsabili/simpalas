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
      <x-card color="bg-success" value="Rp {{ $sumToday }}" icon="fas fa-money-bill">
        <p>Penerimaan Hari Ini</p>
      </x-card>
      <x-card color="bg-warning" value="Rp {{ $sumMonth }}" icon="fas fa-school">
        <p>Penerimaan Bulan Ini</p>
      </x-card>
      <x-card color="bg-danger" value="{{ $bookList }}" icon="fas fa-school">
        <p>Jumlah Buku</p>
      </x-card>
    </div>
  </div>
@endsection