
    <div class="container">
      <div class="row">
          @foreach ($posts as $post)
        <div class="col-lg-4 mb-4">
          <div class="entry2">
            <a href="{{ route('frontend.post.post', $post->slug) }}"><img src="{{ asset('MiniBlog/images/img_1.jpg') }}" alt="Image" class="img-fluid rounded"></a>
            <div class="excerpt">
            <span class="post-category text-white bg-secondary mb-3">{{ $post->getCategory->name }}</span>

            <h2><a href="{{ route('frontend.post.post', $post->slug) }}">{{ $post->name }}</a></h2>
            <div class="post-meta align-items-center text-left clearfix">
              <figure class="author-figure mb-0 mr-3 float-left"><img src="{{ asset('MiniBlog/images/person_1.jpg') }}" alt="Image" class="img-fluid"></figure>
              <span class="d-inline-block mt-1">Đăng bởi <a href="#">{{ $post->createdBy->name }}</a></span>
              <span>&nbsp;-&nbsp; {{ date('d-m-Y', strtotime($post->created_at)) }} </span>
            </div>
            
              <p><p>{!! Str::substr($post->content, 0, 200) !!}</p></p>
              <p><a href="{{ route('frontend.post.post', $post->slug) }}">Xem thêm</a></p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      {{ $posts->render('frontend.pagination.pagination') }}

 