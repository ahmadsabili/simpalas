@section('sidebar-items')
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
  <div class="image">
    <img src="/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
  </div>
  <div class="info">
    <a href="#" class="d-block">Ahmad Sabili</a>
    <small class="d-block text-success">Admin</small>
  </div>
</div>

<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-item">
      <a href="/admin" class="nav-link {{ (request()->is('admin')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('students.index') }}" class="nav-link {{ (request()->is('admin/students*')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-graduate"></i>
        <p>
          Siswa
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('classes.index') }}" class="nav-link {{ (request()->is('admin/classes*')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-school"></i>
        <p>
          Kelas
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('users.index') }}" class="nav-link {{ (request()->is('admin/users*')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-cog"></i>
        <p>
          User
        </p>
      </a>
    </li>
  </ul>
</nav>
@endsection