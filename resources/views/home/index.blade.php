@extends('layouts.main')
@section('title', 'Anasayfa')
@section('bigTitle', 'Tayfun Güler')
@section('content')
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                @foreach($posts as $pt)
                    <div class="post-preview">
                        <a href="{{ URL::to('/yazi', $pt->slug)}}">
                            <h2 class="post-title">
                                {{$pt->title}}
                            </h2>
                        </a>
                        <p>
                            {!! strip_tags(htmlspecialchars_decode(Str::words($pt->detail, 18,'....')))  !!}
                        </p>
                        <p class="post-meta">Posted by {{optional($pt->getCategory)->title}} on {{ date('d M Y',  $pt->created_at->timestamp) }}</p>
                    </div>
                    <hr>
            @endforeach
            <!-- Pager -->
                <div class="clearfix">

                </div>
            </div>
        </div>
    </div>
@endsection
