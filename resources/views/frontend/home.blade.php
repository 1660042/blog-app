@extends('frontend.layouts.default')
@section('title', 'Blog App - Trang chủ')
@section('content')
    <div class="s-content">

        <div class="masonry-wrap">

            <div class="masonry">

                <div class="grid-sizer"></div>
                @foreach ($posts as $post)

                    <article class="masonry__brick entry format-standard animate-this">

                        <div class="entry__thumb">
                            <a href="{{ route('frontend.post.post', $post->slug) }}" class="entry__thumb-link">
                                <img src="{{ $pathImage . $post->path_image }}" alt="">
                            </a>
                        </div>

                        <div class="entry__text">
                            <div class="entry__header">

                                <h2 class="entry__title"><a
                                        href="{{ route('frontend.post.post', $post->slug) }}">{{ $post->name }}</a></h2>
                                <div class="entry__meta">
                                    <span class="entry__meta-cat">
                                        @foreach ($post->getCategories as $category)

                                            <a
                                                href="{{ route('frontend.category.index', $category->url_page) }}">{{ $category->name }}</a>
                                        @endforeach
                                    </span>
                                    <span class="entry__meta-date">
                                        <a
                                            href="{{ route('frontend.post.post', $post->slug) }}">{{ $post->updated_at }}</a>
                                    </span>
                                </div>

                            </div>
                            <div class="entry__excerpt">
                                <p>
                                    {!! Str::substr($post->content, 0, 200) !!}
                                </p>
                            </div>
                        </div>

                    </article> <!-- end article -->

                    {{-- <article class="masonry__brick entry format-quote animate-this">

                        <div class="entry__thumb">
                            <blockquote>
                                <p>Good design is making something intelligible and memorable. Great design is making
                                    something memorable and meaningful.</p>

                                <cite>Dieter Rams</cite>
                            </blockquote>
                        </div>

                    </article> <!-- end article --> --}}
                @endforeach
            </div> <!-- end masonry -->

        </div> <!-- end masonry-wrap -->
        {{ $posts->render('frontend.pagination.pagination') }}


    </div> <!-- end s-content -->


@endsection
