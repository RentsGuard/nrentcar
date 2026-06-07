<!-- SIDEBAR -->
<div class="sidebar">

    <!-- LOGO -->
    <div class="sidebar-brand">
        <img src="{{ asset('logo.jpeg') }}" width="70">
        <h4>RentGuards</h4>
    </div>

    <!-- MENU -->
    <ul class="sidebar-menu">

        <li>
            <a href="{{ url('/') }}"
               class="{{ request()->is('/') ? 'active' : '' }}">
                <i class="bi bi-house-door-fill"></i>
                Home
            </a>
        </li>

        <li>
            <a href="/customer"
               class="{{ request()->is('customer') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                Daftar Customer
            </a>
        </li>

        <li>
            <a href="/mobil"
               class="{{ request()->is('mobil') ? 'active' : '' }}">
                <i class="bi bi-car-front-fill"></i>
                Daftar Mobil
            </a>
        </li>

        <li>
            <a href="/penyewaan"
               class="{{ request()->is('penyewaan') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i>
                Penyewaan
            </a>
        </li>

        <li>
            <a href="/manajemen-mobil"
               class="{{ request()->is('manajemen-mobil') ? 'active' : '' }}">
                <i class="bi bi-gear-fill"></i>
                Manajemen Mobil
            </a>
        </li>

        <li>
            <a href="/laporan"
               class="{{ request()->is('laporan') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-fill"></i>
                Laporan
            </a>
        </li>
    </ul>

    <form method="POST" action="/logout">
        @csrf
        <button class="btn btn-danger w-100 mt-3">
            Logout
        </button>
    </form>

</div>