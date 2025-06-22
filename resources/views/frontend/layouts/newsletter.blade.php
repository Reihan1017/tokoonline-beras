<!-- Mulai Newsletter Toko -->
<section class="shop-newsletter section">
    <div class="container">
        <div class="inner-top">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <!-- Mulai Bagian Dalam Newsletter -->
                    <div class="inner">
                        <h4>Newsletter</h4>
                        <p>Berlangganan newsletter kami dan dapatkan <span>diskon 10%</span> untuk pembelian pertama Anda</p>
                        <form action="{{route('subscribe')}}" method="post" class="newsletter-inner">
                            @csrf
                            <input name="email" placeholder="Masukkan alamat email Anda" required="" type="email">
                            <button class="btn" type="submit">Berlangganan</button>
                        </form>
                    </div>
                    <!-- Akhir Bagian Dalam Newsletter -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Akhir Newsletter Toko -->
