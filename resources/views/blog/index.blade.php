@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mb-5">
                @if (!$posts->count())
                    <div class="alert alert-danger text-center">
                        <p><strong>Nothing Found :(</strong></p>
                    </div>
                    <img src="{{ asset('img/404.svg') }}" width="90%" alt="">
                @else
                    @if (isset($categoryName))
                        <div class="alert alert-info text-center">
                            <p><strong>Category: {{ $categoryName }}</strong></p>
                        </div>
                    @endif
                    @foreach ($posts as $post)
                        <article class="post-item">
                            @if ($post->image_url)
                                <div class="post-item-image">
                                    <a href="{{ route('show.blog.post', $post->slug) }}">
                                        <img src="{{ $post->image_url }}" alt="">
                                    </a>
                                </div>
                            @endif
                            <div class="post-item-body">
                                <div class="padding-10">
                                    <h2><a href="{{ route('show.blog.post', $post->slug) }}">{{ $post->title }}</a></h2>
                                    {{-- Created a new accessor in the post model to display
                                    the
                                    post body --}}
                                    {!! $post->excerpt_html !!}
                                </div>

                                <div class="post-meta padding-10 clearfix">
                                    <div class="pull-left">
                                        <ul class="post-meta-group">
                                            <li><i class="fa fa-user"></i>
                                                {{-- <a href="#"> {{ $post->user->name }}</a>
                                                --}}

                                            </li>
                                            <li><i class="fa fa-clock-o"></i><time> {{ $post->date }}</time></li>
                                            <li><i class="fa fa-folder"></i>
                                                <a href="{{ route('category', $post->category->slug) }}">
                                                    {{ $post->category->title }}
                                                </a>
                                            </li>
                                            <li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
                                        </ul>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ route('show.blog.post', $post->slug) }}">Continue Reading &raquo;</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                @endif


                <nav>
                    {{ $posts->links() }}
                </nav>
            </div>
            @include('layouts.sidebar')
        </div>
    </div>

@endsection
