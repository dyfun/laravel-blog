@extends('layouts.main')
@section('title',  '' . $post->title . '')
@section('bigTitle', '' . $post->title . '')
@section('content')
    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto mt-5">
                    <img src="{{asset($post->thumbnail)}}" alt="" class="img-fluid mb-5">
                    {!! $post->detail !!}
                </div>
                <hr>
                <div class="col-lg-10 col-md-10 mx-auto mt-5">
                    <div class="comments">
                        <h3>Yorum Yap</h3>
                        <div class="comment-list mt-5">
                            <div class="card-list">
                                @foreach($comments as $comment)
                                    <div class="card col-lg-12 mt-2">
                                        <div class="card-body">
                                            {{$comment->comment}} <small class="float-right">by {{optional($comment->getUser)->name}}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="create-comment mt-5">
                                @if(Auth::check())
                                    <form action="{{ route('comment_store') }}" method="POST">
                                        @csrf
                                        <textarea name="comment" id="" cols="10" rows="5" class="form-control" required></textarea>
                                        <button class="btn btn-dark float-right mt-2" type="submit">Yorum Yap</button>
                                        <input type="text" name="post_id" value="{{$post->id}}" hidden>
                                        <input type="text" name="user_id" value="{{Auth::user()->id}}" hidden>
                                    </form>
                                @else
                                    <p>Yorum yapmak için üye girişi yapmalısınız.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection
