@extends('frontend.layouts.default')
@section('content')

    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <span>Chuyên mục</span>
                    <h3>{{ $cat->name }}</h3>
                    <p>Category description here.. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam error
                        eius quo, officiis non maxime quos reiciendis perferendis doloremque maiores!</p>
                </div>
            </div>
        </div>
    </div>
    <div class="site-section bg-white" id="posts">
        @include('frontend.category.pagination_category')
    </div>

    </div>
    @push('ajax')
        <script>
            $(document).on('click', '.custom-pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                console.log(page);
                fetch_data(page);
                window.history.pushState("", "", "{{ route('frontend.category.category', $cat->url_page) }}?page=" +
                    page);
            });

            function fetch_data(page) {
                $.ajax({
                    url: "{{ route('frontend.category.category', $cat->url_page) }}?page=" + page,
                    type: 'GET',
                    success: function(data) {
                        $('#posts').html(data);
                        //console.log(url);
                        console.log("Thanh cong!");
                    }
                });
            }

        </script>
    @endpush

@endsection
