@foreach($comments as $comment)
@php $dep = $depth - 1; @endphp
<div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
    <div class="comment-list">
        <div class="single-comment">
            @if($comment->user_info['photo'])
                <img src="{{$comment->user_info['photo']}}" alt="Foto Pengguna">
            @else 
                <img src="{{asset('backend/img/avatar.png')}}" alt="Avatar Default">
            @endif
            <div class="content">
                <h4>{{$comment->user_info['name']}} 
                    <span>Pada {{ $comment->created_at->format('H:i') }} tanggal {{ $comment->created_at->format('d M Y') }}</span>
                </h4>
                <p>{{$comment->comment}}</p>
                @if($dep)
                <div class="button">
                    <a href="#" class="btn btn-reply reply" data-id="{{$comment->id}}">
                        <i class="fa fa-reply" aria-hidden="true"></i>Balas
                    </a>
                    <a href="#" class="btn btn-reply cancel" style="display: none;">
                        <i class="fa fa-trash" aria-hidden="true"></i>Batal
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
    @include('frontend.pages.comment', ['comments' => $comment->replies, 'depth' => $dep])
</div>
@endforeach
