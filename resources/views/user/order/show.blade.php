@extends('user.layouts.master')

@section('title','Detail Pesanan')

@section('main-content')
<div class="card">
  <h5 class="card-header">Pesanan</h5>
  <div class="card-body">
    @if($order)
    <table class="table table-striped table-hover">
      <thead>
        <tr>
            <th>No</th>
            <th>No. Pesanan</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jumlah</th>
            <th>Jenis Pengiriman</th>
            <th>Total Bayar</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td>{{$order->id}}</td>
            <td>{{$order->order_number}}</td>
            <td>{{$order->first_name}} {{$order->last_name}}</td>
            <td>{{$order->email}}</td>
            <td>{{$order->quantity}}</td>
            <td>
              @if($order->shipping)
                  Rp{{ number_format($order->shipping->price, 0, ',', '.') }}
              @else
              @endif
          </td>                     
            <td>Rp{{number_format($order->total_amount,2, ',', '.')}}</td>
            <td>
                @if($order->status=='new')
                  <span class="badge badge-primary">Baru</span>
                @elseif($order->status=='process')
                  <span class="badge badge-warning">Diproses</span>
                @elseif($order->status=='delivered')
                  <span class="badge badge-success">Terkirim</span>
                @else
                  <span class="badge badge-danger">{{$order->status}}</span>
                @endif
            </td>
            <td>
                <form method="POST" action="{{route('order.destroy',[$order->id])}}">
                  @csrf
                  @method('delete')
                  <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                </form>
            </td>
        </tr>
      </tbody>
    </table>

    <section class="confirmation_part section_padding">
      <div class="order_boxes">
        <div class="row">
          <!-- Informasi Pesanan -->
          <div class="col-lg-6 col-lx-4">
            <div class="order-info">
              <h4 class="text-center pb-4">INFORMASI PESANAN</h4>
              <table class="table">
                <tr>
                    <td>No. Pesanan</td>
                    <td>: {{$order->order_number}}</td>
                </tr>
                <tr>
                    <td>Tanggal Pesanan</td>
                    <td>: {{$order->created_at->format('D d M, Y')}} pukul {{$order->created_at->format('g : i a')}}</td>
                </tr>
                <tr>
                    <td>Jumlah</td>
                    <td>: {{$order->quantity}}</td>
                </tr>
                <tr>
                    <td>Status Pesanan</td>
                    <td>: {{$order->status}}</td>
                </tr>
                <tr>
                  <th>Jenis Pengiriman</th>
                    <td>: 
                      @if($order->shipping)
                      Rp{{ number_format($order->shipping->price, 0, ',', '.') }}
                  @else
                  @endif
                    </td>
                </tr>
                <tr>
                    <td>Total Bayar</td>
                    <td>: Rp {{number_format($order->total_amount,2, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>Metode Pembayaran</td>
                    <td>: @if($order->payment_method=='cod') Bayar di Tempat @else Transfer @endif</td>
                </tr>
                <tr>
                    <td>Status Pembayaran</td>
                    <td>: {{$order->payment_status}}</td>
                </tr>
              </table>
            </div>
          </div>

          <!-- Informasi Pengiriman -->
          <div class="col-lg-6 col-lx-4">
            <div class="shipping-info">
              <h4 class="text-center pb-4">INFORMASI PENGIRIMAN</h4>
              <table class="table">
                <tr>
                    <td>Nama Lengkap</td>
                    <td>: {{$order->first_name}} {{$order->last_name}}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>: {{$order->email}}</td>
                </tr>
                <tr>
                    <td>No. Telepon</td>
                    <td>: {{$order->phone}}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: {{$order->address1}}, {{$order->address2}}</td>
                </tr>
                <tr>
                    <td>Wilayah</td>
                    <td>: {{$order->country}}</td>
                </tr>
                <tr>
                    <td>Kode Pos</td>
                    <td>: {{$order->post_code}}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    @endif
  </div>
</div>
@endsection


@push('styles')
<style>
    .order-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.shipping-info h4{
        text-decoration: underline;
    }

</style>
@endpush
