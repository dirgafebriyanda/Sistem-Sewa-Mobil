<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-car"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Sebil</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Users -->
    @auth
        @if (auth()->user()->role == 'Admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Pengguna</span></a>
            </li>
        @endif
    @endauth

    <!-- Nav Item - Cars -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('car.index') }}">
            <i class="fas fa-fw fa-car"></i>
            <span>Mobil</span></a>
    </li>

    <!-- Nav Item - Tentals -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('rental.index') }}">
            <i class="fas fa-fw fa-car-side"></i>
            <span>Menyewa</span></a>
    </li>

    <!-- Nav Item - Tentals -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('return.index') }}">
            <i class="fas fa-hand-holding-usd"></i>
            <span>Mengembalikan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
