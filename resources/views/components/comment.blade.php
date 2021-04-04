@php
$comments = $comments
    ->whereNull('answer_comment_id')
    ->orderBy('id', 'desc')
    ->paginate($qty);
@endphp

<div id="comments" class="column large-12">

    <h3 class="h2">Có {{ $comments->total() }} bình luận</h3>

    <!-- START commentlist -->
    <ol class="commentlist">


        @foreach ($comments as $comment)

            @if ($comment->answer_comment_id == null)


                <li class="thread-alt depth-1 comment">

                    <div class="comment__avatar">
                        <img class="avatar"
                            src="http://www.gravatar.com/avatar/{{ $comment->getAvatarUrl($comment->email) }}" alt=""
                            width="50" height="50">
                    </div>

                    <div class="comment__content">

                        <div class="comment__info">
                            <div class="comment__author">{{ $comment->name }}</div>

                            <div class="comment__meta">
                                <div class="comment__time">{{ $comment->created_at }}</div>
                                <div class="comment__reply">
                                    <a class="comment-reply-link" href="#add-comment"
                                        onclick="replyFor('{{ $comment->id }}', '{{ $comment->name }}')">Trả lời</a>
                                </div>
                            </div>
                        </div>

                        <div class="comment__text">
                            <p>{{ $comment->content }}</p>
                        </div>

                    </div>

                    <ul class="children">
                        @foreach ($comment->getChildComments as $childComment)

                            <li class="depth-2 comment">

                                <div class="comment__avatar">
                                    <img class="avatar"
                                        src="http://www.gravatar.com/avatar/{{ $comment->getAvatarUrl($comment->email) }}"
                                        alt="" width="50" height="50">
                                </div>

                                <div class="comment__content">

                                    <div class="comment__info">
                                        <div class="comment__author">{{ $childComment->name }}</div>

                                        <div class="comment__meta">
                                            <div class="comment__time">{{ $childComment->created_at }}</div>
                                            <div class="comment__reply">
                                                <a class="comment-reply-link"
                                                    onclick="replyFor('{{ $comment->id }}', '{{ $childComment->name }}')"
                                                    href="#add-comment">Trả lời</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="comment__text">
                                        <p>{{ $childComment->content }}</p>
                                    </div>

                                </div>

                            </li>
                            {{-- @endif --}}
                        @endforeach
                    </ul>

                </li> <!-- end comment level 1 -->
            @endif
        @endforeach
        {{ $comments->render('frontend.pagination.pagination') }}

    </ol>
    <!-- END commentlist -->

</div> <!-- end comments -->

<div class="column large-12 comment-respond" id="add-comment">

    <!-- START respond -->
    <div id="respond">

        <h3 class="h2">Đăng bình luận <span>Email của bạn sẽ được ẩn khỏi bình luận!</span></h3>

        <div id="reply-for">

        </div>

        <form name="commentForm" id="commentForm" method="post" action="" autocomplete="off">
            @csrf
            @method("POST")
            {{-- <fieldset> --}}

            @if (auth()->check())
                <h3 class="" id="commenter">Đăng bình luận với tài khoản: {{ Auth::user()->name }}</h3></br>
                <div class="form-field" style="display:none">
                    <label class="text-danger" id="nameError"></label></br>
                    <input name="name" id="name" class="full-width" value="{{ auth()->user()->name }}"
                        placeholder="Your Name" value="" type="hidden">
                </div>
                <div class="form-field" style="display:none">
                    <input name="email" id="email" class="full-width" value="{{ auth()->user()->email }}"
                        placeholder="Your Email" value="" type="hidden">
                </div>
            @else

                <div class="form-field">
                    <label class="text-danger" id="nameError"></label></br>
                    <input name="name" id="name" class="full-width" placeholder="Your Name" value="" type="text">
                </div>

                <div class="form-field">
                    <label class="text-danger" id="emailError"></label></br>
                    <input name="email" id="email" class="full-width" placeholder="Your Email" value="" type="text">
                </div>

                <div class="form-field">
                    <label class="text-danger" id="websiteError"></label></br>
                    <input name="website" id="website" class="full-width" placeholder="Website" value="" type="text">
                </div>

            @endif



            <div class="message form-field">
                <label class="text-danger" id="contentError"></label></br>
                <textarea name="content" id="content" class="full-width" placeholder="Your Message"></textarea>
            </div>

            <input name="submit" id="submit" class="btn btn--primary btn-wide btn--large full-width" value="Add Comment"
                type="submit">

            {{-- </fieldset> --}}
        </form> <!-- end form -->

    </div>
    <!-- END respond-->

</div> <!-- end comment-respond -->



@push('script')
    <script>
        function replyFor(id, name) {
            //this.preventDefault();
            let replyFor = document.getElementById('reply-for');
            replyFor.innerHTML = "<p>Reply for: " + name + "</p>"
            $commentForm = $('#commentForm');
            $("#answer_comment_id").remove();
            $commentForm.prepend("<div style=\"display:none\" class=\"form-field\"><input type='hidden' value='" + id +
                "' name='answer_comment_id' id='answer_comment_id'/></div>");
            console.log('co vao');
        }

    </script>
@endpush
