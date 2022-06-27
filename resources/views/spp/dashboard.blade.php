@extends('layouts.main', [
    
])

@include('spp.sidebar-item')

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
      <x-card color="bg-info" value="836" icon="ion ion-person-stalker">
        <p>Siswa</p>
      </x-card>
      <x-card color="bg-success" value="Rp {{ $sumToday }}" icon="fas fa-money-bill">
        <p>Penerimaan Hari Ini</p>
      </x-card>
      <x-card color="bg-warning" value="Rp {{ $sumMonth }}" icon="fas fa-money-bill">
        <p>Penerimaan Bulan Ini</p>
      </x-card>
      <x-card color="bg-danger" value="{{ $class }}" icon="fas fa-school">
        <p>Kelas</p>
      </x-card>
    </div>
  </div>
  @push('js')
  <script>
    const dataPie = {
  labels: [
    'Laki-Laki',
    'Perempuan',
  ],
  datasets: [{
    label: 'Jumlah Siswa',
    data: [
      385,
      452,
    ],
    backgroundColor: [
      'rgb(54, 162, 235)',
      'rgb(255, 99, 132)',
    ],
    hoverOffset: 4
  }]
};
  
  const configPie = {
    type: 'pie',
    data: dataPie,
  };
  </script>


  <script>
    const labelsBar = [
      'Januari', 
      'XII IPA 2',
      'XII IPA 3',
      'XII IPA 4',
      'XII IPS 1',
      'XII IPS 2',
      'XII IPS 3',
      'XII IPS 4',
    ];
    const dataBar = {
    labels: labelsBar,
    datasets: [{
      label: 'Jumlah Siswa',
      data: [30, 29, 31, 32, 40, 42, 40, 44],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 0, 210, 0.2)',
        'rgba(0, 124, 89, 0.2)'
      ],
      borderColor: [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(255, 0, 210)',
        'rgb(0, 124, 89)'
      ],
      borderWidth: 1
    }]
  };

  const configBar = {
  type: 'bar',
  data: dataBar,
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  },
};
  </script>
  <script>
    const barChart = new Chart(
      document.getElementById('barChart'),
      configBar
    );
    const myChart = new Chart(
      document.getElementById('myChart'),
      configPie
    );

  </script>
  
  @endpush
@endsection