<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/admin" class="brand-link">
    <img src="{{ asset('dist/img/palas.png') }}" alt="Logo Palas" class="brand-image img-circle elevation-3 bg-white" style="opacity: .8">
    <span class="brand-text">SIMPALAS</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    @yield('sidebar-items')
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>