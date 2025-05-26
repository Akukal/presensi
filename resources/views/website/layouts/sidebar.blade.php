<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('home') }}" class="brand-link text-decoration-none">
    <img src="{{ asset('assets/dist/img/logo.png') }}" class="brand-image img-circle bg-light p-1 elevation-3">
    <span class="brand-text font-weight-bold">{{ config('app.name') }}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    {{-- <!-- Sidebar User -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Administrator</a>
      </div>
    </div> --}}

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Dashboard -->
        <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link {{ Route::is('home') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- Data Master -->
        @canany(['create kelas', 'edit kelas', 'delete kelas', 'create guru', 'edit guru', 'delete guru'])
        <li class="nav-item {{ Route::is('kelas*') || Route::is('guru*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Route::is('kelas*') || Route::is('guru*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>Data Master<i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            @can(['create kelas', 'edit kelas', 'delete kelas'])
            <li class="nav-item">
              <a href="{{ route('kelas.index') }}" class="nav-link {{ Route::is('kelas*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i><p>Kelas</p>
              </a>
            </li>
            @endcan

            @can('create guru', 'edit guru', 'delete guru')
            <li class="nav-item">
              <a href="{{ route('guru.index') }}" class="nav-link {{ Route::is('guru*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i><p>Guru</p>
              </a>
            </li>
            @endcan
          </ul>
        </li>
        @endcanany

        <!-- Data Siswa -->
        @can(['create siswa', 'edit siswa', 'delete siswa', 'view presence', 'create presence'])
        <li class="nav-item {{ Route::is('siswa*') || Route::is('presences*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Route::is('siswa*') || Route::is('presences*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-graduate"></i>
            <p>Data Siswa<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            @can(['create siswa', 'edit siswa', 'delete siswa'])
            <li class="nav-item">
              <a href="{{ route('siswa.index') }}" class="nav-link {{ Route::is('siswa*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i><p>Siswa</p>
              </a>
            </li>
            @endcan

            @can('create guru', 'edit guru', 'delete guru')
            <li class="nav-item">
              <a href="{{ route('presences.index') }}" class="nav-link {{ Route::is('presences*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i><p>Absensi</p>
              </a>
            </li>
            @endcan
          </ul>
        </li>
        @endcanany

        <!-- Laporan Siswa -->
        @canany(['view presence by date', 'view presence by siswa'])
        <li class="nav-item {{ Route::is('reports.date*') || Route::is('laporan.siswa') || Route::is('laporan.siswa.rekap*') || Route::is('laporan.siswa.detail') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Route::is('reports.date*') || Route::is('laporan.siswa') || Route::is('laporan.siswa.rekap*') || Route::is('laporan.siswa.detail') ? 'active' : '' }}">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Data Absensi
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('reports.date') }}" class="nav-link {{ Route::is('report*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Laporan per Tanggal</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('laporan.siswa') }}" class="nav-link {{ Route::is('laporan.siswa') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Laporan per Kelas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('laporan.siswa.rekap') }}" class="nav-link {{ Route::is('laporan.siswa.rekap') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Rekap Absensi Siswa</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('laporan.siswa.detail') }}" class="nav-link {{ Route::is('laporan.siswa.detail') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Detail Absensi Siswa</p>
              </a>
            </li>
          </ul>
        </li>
        @endcanany

        <!-- Settings -->
        @can('view setting')
        <li class="nav-item {{ Route::is('settings*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Route::is('settings*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-cog"></i>
            <p>Settings<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"><a href="{{ route('settings.index') }}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>User</p></a></li>
            <li class="nav-item"><a href="{{ route('settings.index') }}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>WhatsApp</p></a></li>
            <li class="nav-item"><a href="{{ route('settings.index') }}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Umum</p></a></li>
            <li class="nav-item"><a href="{{ route('devices.index') }}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Alat</p></a></li>
          </ul>
        </li>
        @endcan

        <!-- RFID -->
        @can('view rfid')
        <li class="nav-item">
          <a href="{{ route('rfids.index') }}" class="nav-link {{ Route::is('rfids*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-id-card"></i>
            <p>RFID Registration</p>
          </a>
        </li>
        @endcan

        <!-- Logout -->
        <li class="nav-item">
          <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>
      </ul>
    </nav>
  </div>
</aside>