<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="{{ URL::to('/') }}">
                    <i class="nav-icon icon-speedometer"></i> Dashboard
                </a>
            </li>
            @can('user.create')
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-list"></i> Admin</a>
                    @can('user.create')
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.index') }}">
                            <i class="nav-icon icon-layers"></i> User </a>
                    </li>
                </ul>
                @endcan

                @can('role.create')
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('role.index') }}">
                            <i class="nav-icon icon-layers"></i> Role </a>
                    </li>
                </ul>
                @endcan

                 @can('permission.create')
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('permission.index') }}">
                            <i class="nav-icon icon-layers"></i> Permission </a>
                    </li>
                </ul>
                @endcan
            </li>
            @endcan
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-list"></i> Master</a>
                    @can('article.create')
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('article.index') }}">
                            <i class="nav-icon icon-layers"></i> Artikel </a>
                    </li>
                </ul>
                @endcan

                @can('product.create')
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('product.index') }}">
                            <i class="nav-icon icon-layers"></i> Barang </a>
                    </li>
                </ul>
                @endcan

                @can('customer.create')
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.index') }}">
                            <i class="nav-icon icon-layers"></i> Customer </a>
                    </li>
            </ul>
            @endcan

            @can('company.create')
            <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('company.index') }}">
                            <i class="nav-icon icon-layers"></i> Company </a>
                    </li>
            </ul>
            @endcan

            @can('supplier.create')
            <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('supplier.index') }}">
                            <i class="nav-icon icon-layers"></i> Supplier </a>
                    </li>
            </ul>
            @endcan
            </li>
            
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-briefcase"></i> Transaksi</a>
                    @can('sales.create')
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('sales.index') }}">
                            <i class="nav-icon icon-basket-loaded"></i> Penjualan </a>
                    </li>
                </ul>
                @endcan

                @can('purchase.create')
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('purchases.index') }}">
                            <i class="nav-icon icon-basket-loaded"></i> Pembelian </a>
                    </li>
                </ul>
                @endcan

            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-list"></i> Report</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="nav-icon icon-layers"></i> Hutang & Piutang </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>