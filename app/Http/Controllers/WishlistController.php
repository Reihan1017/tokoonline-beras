<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    protected $product = null;

    public function __construct(Product $product){
        $this->product = $product;
    }

    public function wishlist(Request $request){
        if (empty($request->slug)) {
            request()->session()->flash('error', 'Produk tidak valid');
            return back();
        }        

        $product = Product::where('slug', $request->slug)->first();
        if (empty($product)) {
            request()->session()->flash('error', 'Produk tidak ditemukan');
            return back();
        }

        $already_wishlist = Wishlist::where('user_id', auth()->user()->id)
            ->where('cart_id', null)
            ->where('product_id', $product->id)
            ->first();

        if ($already_wishlist) {
            request()->session()->flash('error', 'Produk sudah ada di daftar keinginan');
            return back();
        } else {
            $wishlist = new Wishlist;
            $wishlist->user_id = auth()->user()->id;
            $wishlist->product_id = $product->id;
            $wishlist->price = ($product->price - ($product->price * $product->discount) / 100);
            $wishlist->quantity = 1;
            $wishlist->amount = $wishlist->price * $wishlist->quantity;

            if ($wishlist->product->stock < $wishlist->quantity || $wishlist->product->stock <= 0) {
                return back()->with('error', 'Stok tidak mencukupi!');
            }

            $wishlist->save();
        }

        request()->session()->flash('success', 'Produk berhasil ditambahkan ke daftar keinginan');
        return back();       
    }  
    
    public function wishlistDelete(Request $request){
        $wishlist = Wishlist::find($request->id);
        if ($wishlist) {
            $wishlist->delete();
            request()->session()->flash('success', 'Produk berhasil dihapus dari daftar keinginan');
            return back();  
        }

        request()->session()->flash('error', 'Terjadi kesalahan, silakan coba lagi');
        return back();       
    }     
}
