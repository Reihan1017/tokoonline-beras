@extends('frontend.layouts.master')

@section('title','Pembayaran')

@section('main-content')

<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="{{route('home')}}">Beranda<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="javascript:void(0)">Checkout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->
<section class="shop checkout section">
    <div class="container">
        <form class="form" method="POST" action="{{route('cart.order')}}">
            @csrf
            <div class="row"> 
                <div class="col-lg-8 col-12">
                    <div class="checkout-form">
                        <h2>Silakan Lakukan Checkout di Sini</h2>
                        <p>Silakan daftar untuk memproses checkout lebih cepat</p>

                        <!-- Form -->
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Nama Depan<span>*</span></label>
                                    <input type="text" name="first_name" value="{{old('first_name')}}">
                                    @error('first_name')
                                        <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Nama Belakang<span>*</span></label>
                                    <input type="text" name="last_name" value="{{old('last_name')}}">
                                    @error('last_name')
                                        <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Alamat Email<span>*</span></label>
                                    <input type="email" name="email" value="{{old('email')}}">
                                    @error('email')
                                        <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Nomor Telepon<span>*</span></label>
                                    <input type="number" name="phone" required value="{{old('phone')}}">
                                    @error('phone')
                                        <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Wilayah<span>*</span></label>
                                    <select name="country" id="country">
                                        <option>Malangbong</option>
                                        <option>Barudua</option>
                                        <option>Bunisari</option>
                                        <option>Campaka</option>
                                        <option>Cibunar</option>
                                        <option>Cihaurkuning</option>
                                        <option>Cilampuyang</option>
                                        <option>Cikarag</option>
                                        <option>Cinagara</option>
                                        <option>Cisitu</option>
                                        <option>Citeras</option>
                                        <option>Karangmulya</option>
                                        <option>Kutanagara</option>
                                        <option>Lewobaru</option>
                                        <option>Mekarasih</option>
                                        <option>Mekarmulya</option>
                                        <option>Sakawayana</option>
                                        <option>Sanding</option>
                                        <option>Sekarwangi</option>
                                        <option>Sukajaya</option>
                                        <option>Sukamanah</option>
                                        <option>Sukarasa</option>
                                        <option>Sukaratu</option>
                                        <option>Girimakmur</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Alamat Baris 1<span>*</span></label>
                                    <input type="text" name="address1" value="{{old('address1')}}">
                                    @error('address1')
                                        <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Alamat Baris 2</label>
                                    <input type="text" name="address2" value="{{old('address2')}}">
                                    @error('address2')
                                        <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Kode Pos</label>
                                    <input type="text" name="post_code" value="{{old('post_code')}}">
                                    @error('post_code')
                                        <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!--/ End Form -->
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="order-details">
                        <!-- Order Widget -->
                        <div class="single-widget">
                            <h2>Total Keranjang</h2>
                            <div class="content">
                                <ul>
                                    <li class="order_subtotal" data-price="{{Helper::totalCartPrice()}}">
                                        Subtotal Keranjang
                                        <span>Rp{{ number_format(Helper::totalCartPrice(), 2, ',', '.') }}</span>
                                    </li>
                                    <li class="shipping">
                                        Ongkos Kirim
                                        @if(count(Helper::shipping())>0 && Helper::cartCount()>0)
                                            <select name="shipping" class="nice-select">
                                                <option value="">Pilih Pengantaran</option>
                                                @foreach(Helper::shipping() as $shipping)
                                                    <option value="{{$shipping->id}}" class="shippingOption" data-price="{{$shipping->price}}">
                                                        {{$shipping->type}}: Rp{{number_format($shipping->price,0,',','.')}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else 
                                            <span>Gratis</span>
                                        @endif
                                    </li>
                                            
                                            @if(session('coupon'))
                                            <li class="coupon_price" data-price="{{session('coupon')['value']}}">Kamu Hemat<span>Rp{{number_format(session('coupon')['value'],2)}}</span></li>
                                            @endif
                                            @php
                                                $total_amount=Helper::totalCartPrice();
                                                if(session('coupon')){
                                                    $total_amount=$total_amount-session('coupon')['value'];
                                                }
                                            @endphp
                                            @if(session('coupon'))
                                                <li class="last"  id="order_total_price">Total<span>Rp{{number_format($total_amount,2)}}</span></li>
                                            @else
                                                <li class="last"  id="order_total_price">Total<span>Rp{{number_format($total_amount,2)}}</span></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <!--/ End Order Widget -->
                                <!-- Order Widget -->
                                <div class="single-widget">
                                    <h2>Metode Pembayaran</h2>
                                    <div class="content">
                                        <div class="checkbox">
                                            {{-- <label class="checkbox-inline" for="1"><input name="updates" id="1" type="checkbox"> Check Payments</label> --}}
                                            <form-group>
                                                <input name="payment_method" type="radio" value="cod" checked> <label>Bayar di Tempat</label><br>
                                                <input name="payment_method" type="radio" value="midtrans"> <label>Bayar Transfer</label>                                                
                                            </form-group>
                                            
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Order Widget -->
                                <!-- Payment Method Widget -->
                                <div class="single-widget payement">
                                    <div class="content">
                                    </div>
                                </div>
                                <!--/ End Payment Method Widget -->
                                <!-- Button Widget -->
                                <div class="single-widget get-button">
                                    <div class="content">
                                        <div class="button">
                                            <a href="{{ route('midtrans.payment') }}" class="btn btn-primary">Bayar Sekarang</a>
                                        </div>
                                    </div>
                                </div>                                
                                <!--/ End Button Widget -->
                            </div>
                        </div>
                    </div>
                </form>
        </div>
    </section>
    <!--/ End Checkout -->
@endsection
@push('styles')
	<style>
		li.shipping{
			display: inline-flex;
			width: 100%;
			font-size: 14px;
		}
		li.shipping .input-group-icon {
			width: 100%;
			margin-left: 10px;
		}
		.input-group-icon .icon {
			position: absolute;
			left: 20px;
			top: 0;
			line-height: 40px;
			z-index: 3;
		}
		.form-select {
			height: 30px;
			width: 100%;
		}
		.form-select .nice-select {
			border: none;
			border-radius: 0px;
			height: 40px;
			background: #f6f6f6 !important;
			padding-left: 45px;
			padding-right: 40px;
			width: 100%;
		}
		.list li{
			margin-bottom:0 !important;
		}
		.list li:hover{
			background:#F7941D !important;
			color:white !important;
		}
		.form-select .nice-select::after {
			top: 14px;
		}
	</style>
@endpush
@push('scripts')
	<script src="{{asset('frontend/js/nice-select/js/jquery.nice-select.min.js')}}"></script>
	<script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
	<script>
		$(document).ready(function() { $("select.select2").select2(); });
  		$('select.nice-select').niceSelect();
	</script>
	<script>
		function showMe(box){
			var checkbox=document.getElementById('shipping').style.display;
			// alert(checkbox);
			var vis= 'none';
			if(checkbox=="none"){
				vis='block';
			}
			if(checkbox=="block"){
				vis="none";
			}
			document.getElementById(box).style.display=vis;
		}
	</script>
	<script>
		$(document).ready(function(){
			$('.shipping select[name=shipping]').change(function(){
				let cost = parseFloat( $(this).find('option:selected').data('price') ) || 0;
				let subtotal = parseFloat( $('.order_subtotal').data('price') ); 
				let coupon = parseFloat( $('.coupon_price').data('price') ) || 0; 
				// alert(coupon);
                                let total = subtotal + cost - coupon;
                $('#order_total_price span').text(
                total.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                })
                );

			});

		});

	</script>

@endpush