@section('sidebar-items')
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
  <div class="image">
    <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
  </div>
  <div class="info">
    <a href="#" class="d-block">Ahmad Sabili</a>
    <small class="d-block text-success">Petugas Koperasi</small>
  </div>
</div>

<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-item">
      <a href="{{ route('buku.index') }}" class="nav-link {{ (request()->is('buku')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('tagihan-buku.index') }}" class="nav-link {{ (request()->is('buku/tagihan-buku*')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-clipboard-check"></i>
        <p>
          Tagihan Buku
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('tagihan-buku.riwayat.index') }}" class="nav-link {{ (request()->is('buku/riwayat-pembayaran*')) ? 'active' : '' }}">
        <i class="nav-icon far fa-calendar-alt"></i>
        <p>
          Riwayat Pembayaran
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('buku.daftar.index') }}" class="nav-link {{ (request()->is('buku/daftar-buku*')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-book"></i>
        <p>
          Daftar Buku
        </p>
      </a>
    </li>
  </ul>
</nav>
@endsection