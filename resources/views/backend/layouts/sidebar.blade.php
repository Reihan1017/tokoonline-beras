<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin')}}">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Admin</div>
  </a>

  <!-- Garis Pemisah -->
  <hr class="sidebar-divider my-0">

  <!-- Item Navigasi - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="{{route('admin')}}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Garis Pemisah -->
  <hr class="sidebar-divider">

  <!-- Judul -->
  <div class="sidebar-heading">
      Banner
  </div>

  <!-- Item Navigasi - Media Manager -->
  <li class="nav-item">
      <a class="nav-link" href="{{route('file-manager')}}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Pengelola Media</span></a>
  </li>

  <!-- Item Navigasi - Banner -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-image"></i>
      <span>Banner</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Opsi Banner:</h6>
        <a class="collapse-item" href="{{route('banner.index')}}">Daftar Banner</a>
        <a class="collapse-item" href="{{route('banner.create')}}">Tambah Banner</a>
      </div>
    </div>
  </li>

  <!-- Garis Pemisah -->
  <hr class="sidebar-divider">

  <!-- Judul -->
  <div class="sidebar-heading">
      Toko
  </div>

  <!-- Kategori -->
  <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categoryCollapse" aria-expanded="true" aria-controls="categoryCollapse">
        <i class="fas fa-sitemap"></i>
        <span>Kategori</span>
      </a>
      <div id="categoryCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Opsi Kategori:</h6>
          <a class="collapse-item" href="{{route('category.index')}}">Daftar Kategori</a>
          <a class="collapse-item" href="{{route('category.create')}}">Tambah Kategori</a>
        </div>
      </div>
  </li>

 {{-- Merek --}}
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#brandCollapse" aria-expanded="true" aria-controls="brandCollapse">
    <i class="fas fa-table"></i>
    <span>Merek</span>
  </a>
  <div id="brandCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Opsi Merek:</h6>
      <a class="collapse-item" href="{{route('brand.index')}}">Daftar Merek</a>
      <a class="collapse-item" href="{{route('brand.create')}}">Tambah Merek</a>
    </div>
  </div>
</li>

{{-- Produk --}}
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#productCollapse" aria-expanded="true" aria-controls="productCollapse">
    <i class="fas fa-cubes"></i>
    <span>Produk</span>
  </a>
  <div id="productCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Opsi Produk:</h6>
      <a class="collapse-item" href="{{route('product.index')}}">Daftar Produk</a>
      <a class="collapse-item" href="{{route('product.create')}}">Tambah Produk</a>
    </div>
  </div>
</li>

{{-- Pengiriman --}}
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#shippingCollapse" aria-expanded="true" aria-controls="shippingCollapse">
    <i class="fas fa-truck"></i>
    <span>Pengiriman</span>
  </a>
  <div id="shippingCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Opsi Pengiriman:</h6>
      <a class="collapse-item" href="{{route('shipping.index')}}">Daftar Pengiriman</a>
      <a class="collapse-item" href="{{route('shipping.create')}}">Tambah Pengiriman</a>
    </div>
  </div>
</li>

<!-- Pesanan -->
<li class="nav-item">
  <a class="nav-link" href="{{route('order.index')}}">
      <i class="fas fa-hammer fa-chart-area"></i>
      <span>Pesanan</span>
  </a>
</li>

<!-- Ulasan -->
<li class="nav-item">
  <a class="nav-link" href="{{route('review.index')}}">
      <i class="fas fa-comments"></i>
      <span>Ulasan</span>
  </a>
</li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
     <!-- Heading -->
    <div class="sidebar-heading">
      Pengaturan Umum
    </div>
     <!-- Users -->
     <li class="nav-item">
        <a class="nav-link" href="{{route('users.index')}}">
            <i class="fas fa-users"></i>
            <span>Pengguna</span></a>
    </li>
     <!-- General settings -->
     <li class="nav-item">
        <a class="nav-link" href="{{route('settings')}}">
            <i class="fas fa-cog"></i>
            <span>Pengaturan</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>