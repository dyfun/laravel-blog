@extends('layouts.main')
@section('title', '' . $cat->title . '')
@section('bigTitle', '' . $cat->title . '')
@section('content')
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                @if(count($post) == 0)
                    <p>Henüz içerik eklenmemiş.</p>
                @endif

                @foreach($post as $pt)
                    <div class="post-preview">
                        <a href="{{ URL::to('/yazi', $pt->slug)}}">
                            <h2 class="post-title">
                                {{$pt->title}}
                            </h2>
                        </a>
                        <p>
                            {!! strip_tags(htmlspecialchars_decode(Str::words($pt->detail, 18,'....')))  !!}
                        </p>
                        <p class="post-meta">Posted by {{ $cat->title }} on {{ date('d M Y',  $pt->created_at->timestamp) }}</p>
                    </div>
                    <hr>
                @endforeach
                <!-- Pager -->
                <div class="clearfix">
                    {{ $post->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
