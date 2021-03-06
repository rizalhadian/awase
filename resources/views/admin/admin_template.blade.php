    <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $page_title or null }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset("/admin-lte/bootstrap/css/bootstrap.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset("/admin-lte/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="{{ asset("/admin-lte/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!--<script type="text/javascript"
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzf-1tMeYs2Eur4MIo_TCN_WV3ruZR8hU">
    </script>-->

    @if($sesi == 'Titik Kumpul')
    @include('gmaps/assemblypointgmaps')
    @elseif($sesi == 'Earthquakes Impacts')
    <script src="{{ asset("/js/earthquakesimpact.js") }}"></script>
    @elseif($sesi == 'Help Status')
    <script src="{{ asset("/js/helpstatus.js") }}"></script>
    @elseif($sesi == 'Disaster Status')
    <script src="{{ asset("/js/disasterstatus.js") }}"></script>
    @elseif($sesi == 'Earthquakes')
    <!-- /*<style type="text/css">
                  #map-canvas { height: 400px; width: 100%; margin: 0; padding: 0; }
    </style>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-MwemIroiWbHPbJXdZQIMp9jep7ycNoQ" async defer>
    </script>
    <script
        src="{{ asset("/js/markerclusterer.js") }}">
    </script>
    <script src="{{ asset("/js/earthquakes.js") }}"></script>*/ -->
    @include('gmaps/earthquakesgmaps')
    @endif
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<!--<div id='map-canvas'>
</div>-->

<body class="skin-blue">

<div class="wrapper">

    <!-- Header -->
    @include('admin/header')

    <!-- Sidebar -->
    @include('admin/sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $sesi or "Page Title" }}
                <small>{{ $page_description or null }}</small>
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
                <li class="active">{{ $sesi }}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            @yield('content')

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!--Modal-->



    @if($sesi == 'Earthquakes Impacts')
    @include('admin/modal/earthquakesimpactsmodal')
    @elseif($sesi == 'Help Status')
    @include('admin/modal/helpstatusmodal')
    @elseif($sesi == 'Disaster Status')
    @include('admin/modal/disasterstatusmodal')
    @endif
    <!-- Footer -->
    @include('admin/footer')

</div><!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.3 -->
<script src="{{ asset ("/admin-lte/plugins/jQuery/jQuery-2.2.0.min.js") }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset ("/admin-lte/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset ("/admin-lte/dist/js/app.min.js") }}" type="text/javascript"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience -->
</body>
</html>
