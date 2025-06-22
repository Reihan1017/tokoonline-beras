<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\PostComment;
use App\Rules\MatchOldPassword;
use Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index(){
        return view('user.index');
    }

    public function profile(){
        $profile=Auth()->user();
        // return $profile;
        return view('user.users.profile')->with('profile',$profile);
    }

    public function profileUpdate(Request $request, $id){
        // mengembalikan semua data request
        $user = User::findOrFail($id);
        $data = $request->all();
        $status = $user->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'Profil Anda berhasil diperbarui');
        } else {
            request()->session()->flash('error', 'Silakan coba lagi!');
        }
        return redirect()->back();
    }
    
    // Order
    public function orderIndex(){
        $orders = Order::orderBy('id', 'DESC')->where('user_id', auth()->user()->id)->paginate(10);
        return view('user.order.index')->with('orders', $orders);
    }
    
    public function userOrderDelete($id){
        $order = Order::find($id);
        if ($order) {
            if ($order->status == "process" || $order->status == 'delivered' || $order->status == 'cancel') {
                return redirect()->back()->with('error', 'Pesanan ini tidak dapat dihapus saat ini');
            } else {
                $status = $order->delete();
                if ($status) {
                    request()->session()->flash('success', 'Pesanan berhasil dihapus');
                } else {
                    request()->session()->flash('error', 'Pesanan tidak dapat dihapus');
                }
                return redirect()->route('user.order.index');
            }
        } else {
            request()->session()->flash('error', 'Pesanan tidak ditemukan');
            return redirect()->back();
        }
    }
    
    public function orderShow($id){
        $order = Order::find($id);
        // mengembalikan detail pesanan
        return view('user.order.show')->with('order', $order);
    }
    
    // Product Review
    public function productReviewIndex(){
        $reviews = ProductReview::getAllUserReview();
        return view('user.review.index')->with('reviews', $reviews);
    }
    
    public function productReviewEdit($id){
        $review = ProductReview::find($id);
        // mengembalikan review yang dipilih
        return view('user.review.edit')->with('review', $review);
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productReviewUpdate(Request $request, $id)
    {
        $review = ProductReview::find($id);
        if ($review) {
            $data = $request->all();
            $status = $review->fill($data)->update();
            if ($status) {
                request()->session()->flash('success', 'Ulasan berhasil diperbarui');
            } else {
                request()->session()->flash('error', 'Terjadi kesalahan! Silakan coba lagi!');
            }
        } else {
            request()->session()->flash('error', 'Ulasan tidak ditemukan!');
        }
    
        return redirect()->route('user.productreview.index');
    }
    
    public function productReviewDelete($id)
    {
        $review = ProductReview::find($id);
        $status = $review->delete();
        if ($status) {
            request()->session()->flash('success', 'Ulasan berhasil dihapus');
        } else {
            request()->session()->flash('error', 'Terjadi kesalahan! Silakan coba lagi');
        }
        return redirect()->route('user.productreview.index');
    }
    
    public function userComment()
    {
        $comments = PostComment::getAllUserComments();
        return view('user.comment.index')->with('comments', $comments);
    }
    
    public function userCommentDelete($id)
    {
        $comment = PostComment::find($id);
        if ($comment) {
            $status = $comment->delete();
            if ($status) {
                request()->session()->flash('success', 'Komentar berhasil dihapus');
            } else {
                request()->session()->flash('error', 'Terjadi kesalahan, silakan coba lagi');
            }
            return back();
        } else {
            request()->session()->flash('error', 'Komentar tidak ditemukan');
            return redirect()->back();
        }
    }
    
    public function userCommentEdit($id)
    {
        $comments = PostComment::find($id);
        if ($comments) {
            return view('user.comment.edit')->with('comment', $comments);
        } else {
            request()->session()->flash('error', 'Komentar tidak ditemukan');
            return redirect()->back();
        }
    }
    
    public function userCommentUpdate(Request $request, $id)
    {
        $comment = PostComment::find($id);
        if ($comment) {
            $data = $request->all();
            $status = $comment->fill($data)->update();
            if ($status) {
                request()->session()->flash('success', 'Komentar berhasil diperbarui');
            } else {
                request()->session()->flash('error', 'Terjadi kesalahan! Silakan coba lagi!');
            }
            return redirect()->route('user.post-comment.index');
        } else {
            request()->session()->flash('error', 'Komentar tidak ditemukan');
            return redirect()->back();
        }
    }
    
    public function changePassword(){
        return view('user.layouts.userPasswordChange');
    }
    
    public function changPasswordStore(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
    
        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
    
        return redirect()->route('user')->with('success', 'Kata sandi berhasil diubah');
    }
    

    
}
