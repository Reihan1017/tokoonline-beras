<header class="header shop">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Kiri Atas -->
                    <div class="top-left">
                        <ul class="list-main">
                            @php
                                $settings=DB::table('settings')->get();
                            @endphp
                            <li><i class="ti-headphone-alt"></i>@foreach($settings as $data) {{$data->phone}} @endforeach</li>
                            <li><i class="ti-email"></i> @foreach($settings as $data) {{$data->email}} @endforeach</li>
                        </ul>
                    </div>
                    <!--/ Akhir Kiri Atas -->
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Kanan Atas -->
                    <div class="right-content">
                        <ul class="list-main">
                            <li><i class="ti-location-pin"></i> <a href="{{route('order.track')}}">Lacak Pesanan</a></li>
                            @auth 
                                @if(Auth::user()->role=='admin')
                                    <li><i class="ti-user"></i> <a href="{{route('admin')}}" target="_blank">Dashboard Admin</a></li>
                                @else 
                                    <li><i class="ti-user"></i> <a href="{{route('user')}}" target="_blank">Dashboard Pengguna</a></li>
                                @endif
                                <li><i class="ti-power-off"></i> <a href="{{route('user.logout')}}">Keluar</a></li>
                            @else
                                <li><i class="ti-power-off"></i><a href="{{route('login.form')}}">Masuk /</a> <a href="{{route('register.form')}}">Daftar</a></li>
                            @endauth
                        </ul>
                    </div>
                    <!-- Akhir Kanan Atas -->
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Topbar -->

    <div class="middle-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">


                    <!-- Form Pencarian -->
                    <div class="search-top">
                        <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                        <div class="search-top">
                            <form class="search-form">
                                <input type="text" placeholder="Cari di sini..." name="search">
                                <button value="search" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <!--/ Akhir Form Pencarian -->
                    <div class="mobile-nav"></div>
                </div>

                <div class="col-lg-8 col-md-7 col-12">
                    <div class="search-bar-top">
                        <div class="search-bar">
                            <select>
                                <option>Kategori</option>
                                @foreach(Helper::getAllCategory() as $cat)
                                    <option>{{$cat->title}}</option>
                                @endforeach
                            </select>
                            <form method="POST" action="{{route('product.search')}}">
                                @csrf
                                <input name="search" placeholder="Cari Produk Di Sini..." type="search">
                                <button class="btnn" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-12">
                    <div class="right-bar">
                        <!-- Wishlist -->
                        <div class="sinlge-bar shopping">
                            @php 
                                $total_prod=0;
                                $total_amount=0;
                            @endphp
                            @if(session('wishlist'))
                                @foreach(session('wishlist') as $wishlist_items)
                                    @php
                                        $total_prod+=$wishlist_items['quantity'];
                                        $total_amount+=$wishlist_items['amount'];
                                    @endphp
                                @endforeach
                            @endif
                            <a href="{{route('wishlist')}}" class="single-icon"><i class="fa fa-heart-o"></i> <span class="total-count">{{Helper::wishlistCount()}}</span></a>

                            <!-- Daftar Wishlist -->
                            @auth
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>{{count(Helper::getAllProductFromWishlist())}} Barang</span>
                                        <a href="{{route('wishlist')}}">Lihat Wishlist</a>
                                    </div>
                                    <ul class="shopping-list">
                                        @foreach(Helper::getAllProductFromWishlist() as $data)
                                            @php $photo=explode(',',$data->product['photo']); @endphp
                                            <li>
                                                <a href="{{route('wishlist-delete',$data->id)}}" class="remove" title="Hapus item ini"><i class="fa fa-remove"></i></a>
                                                <a class="cart-img" href="#"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></a>
                                                <h4><a href="{{route('product-detail',$data->product['slug'])}}" target="_blank">{{$data->product['title']}}</a></h4>
                                                <p class="quantity">{{$data->quantity}} x - <span class="amount">Rp {{number_format($data->price,0,',','.')}}</span></p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">Rp {{number_format(Helper::totalWishlistPrice(),0,',','.')}}</span>
                                        </div>
                                        <a href="{{route('cart')}}" class="btn animate">Keranjang</a>
                                    </div>
                                </div>
                            @endauth
                        </div>

                        <!-- Keranjang Belanja -->
                        <div class="sinlge-bar shopping">
                            <a href="{{route('cart')}}" class="single-icon"><i class="ti-bag"></i> <span class="total-count">{{Helper::cartCount()}}</span></a>

                            @auth
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>{{count(Helper::getAllProductFromCart())}} Barang</span>
                                        <a href="{{route('cart')}}">Lihat Keranjang</a>
                                    </div>
                                    <ul class="shopping-list">
                                        @foreach(Helper::getAllProductFromCart() as $data)
                                            @php $photo=explode(',',$data->product['photo']); @endphp
                                            <li>
                                                <a href="{{route('cart-delete',$data->id)}}" class="remove" title="Hapus item ini"><i class="fa fa-remove"></i></a>
                                                <a class="cart-img" href="#"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></a>
                                                <h4><a href="{{route('product-detail',$data->product['slug'])}}" target="_blank">{{$data->product['title']}}</a></h4>
                                                <p class="quantity">{{$data->quantity}} x - <span class="amount">Rp {{number_format($data->price,0,',','.')}}</span></p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">Rp {{number_format(Helper::totalCartPrice(),0,',','.')}}</span>
                                        </div>
                                        <a href="{{route('checkout')}}" class="btn animate">Bayar Sekarang</a>
                                    </div>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigasi Menu -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="menu-area">
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">	
                                    <div class="nav-inner">	
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li class="{{Request::path()=='home' ? 'active' : ''}}"><a href="{{route('home')}}">Beranda</a></li>
                                            <li class="{{Request::path()=='about-us' ? 'active' : ''}}"><a href="{{route('about-us')}}">Tentang Kami</a></li>
                                            <li class="@if(Request::path()=='product-grids'||Request::path()=='product-lists')  active  @endif"><a href="{{route('product-grids')}}">Produk</a><span class="new">Baru</span></li>											
                                                {{Helper::getHeaderCategory()}}										
                                            <li class="{{Request::path()=='contact' ? 'active' : ''}}"><a href="{{route('contact')}}">Kontak</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
