<!DOCTYPE html>
@php
setlocale(LC_ALL, 'IND');
@endphp
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <link rel="shortcut icon" href="{{asset('icon.png')}}">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/skins/_all-skins.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/morris.js/morris.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/jvectormap/jquery-jvectormap.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/select2/dist/css/select2.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>

<body class="hold-transition skin-blue-light sidebar-mini {{Auth::User()->toggle_bar}}">

<div class="wrapper">

  <header class="main-header">
    <a href="/" class="logo">
      <span class="logo-mini">SPs</span>
      <span class="logo-lg"><b>BEASISWA </b>SPs</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" id='toggle' value="@if(Auth::User()->toggle_bar==null||Auth::User()->toggle_bar==""){{'0'}}@else{{Auth::User()->toggle_bar}}@endif" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              @if (Auth::user()->profile == null && Auth::user()->gender == null)
                <img src="{{Storage::url('profile/default.png')}}" class="user-image" alt="User Image">
              @elseif (Auth::user()->profile == null && Auth::user()->gender == 'l')
                <img src="{{Storage::url('profile/male.png')}}" class="user-image" alt="User Image">
              @elseif (Auth::user()->profile == null && Auth::user()->gender == 'p')
                <img src="{{Storage::url('profile/female.png')}}" class="user-image" alt="User Image">
              @else
                <img src="{{Storage::url('profile/'.Auth::user()->id.'/'.Auth::user()->profile)}}" class="user-image" alt="User Image">
              @endif
              <span class="hidden-xs">{{Auth::user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                @if (Auth::user()->profile == null && Auth::user()->gender == null)
                  <img src="{{Storage::url('profile/default.png')}}" alt="User Image">
                @elseif (Auth::user()->profile == null && Auth::user()->gender == 'l')
                  <img src="{{Storage::url('profile/male.png')}}" alt="User Image">
                @elseif (Auth::user()->profile == null && Auth::user()->gender == 'p')
                  <img src="{{Storage::url('profile/female.png')}}" alt="User Image">
                @else
                  <img src="{{Storage::url('profile/'.Auth::user()->id.'/'.Auth::user()->profile)}}" alt="User Image">
                @endif
                <p>
                  {{Auth::user()->name}} {{Auth::user()->l_name}}
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Log out</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          @if (Auth::user()->profile == null && Auth::user()->gender == null)
            <img src="{{Storage::url('profile/default.png')}}" alt="User Image">
          @elseif (Auth::user()->profile == null && Auth::user()->gender == 'l')
            <img src="{{Storage::url('profile/male.png')}}" alt="User Image">
          @elseif (Auth::user()->profile == null && Auth::user()->gender == 'p')
            <img src="{{Storage::url('profile/female.png')}}" alt="User Image">
          @else
            <img src="{{Storage::url('profile/'.Auth::user()->id.'/'.Auth::user()->profile)}}">
          @endif
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <li class="{{ Request::is('/','/') ? 'active' : ''}}">
          <a href="/">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        @if(Auth::user()->level == 0 || Auth::user()->level == 1)
        <li class="{{ Request::is('users','users/*') ? 'active' : ''}}">
          <a href="/users">
            <i class="fa fa-group"></i> <span>Management User</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        @endif

        @if(Auth::user()->level == 0 || Auth::user()->level == 1)
          <li class="treeview {{ Request::is('master','master/*') ? 'active' : ''}}">
            <a href="#">
              <i class="fa fa-share"></i> <span>Setup Master</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>

            <ul class="treeview-menu">

              <li class="treeview {{ Request::is('master/program_studi','master/program_studi/*') ? 'active' : ''}} {{ Request::is('master/fakultas','master/fakultas/*') ? 'active' : ''}} {{ Request::is('master/mahasiswa','master/mahasiswa/*') ? 'active' : ''}}">
                <a href="#"><i class="fa fa-square-o"></i> Data Mahasiswa
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="{{ Request::is('master/fakultas','master/fakultas/*') ? 'active' : ''}}"><a href="/master/fakultas"><i class="fa fa-circle-o"></i> Fakultas</a></li>
                  <li class="{{ Request::is('master/program_studi','master/program_studi/*') ? 'active' : ''}}"><a href="/master/program_studi"><i class="fa fa-circle-o"></i> Program Studi</a></li>
                  <li class="{{ Request::is('master/mahasiswa','master/mahasiswa/*') ? 'active' : ''}}"><a href="/master/mahasiswa"><i class="fa fa-circle-o"></i> Mahasiswa</a></li>
                </ul>
              </li>

              <li class="treeview {{ Request::is('master/jenis_beasiswa','master/jenis_beasiswa/*') ? 'active' : ''}} {{ Request::is('master/sumber_beasiswa','master/sumber_beasiswa/*') ? 'active' : ''}}">
                <a href="#"><i class="fa fa-square-o"></i> Data Beasiswa
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="{{ Request::is('master/jenis_beasiswa','master/jenis_beasiswa/*') ? 'active' : ''}}"><a href="/master/jenis_beasiswa"><i class="fa fa-circle-o"></i> Jenis Beasiswa</a></li>
                  <li class="{{ Request::is('master/sumber_beasiswa','master/sumber_beasiswa/*') ? 'active' : ''}}"><a href="/master/sumber_beasiswa"><i class="fa fa-circle-o"></i> Sumber Beasiswa</a></li>
                </ul>
              </li>

              <li class=" {{ Request::is('master/bpp_prodi','master/bpp_prodi/*') ? 'active' : ''}}">
                <a href="/master/bpp_prodi"><i class="fa fa-square-o"></i> Data BPP Prodi</a>
              </li>

            </ul>

          </li>
        @endif

        <li class="{{ Request::is('beasiswa','beasiswa/*') ? 'active' : ''}}">
          <a href="/beasiswa">
            <i class="fa fa-book"></i> <span>Beasiswa (SPK)</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li class="{{ Request::is('tagihan','tagihan/*') ? 'active' : ''}}">
          <a href="/tagihan">
            <i class="fa fa-book"></i> <span>Tagihan Beasiswa</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li class="{{ Request::is('pembayaran','pembayaran/*') ? 'active' : ''}}">
          <a href="/pembayaran">
            <i class="fa fa-book"></i> <span>BPP Telah Di ITB (SP2D)</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li class="{{ Request::is('penagihan','penagihan/*') ? 'active' : ''}}">
          <a href="/penagihan">
            <i class="fa fa-book"></i> <span>BPP Dibayar Ke ITB</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li class="treeview {{ Request::is('laporan','laporan/*') ? 'active' : ''}}">
          <a href="#">
            <i class="fa fa-share"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">

            <li class=" {{ Request::is('laporan/keuangan','laporan/keuangan/*') ? 'active' : ''}}">
              <a href="/laporan/keuangan"><i class="fa fa-square-o"></i> Laporan Keuangan</a>
            </li>

            <li class=" {{ Request::is('laporan/akademik','laporan/akademik/*') ? 'active' : ''}}">
              <a href="/laporan/akademik"><i class="fa fa-square-o"></i> Laporan Akademik</a>
            </li>

          </ul>

        </li>

      </ul>
    </section>
  </aside>

  <div class="content-wrapper">
    @yield('content')
  </div>
  <footer class="main-footer">
    <strong>Copyright &copy; 2018 <a href="http://www.itb.ac.id" target="_blank">Institut Teknologi Bandung</a>.</strong> All rights
    reserved.
  </footer>

  <div class="control-sidebar-bg"></div>
</div>

<script src="{{asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/morris.js/morris.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{asset('adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('adminlte/dist/js/pages/dashboard.js')}}"></script>
<script src="{{asset('adminlte/dist/js/demo.js')}}"></script>
<script src="{{asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('js/money.js')}}"></script>
<script src="https://unpkg.com/sweetalert@2.1.0/dist/sweetalert.min.js"></script>

<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable()
    $('#example3').DataTable()

    $('select').select2({
      placeholder: ""
    })

    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    })
  })

  $(document).ready(function(){
    $("#toggle").click(function(){
      var val = $(this).val();
      $.get("/setting/toggle_bar", function(response){
      });
    });
  });
</script>
@yield('js')
</body>
</html>
