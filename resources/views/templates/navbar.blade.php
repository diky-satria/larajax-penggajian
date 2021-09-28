<nav class="navbar fixed-top navbar-expand-lg navbar-light">
   <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">G@JI</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
         @if(Auth::user())
         <ul class="navbar-nav text-center">
            @if(Auth::user()->role == 'admin')
            <li class="nav-item">
               <a class="nav-link {{ Request::is('dashboard') ? 'router-active' : '' }}" href="{{ url('dashboard') }}">Dashboard</a>
            </li>
            <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Master Data
               </a>
               <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item text-center" href="{{ url('pegawai') }}">Pegawai</a></li>
                  <li><a class="dropdown-item text-center" href="{{ url('jabatan') }}">Jabatan</a></li>
                  <li><a class="dropdown-item text-center" href="{{ url('golongan') }}">Golongan</a></li>
               </ul>
            </li>
            <li class="nav-item">
               <a class="nav-link {{ Request::is('kehadiran') ? 'router-active' : '' }}" href="{{ url('kehadiran') }}">Kehadiran</a>
            </li>
            <li class="nav-item">
               <a class="nav-link {{ Request::is('slip-gaji') ? 'router-active' : '' }}" href="{{ url('slip-gaji') }}">Slip Gaji</a>
            </li>
            @else
            <li class="nav-item">
               <a class="nav-link {{ Request::is('user') ? 'router-active' : '' }}" href="{{ url('user') }}">User</a>
            </li>
            @endif
            <li class="nav-item">
               <a class="nav-link {{ Request::is('profil-dan-password') ? 'router-active' : '' }}" href="{{ url('profil-dan-password') }}">Profil & Password</a>
            </li>
         </ul>
         @endif
         <ul class="navbar-nav ms-auto text-center">
            @if(Auth::user())
            <li class="nav-item">
               <a class="nav-link btn-log" href="{{ url('logout') }}">Logout</a>
            </li>
            @else
            <li class="nav-item">
               <a class="nav-link btn-log mar-btn-login" href="{{ url('/') }}">Login</a>
            </li>
            @endif
         </ul>
      </div>
   </div>
</nav>