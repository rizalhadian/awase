<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <!-- <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("/bower_components/admin-lte/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p> -->
                <!-- Status -->
                <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div> -->

        <!-- search form (Optional) -->
        @if($sesi == 'Earthquakes Impacts')
        <form action="http://localhost/awase/public/admin/earthquakesimpacts/search" method="get" class="sidebar-form">
        @elseif($sesi == 'Help Status')
        <form action="http://localhost/awase/public/admin/helpstatus/search" method="get" class="sidebar-form">
        @elseif($sesi == 'Disaster Status')
        <form action="http://localhost/awase/public/admin/disasterstatus/search" method="get" class="sidebar-form">
        @elseif($sesi == 'Earthquakes')
        <form action="http://localhost/awase/public/admin/earthquakes/search" method="get" class="sidebar-form">
        @elseif($sesi == 'Disasters')
        <form action="http://localhost/awase/public/admin/disasters/search" method="get" class="sidebar-form">
        @endif
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                  <button type='submit'  id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">

            <!--Sidebar Laporan-->
            @if($sesi == 'Laporan')
            <li class="active"><a href="{{ url('admin/titikkumpul') }}"><i class="fa fa-bar-chart"></i><span>Laporan</span></a></li>
            @else
            <li><a href="{{ url('admin/titikkumpul') }}"><i class="fa fa-bar-chart"></i><span>Laporan</span></a></li>
            @endif

            <!--Sidebar Users-->
            @if($sesi == 'User')
            <li class="active"><a href="{{ url('admin/titikkumpul') }}"><i class="fa fa-user"></i><span>Users</span></a></li>
            @else
            <li><a href="{{ url('admin/titikkumpul') }}"><i class="fa fa-user"></i><span>Users</span></a></li>
            @endif

            <!--Sidebar Master Data-->
            @if($sesi == 'Earthquakes Impacts' || $sesi == 'Help Status' || $sesi == 'Disaster Status')
            <li class="active treeview">
            @else
            <li class="treeview">
            @endif
                <a href="#"><i class="fa fa-database"></i><span>Master Data</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @if($sesi == 'Earthquakes Impacts')
                    <li class="active"><a href="{{ url('admin/earthquakesimpacts') }}"><i class="fa fa-angle-right"></i><span>Earthquakes Impacts</span></a></li>
                    @else
                    <li><a href="{{ url('admin/earthquakesimpacts') }}"><i class="fa  fa-angle-right"></i><span>Earthquakes Impacts</span></a></li>
                    @endif
                </ul>
                <ul class="treeview-menu">
                    @if($sesi == 'Help Status')
                    <li class="active"><a href="{{ url('admin/helpstatus') }}"><i class="fa fa-angle-right"></i><span>Help Status</span></a></li>
                    @else
                    <li><a href="{{ url('admin/helpstatus') }}"><i class="fa  fa-angle-right"></i><span>Help Status</span></a></li>
                    @endif
                </ul>
                <ul class="treeview-menu">
                    @if($sesi == 'Disaster Status')
                    <li class="active"><a href="{{ url('admin/disasterstatus') }}"><i class="fa fa-angle-right"></i><span>Disaster Status</span></a></li>
                    @else
                    <li><a href="{{ url('admin/disasterstatus') }}"><i class="fa  fa-angle-right"></i><span>Disaster Status</span></a></li>
                    @endif
                </ul>
            </li>

            <!--Sidebar Bencana-->
            @if($sesi == 'Earthquakes' || $sesi == 'Disasters' || $sesi == 'Tsunami')
            <li class="active treeview">
            @else
            <li class="treeview">
            @endif
                <a href="#"><i class="fa fa-bolt"></i><span>Disasters</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @if($sesi == 'Disasters')
                    <li class="active"><a href="{{ url('admin/disasters') }}"><i class="fa  fa-angle-right"></i><span>Disasters</span></a></li>
                    @else
                    <li><a href="{{ url('admin/disasters') }}"><i class="fa  fa-angle-right"></i><span>Disasters</span></a></li>
                    @endif

                    @if($sesi == 'Earthquakes')
                    <li class="active"><a href="{{ url('admin/earthquakes') }}"><i class="fa fa-angle-right"></i><span>Earthquakes</span></a></li>
                    @else
                    <li><a href="{{ url('admin/earthquakes') }}"><i class="fa fa-angle-right"></i><span>Earthquakes</span></a></li>
                    @endif

                    @if($sesi == 'Tsunami')
                    <li class="active"><a href="{{ url('admin/tsunami') }}"><i class="fa fa-angle-right"></i><span>Tsunami</span></a></li>
                    @else
                    <li><a href="{{ url('admin/tsunami') }}"><i class="fa fa-angle-right"></i><span>Tsunami</span></a></li>
                    @endif
                </ul>
            </li>

            <!--Sidebar Evakuasi-->
            @if($sesi == 'Evakuasi')
            <li class="active"><a href="{{ url('admin/evakuasi') }}"><i class="fa fa-life-ring"></i><span>Evakuasi</span></a></li>
            @else
            <li><a href="{{ url('admin/evakuasi') }}"><i class="fa fa-life-ring"></i><span>Evakuasi</span></a></li>
            @endif
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
