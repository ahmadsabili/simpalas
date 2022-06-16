<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @stack('meta-token')
  <title>SIMPALAS {{ isset($title) ? '| '.$title : '' }}</title>
  @include('layouts.inc.ext-css')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
  <!-- Site wrapper -->
  <div class="wrapper">
  <!-- Navbar -->
  @include('layouts.inc.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts.inc.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      @yield('content-header')
    </section>

    <!-- Main content -->
    <section class="content">
     @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('layouts.inc.footer')
  <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

@include('layouts.inc.ext-js')
@stack('js')

</body>
</html>
