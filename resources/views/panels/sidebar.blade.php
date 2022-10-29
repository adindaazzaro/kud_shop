<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-secondary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link border-bottom py-4">
      <img src="{{asset('image/setting/'.$setting->logo)}}" alt="{{$setting->nama}}" class="brand-image" style="opacity: .8">
      <span class="brand-text font-weight-bold text-primary">{{$setting->nama}}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar mt-4">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header font-weight-bold">DASHBOARD</li>
          <li class="nav-item">
            <a href="{{url('admin/home')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Beranda
              </p>
            </a>
          </li>
          
          <li class="nav-header font-weight-bold">MENU UTAMA</li>
          <li class="nav-item">
            <a href="{{route('admin.obat.index')}}" class="nav-link">
              <i class="nav-icon far fa-list-alt"></i>
              <p>
                Obat
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.kategori-obat.index')}}" class="nav-link">
              <i class="nav-icon far fa-list-alt"></i>
              <p>
                Kategori Obat
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.pelanggan.index')}}" class="nav-link">
              <i class="nav-icon far fa-list-alt"></i>
              <p>
                Pelanggan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/htransaksi')}}" class="nav-link">
              <i class="nav-icon far fa-list-alt"></i>
              <p>
                Riwayat Transaksi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.pengguna.index')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Pengguna
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{url('admin/pengaturan')}}" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Pengaturan
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>