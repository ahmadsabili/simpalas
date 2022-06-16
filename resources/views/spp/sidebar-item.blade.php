@section('sidebar-items')
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
  <div class="image">
    <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
  </div>
  <div class="info">
    <a href="#" class="d-block">Ahmad Sabili</a>
    <small class="d-block text-primary">Petugas SPP</small>
  </div>
</div>

<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-item">
      <a href="{{ route('spp.index') }}" class="nav-link {{ (request()->is('komite')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('spp.pembayaran.index') }}" class="nav-link {{ (request()->is('komite/pembayaran*')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-money-check"></i>
        <p>
          Pembayaran Komite
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('spp.status.index') }}" class="nav-link {{ (request()->is('komite/status-pembayaran*')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-clipboard-check"></i>
        <p>
          Status Pembayaran
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('spp.riwayat.index') }}" class="nav-link {{ (request()->is('komite/riwayat-pembayaran*')) ? 'active' : '' }}">
        <i class="nav-icon far fa-calendar-alt"></i>
        <p>
          Riwayat Pembayaran
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('spp.daftar.index') }}" class="nav-link {{ (request()->is('komite/daftar-komite*')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-money-bill"></i>
        <p>
          Sumbangan Komite
        </p>
      </a>
    </li>
  </ul>
</nav>
@endsection