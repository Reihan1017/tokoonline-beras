@extends('frontend.layouts.master')

@section('title','Bayar Sekarang')

@section('main-content')
<div class="container text-center" style="margin-top: 50px;">
    <h2>Memproses Pembayaran...</h2>
</div>

<script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.clientKey') }}">
</script>

<script type="text/javascript">
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            window.location.href = "{{ route('payment.success') }}";
        },
        onPending: function(result){
            alert("Menunggu pembayaran selesai...");
        },
        onError: function(result){
            alert("Pembayaran gagal!");
        },
        onClose: function(){
            alert('Kamu menutup popup tanpa menyelesaikan pembayaran.');
        }
    });
</script>
@endsection
