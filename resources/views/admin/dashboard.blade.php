@extends('layouts.main', [
    
])

@include('admin.sidebar-item')

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
      <x-card color="bg-info" value="837" icon="ion ion-person-stalker" shortlink="{{ route('students.index') }}">
        <p>Siswa</p>
      </x-card>
      <x-card color="bg-success" value="24" icon="fas fa-school" shortlink="{{ route('students.index') }}">
        <p>Kelas</p>
      </x-card>
      <!-- ./col -->
      <x-card color="bg-warning" value="{{ $user }}" icon="fas fa-user">
        <p>User</p>
      </x-card>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>65</h3>

            <p>Unique Visitors</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            Jumlah per Kelas
          </div>
          <div class="card-body">
            <canvas id="barChart"></canvas>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            Jumlah Siswa
          </div>
          <div class="card-body">
            <canvas id="myChart"></canvas>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
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
      'XII IPA 1', 
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