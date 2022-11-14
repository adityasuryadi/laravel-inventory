<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ url('/') }}">
        <img class="navbar-brand-full" src="svg/modulr.svg" width="89" height="25" alt="Windshield Shop">
        <img class="navbar-brand-minimized" src="svg/modulr-icon.svg" width="30" height="30" alt="Windshield Shop">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav navbar-nav ml-auto mr-3">
        <li class="nav-item dropdown d-md-down-none">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                aria-expanded="false">
                <i class="icon-bell"></i>
                <span class="badge badge-pill badge-danger">{{ $stock->count() }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                <div class="dropdown-header text-center">
                    <strong>Stok Yang akan habis </strong>
                </div>
                <!-- <a class="dropdown-item" href="#">
                    <i class="icon-user-follow text-success"></i> New user registered</a> -->
                    @foreach($stock as $barang)
                <a class="dropdown-item" href="product/{{ $barang->id }}/edit">{{ $barang->color }}</a>
                @endforeach
                <!-- <a class="dropdown-item" href="#">
                    <i class="icon-chart text-info"></i> Sales report is ready</a>
                <a class="dropdown-item" href="#">
                    <i class="icon-basket-loaded text-primary"></i> New client</a>
                <a class="dropdown-item" href="#">
                    <i class="icon-speedometer text-warning"></i> Server overloaded</a> -->
                <div class="dropdown-header text-center">
                    <strong>Jumlah Penjualan</strong>
                </div>
                <a class="dropdown-item" href="#">
                    <div class="text-uppercase mb-1">
                        <small>
                            <b>Invoice sudah di proses</b>
                        </small>
                    </div>
                    <span class="progress progress-xs">
                        <div class="progress-bar bg-info" role="progressbar"
                            style="width: {{ ($total_sales - $out_process_sales) }}%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </span>
                    <small class="text-muted">{{ $total_sales - $out_process_sales }}</small>
                </a>

                <a class="dropdown-item" href="#">
                    <div class="text-uppercase mb-1">
                        <small>
                            <b>Invoice belum di proses</b>
                        </small>
                    </div>
                    <span class="progress progress-xs">
                        <div class="progress-bar bg-danger" role="progressbar"
                            style="width: {{ ($out_process_sales) }}%" aria-valuenow="95" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </span>
                    <small class="text-muted">{{ $out_process_sales }} / {{ $total_sales }}</small>
                </a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                aria-expanded="false">
                <img class="img-avatar" src="img/avatars/6.jpg" alt="{{ Auth::user()->name }}">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>Settings</strong>
                </div>
                <a class="dropdown-item" href="{{ route('edit.profile',['id'=>Auth::user()->id]) }}">
                    <i class="fa fa-user"></i> Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}">
                    <i class="fa fa-wrench"></i> Logout</a>
            </div>
        </li>
    </ul>

</header>