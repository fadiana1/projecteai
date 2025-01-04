 <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
     <div class="app-brand demo" style="margin-top: 10px;">
         <a href="/" class="app-brand-link">
             <img src="{{ asset('assets/fe/img/logo.png') }}" style="max-width: 80%;">
         </a>

         <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
             <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
             <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
         </a>
     </div>

     <div class="menu-inner-shadow"></div>

     <ul class="menu-inner py-1">
         <!-- Apps & Pages -->
         <li class="menu-item {{ request()->is('v1') ? 'active' : '' }}">
             <a href="{{ route('dashboard') }}" class="menu-link">
                 <i class="menu-icon tf-icons ti ti-home"></i>
                 <div data-i18n="Email">Dashboard</div>
             </a>
         </li>

         @if (auth()->user()->role == 'admin')
             <li class="menu-header small text-uppercase">
                 <span class="menu-header-text">Admin Tools</span>
             </li>
             <li class="menu-item {{ request()->is('v1/ekspedisi*') ? 'active' : '' }}">
                 <a href="{{ route('admin.ekspedisi.index') }}" class="menu-link">
                     <i class="menu-icon tf-icons ti ti-truck"></i>
                     <div data-i18n="Ekspedisi">Ekspedisi</div>
                 </a>
             </li>
             <li class="menu-item {{ request()->is('v1/tani*') ? 'active' : '' }}">
                 <a href="{{ route('admin.tani.index') }}" class="menu-link">
                     <i class="menu-icon tf-icons ti ti-user"></i>
                     <div data-i18n="Kelompok Tani">Kelompok Tani</div>
                 </a>
             </li>
             <li class="menu-item {{ request()->is('v1/user*') ? 'active' : '' }}">
                 <a href="{{ route('admin.user.index') }}" class="menu-link">
                     <i class="menu-icon tf-icons ti ti-user"></i>
                     <div data-i18n="Kelola User">Kelola User</div>
                 </a>
             </li>
             <li class="menu-item {{ request()->is('v1/stock*') ? 'active' : '' }}">
                 <a href="{{ route('admin.stock') }}" class="menu-link">
                     <i class="menu-icon tf-icons ti ti-box"></i>
                     <div data-i18n="Kelola Stock">Kelola Stock</div>
                 </a>
             </li>
             <li class="menu-item {{ request()->is('v1/galery*') ? 'active' : '' }}">
                 <a href="{{ route('admin.galery.index') }}" class="menu-link">
                     <i class="menu-icon tf-icons ti ti-files"></i>
                     <div data-i18n="Kelola Galery">Kelola Galery</div>
                 </a>
             </li>
             <li class="menu-item {{ request()->is('v1/banner*') ? 'active' : '' }}">
                 <a href="{{ route('admin.banner.index') }}" class="menu-link">
                     <i class="menu-icon tf-icons ti ti-files"></i>
                     <div data-i18n="Kelola Banner">Kelola Banner</div>
                 </a>
             </li>
         @endif


         @if (auth()->user()->role == 'tani' || auth()->user()->role == 'admin')
             <li class="menu-header small text-uppercase">
                 <span class="menu-header-text">Tani Tools</span>
             </li>
             <li class="menu-item {{ request()->is('v1/product*') ? 'active' : '' }}">
                 <a href="{{ route('admin.product.index') }}" class="menu-link">
                     <i class="menu-icon tf-icons ti ti-box"></i>
                     <div data-i18n="Kelola Product">Kelola Product</div>
                 </a>
             </li>
             <li class="menu-item {{ request()->is('v1/order-masuk*') ? 'active' : '' }}">
                 <a href="{{ route('admin.order-masuk') }}" class="menu-link">
                     <i class="menu-icon tf-icons ti ti-shopping-cart"></i>
                     <div data-i18n="Orderan Masuk">Orderan Masuk</div>
                 </a>
             </li>
             <li class="menu-item {{ request()->is('v1/order-selesai*') ? 'active' : '' }}">
                 <a href="{{ route('admin.order-selesai') }}" class="menu-link">
                     <i class="menu-icon tf-icons ti ti-shopping-cart"></i>
                     <div data-i18n="Orderan Selesai">Orderan Selesai</div>
                 </a>
             </li>
         @endif

     </ul>
 </aside>
