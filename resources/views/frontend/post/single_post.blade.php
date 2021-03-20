@extends('frontend.layouts.default')
@section('title', 'Blog App - Bài viết')
@section('content')

    <div class="s-content content">
        <main class="row content__page">

            <article class="column large-full entry format-standard">

                <div class="media-wrap entry__media">
                    <div class="entry__post-thumb">
                        <img src="{{ $pathImage . $post->path_image }}" sizes="(max-width: 2000px) 100vw, 2000px" alt="">
                    </div>
                </div>

                <div class="content__page-header entry__header">
                    <h1 class="display-1 entry__title">
                        {{ $post->name }}
                    </h1>
                    <ul class="entry__header-meta">
                        <li class="author">By <a href="#0">{{ $post->createdBy->name }}</a></li>
                        <li class="date">{{ $post->created_at }}</li>
                        <li class="cat-links">
                            @foreach ($post->getCategories as $cat)
                                <a href="{{ $cat->id }}">{{ $cat->name }}</a>
                            @endforeach
                        </li>
                    </ul>
                </div> <!-- end entry__header -->

                <div class="entry__content">

                    {!! $post->content !!}


                    <p class="entry__tags">
                        <span>Post Tags</span>

                        <span class="entry__tag-list">
                            @foreach ($post->getTags as $tag)
                                <a href="{{ route('frontend.tag.index', $tag->name) }}">{{ $tag->name }}</a>
                            @endforeach

                        </span>

                    </p>
                </div> <!-- end entry content -->

                <div class="entry__pagenav">
                    <div class="entry__nav">
                        @if ($prePost != null)
                            <div class="entry__prev">
                                <a href="{{ route('frontend.post.post', $prePost->slug) }}" rel="prev">
                                    <span>Previous Post</span>
                                    {{ $prePost->name }}
                                </a>
                            </div>
                        @else
                            <div class="entry__prev">
                                <a href="#" rel="prev">
                                    <span></span>
                                </a>
                            </div>
                        @endif
                        @if ($nextPost != null)
                            <div class="entry__next">
                                <a href="{{ route('frontend.post.post', $nextPost->slug) }}" rel="next">
                                    <span>Next Post</span>
                                    {{ $nextPost->name }}
                                </a>
                            </div>
                        @else
                            <div class="entry__next">
                                <a href="#" rel="next">
                                    <span></span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div> <!-- end entry__pagenav -->

                <div class="entry__related">
                    <h3 class="h2">Related Articles</h3>

                    <ul class="related">
                        <li class="related__item">
                            <a href="single-standard.html" class="related__link">
                                <img src="images/thumbs/masonry/walk-600.jpg" alt="">
                            </a>
                            <h5 class="related__post-title">Using Repetition and Patterns in Photography.</h5>
                        </li>
                        <li class="related__item">
                            <a href="single-standard.html" class="related__link">
                                <img src="images/thumbs/masonry/dew-600.jpg" alt="">
                            </a>
                            <h5 class="related__post-title">Health Benefits Of Morning Dew.</h5>
                        </li>
                        <li class="related__item">
                            <a href="single-standard.html" class="related__link">
                                <img src="images/thumbs/masonry/rucksack-600.jpg" alt="">
                            </a>
                            <h5 class="related__post-title">The Art Of Visual Storytelling.</h5>
                        </li>
                    </ul>
                </div> <!-- end entry related -->

            </article> <!-- end column large-full entry-->
            <div class="comments-wrap" style="width: 100%">
                @include('components.comment', ['comments' => $post->getComments()])
            </div> <!-- end comments-wrap -->
        </main>

    </div> <!-- end s-content -->

    @push('ajax')
        <!-- summernote -->
        <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/summernote/summernote-bs4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/toastr/toastr.min.css') }}">


        <!-- SweetAlert2 -->
        <script src="{{ asset('AdminLTE-3.1.0/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        <!-- Toastr -->
        <script src="{{ asset('AdminLTE-3.1.0/plugins/toastr/toastr.min.js') }}"></script>


        <script>
            $(document).on('click', '.pgn a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                console.log(page);
                fetch_data(page);
                window.history.pushState("", "", "{{ route('frontend.post.post', $post->slug) }}?page=" +
                    page);
            });

            $(document).on('click', '#commentForm #submit', function(event) {
                event.preventDefault();
                addComment();
                window.history.pushState("", "", "{{ route('frontend.post.post', $post->slug) }}")
            });

            function fetch_data(page) {
                $.ajax({
                    url: "{{ route('frontend.post.post', $post->slug) }}?page=" + page,
                    type: 'GET',
                    success: function(data) {
                        $('.comments-wrap').html(data);
                        //console.log(url);
                        console.log("Thanh cong!: " + data);
                    },
                });
            }

            function addComment() {


                let _token = $('input[name=_token]').val();
                let name = $('input[name=name]').val();
                let email = $('input[name=email]').val();
                let website = $('input[name=website]').val();
                let content = $('textarea[name=content]').val();
                //alert(content);
                let post_id = {{ $post->id }};
                let answer_comment_id = $('input[name=answer_comment_id]').val();

                $("#nameError").text("");
                $("#emailError").text("");
                $("#websiteError").text("");
                $("#contentError").text("");

                console.log("token: " + _token);
                $.ajax({
                    url: "{{ route('frontend.post.addComment', $post->id) }}",
                    type: 'POST',
                    data: {
                        '_token': _token,
                        'name': name,
                        'email': email,
                        'website': website,
                        'content': content,
                        'name': name,
                        'post_id': post_id,
                        'answer_comment_id': answer_comment_id,
                    },
                    success: function(response) {

                        toastr.success('Đăng bình luận thành công!');

                        //console.log("Thanh cong!: " + response);
                        $('.comments-wrap').html(response);

                        $('html, body').animate({
                            scrollTop: $("#comments").offset().top
                        }, 2000);
                    },
                    error: function(response) {
                        toastr.error('Đăng bình luận thất bại!')
                        var a = $.parseJSON(response.responseText);
                        $.each(a.errors, function(key, value) {
                            $("#" + key + "Error").text(value);
                        });

                        $('html, body').animate({
                            scrollTop: $("#add-comment").offset().top
                        }, 2000);

                    }
                });
            }

        </script>
    @endpush
@endsection
