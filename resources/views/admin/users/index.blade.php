@extends('layouts.main', [
    'title' => 'Daftar User'
])

@push('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@include('admin.sidebar-item')

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Daftar User</h1>
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
            <div class="float-right">
                <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp; Tambah User</a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="users-table">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                              @if ($user->role == 'admin')
                              <span class="badge bg-primary">{{ $user->role }}</span>
                              @elseif ($user->role == 'spp')
                              <span class="badge bg-success">{{ $user->role }}</span>
                              @else
                              <span class="badge bg-warning">{{ $user->role }}</span>
                              @endif
                            </td>
                            <td>
                              <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>&nbsp; Hapus</button>
                              </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </div>
  @push('js')
      <script>
        $(document).ready( function () {
            $('#users-table').DataTable();
        });
      </script>
      @if (session('success'))
      <script>
        toastr.success("{{ session('success') }}")
      </script>
  @endif
  @if (session('error'))
      <script>
        toastr.error("{{ session('error') }}")
      </script>
  @endif
  @endpush
@endsection