@extends('frontend.layouts.master')
@section('title','Keranjang')
@section('main-content')
	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{('home')}}">Beranda<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="">Keranjang</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->

	<!-- Shopping Cart -->
	<div class="shopping-cart section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- Ringkasan Belanja -->
<table class="table shopping-summery">
    <thead>
        <tr class="main-hading">
            <th>PRODUK</th>
            <th>NAMA</th>
            <th class="text-center">HARGA SATUAN</th>
            <th class="text-center">JUMLAH</th>
            <th class="text-center">TOTAL</th>
            <th class="text-center"><i class="ti-trash remove-icon"></i></th>
        </tr>
    </thead>
    <tbody id="cart_item_list">
        <form action="{{route('cart.update')}}" method="POST">
            @csrf
            @if(Helper::getAllProductFromCart())
                @foreach(Helper::getAllProductFromCart() as $key=>$cart)
                    <tr>
                        @php
                        $photo=explode(',',$cart->product['photo']);
                        @endphp
                        <td class="image" data-title="No"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></td>
                        <td class="product-des" data-title="Deskripsi">
                            <p class="product-name"><a href="{{route('product-detail',$cart->product['slug'])}}" target="_blank">{{$cart->product['title']}}</a></p>
                            <p class="product-des">{!!($cart['summary']) !!}</p>
                        </td>
                        <td class="price" data-title="Harga"><span>Rp{{number_format($cart['price'],2)}}</span></td>
                        <td class="qty" data-title="Jumlah">
                            <div class="input-group">
                                <div class="button minus">
                                    <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[{{$key}}]">
                                        <i class="ti-minus"></i>
                                    </button>
                                </div>
                                <input type="text" name="quant[{{$key}}]" class="input-number" data-min="1" data-max="100" value="{{$cart->quantity}}">
                                <input type="hidden" name="qty_id[]" value="{{$cart->id}}">
                                <div class="button plus">
                                    <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[{{$key}}]">
                                        <i class="ti-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="total-amount cart_single_price" data-title="Total"><span class="money">Rp{{number_format($cart['amount'],2)}}</span></td>
                        <td class="action" data-title="Hapus"><a href="{{route('cart-delete',$cart->id)}}"><i class="ti-trash remove-icon"></i></a></td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="6" class="text-right">
                        <button class="btn float-right" type="submit">Perbarui</button>
                    </td>
                </tr>
            @else
                <tr>
                    <td class="text-center" colspan="6">
                        Keranjang belanja kosong. <a href="{{route('product-grids')}}" style="color:blue;">Lanjutkan belanja</a>
                    </td>
                </tr>
            @endif
        </form>
    </tbody>
</table>
<!--/ Akhir Ringkasan Belanja -->

<!-- Total Harga -->
<div class="total-amount">
    <div class="row">
        <div class="col-lg-8 col-md-5 col-12">
            <div class="left">
                <div class="coupon">
                    <form action="{{route('coupon-store')}}" method="POST">
                        @csrf
                        <input name="code" placeholder="Masukkan Kode Kupon">
                        <button class="btn">Gunakan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-7 col-12">
            <div class="right">
                <ul>
                    <li class="order_subtotal" data-price="{{Helper::totalCartPrice()}}">
                        Subtotal Keranjang
                        <span>Rp{{number_format(Helper::totalCartPrice(),2)}}</span>
                    </li>

                    @if(session()->has('coupon'))
                        <li class="coupon_price" data-price="{{Session::get('coupon')['value']}}">
                            Anda Hemat
                            <span>Rp{{number_format(Session::get('coupon')['value'],2)}}</span>
                        </li>
                    @endif

                    @php
                        $total_amount=Helper::totalCartPrice();
                        if(session()->has('coupon')){
                            $total_amount=$total_amount-Session::get('coupon')['value'];
                        }
                    @endphp

                    <li class="last" id="order_total_price">
                        Total Bayar
                        <span>Rp{{number_format($total_amount,2)}}</span>
                    </li>
                </ul>
                <div class="button5">
                    <a href="{{route('checkout')}}" class="btn">Lanjut ke Pembayaran</a>
                    <a href="{{route('product-grids')}}" class="btn">Lanjutkan Belanja</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Akhir Total Harga -->

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
			background:rgb(107, 88, 247) 29, 247) !important;
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
		$(document).ready(function(){
			$('.shipping select[name=shipping]').change(function(){
				let cost = parseFloat( $(this).find('option:selected').data('price') ) || 0;
				let subtotal = parseFloat( $('.order_subtotal').data('price') );
				let coupon = parseFloat( $('.coupon_price').data('price') ) || 0;
				// alert(coupon);
				$('#order_total_price span').text('$'+(subtotal + cost-coupon).toFixed(2));
			});

		});

	</script>

@endpush
