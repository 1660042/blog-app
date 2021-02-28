<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mini Blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700|Playfair+Display:400,700,900" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('MiniBlog/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('MiniBlog/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('MiniBlog/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('MiniBlog/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('MiniBlog/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('MiniBlog/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('MiniBlog/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('MiniBlog/fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('MiniBlog/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('MiniBlog/css/style.css') }}">
</head>

<body>

    <div class="site-wrap">

        <div class="site-mobile-menu">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>

        <header class="site-navbar" role="banner">
            <div class="container-fluid">
                <div class="row align-items-center">



                    <div class="col-4 site-logo">
                        <a href="{{ url('/') }}" class="text-black h2 mb-0">Mini Blog</a>

                    </div>

                    <div class="col-8 text-right">
                        <nav class="site-navigation" role="navigation">
                            <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block mb-0">

                                <li><a href="{{ asset('MiniBlog/category.html') }}">Home</a></li>
                                @foreach ($categories as $category)
                                    @if ($category->parent_id == null)


                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                                role="button" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                {{ $category->name }}
                                            </a>
                                            @foreach ($childCategories as $childCat)
                                                @if ($category->id == $childCat->parent_id)
                                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                        <a class="dropdown-item" href="#">{{ $childCat->name }}</a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </li>
                                    @endif
                                @endforeach
                                {{-- <li><a href="{{ asset('MiniBlog/category.html') }}">Politics</a></li> --}}

                                {{-- <li><a href="{{ asset('MiniBlog/category.html') }}">Tech</a></li>
                                <li><a href="{{ asset('MiniBlog/category.html') }}">Entertainment</a></li>
                                <li><a href="{{ asset('MiniBlog/category.html') }}">Travel</a></li> --}}
                                <li class="d-none d-lg-inline-block"><a href="{{ url('/#') }}"
                                        class="js-search-toggle"><span class="icon-search"></span></a></li>
                            </ul>
                        </nav>
                        <a href="{{ url('/#') }}"
                            class="site-menu-toggle js-menu-toggle text-black d-inline-block d-lg-none"><span
                                class="icon-menu h3"></span></a>
                    </div>

                </div>
                <div class="col-12 search-form-wrap js-search-form">
                    <form method="get" action="{{ url('/#') }}">
                        <input type="text" id="s" class="form-control" placeholder="Nhập tìm kiếm...">
                        <button class="search-btn" type="submit"><span class="icon-search"></span></button>
                    </form>
                </div>
            </div>
        </header>

        @yield('content')

        <div class="site-footer">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-md-4">
                        <h3 class="footer-heading mb-4">About Us</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat reprehenderit magnam
                            deleniti quasi saepe, consequatur atque sequi delectus dolore veritatis obcaecati quae,
                            repellat eveniet omnis, voluptatem in. Soluta, eligendi, architecto.</p>
                    </div>
                    <div class="col-md-3 ml-auto">
                        <!-- <h3 class="footer-heading mb-4">Navigation</h3> -->
                        <ul class="list-unstyled float-left mr-5">
                            <li><a href="{{ asset('MiniBlog/#') }}">About Us</a></li>
                            <li><a href="{{ asset('MiniBlog/#') }}">Advertise</a></li>
                            <li><a href="{{ asset('MiniBlog/#') }}">Careers</a></li>
                            <li><a href="{{ asset('MiniBlog/#') }}">Subscribes</a></li>
                        </ul>
                        <ul class="list-unstyled float-left">
                            <li><a href="{{ asset('MiniBlog/#') }}">Travel</a></li>
                            <li><a href="{{ asset('MiniBlog/#') }}">Lifestyle</a></li>
                            <li><a href="{{ asset('MiniBlog/#') }}">Sports</a></li>
                            <li><a href="{{ asset('MiniBlog/#') }}">Nature</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">


                        <div>
                            <h3 class="footer-heading mb-4">Connect With Us</h3>
                            <p>
                                <a href="{{ asset('MiniBlog/#') }}"><span
                                        class="icon-facebook pt-2 pr-2 pb-2 pl-0"></span></a>
                                <a href="{{ asset('MiniBlog/#') }}"><span class="icon-twitter p-2"></span></a>
                                <a href="{{ asset('MiniBlog/#') }}"><span class="icon-instagram p-2"></span></a>
                                <a href="{{ asset('MiniBlog/#') }}"><span class="icon-rss p-2"></span></a>
                                <a href="{{ asset('MiniBlog/#') }}"><span class="icon-envelope p-2"></span></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <p>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy; <script>
                                document.write(new Date().getFullYear());

                            </script> All rights reserved | This template is made with <i class="icon-heart text-danger"
                                aria-hidden="true"></i> by <a href="https://colorlib.com"
                                target="_blank">Colorlib---</a>Downloaded from <a href="/https://themeslab.org/"
                                target="_blank">Themeslab</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="{{ asset('MiniBlog/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('MiniBlog/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('MiniBlog/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('MiniBlog/js/popper.min.js') }}"></script>
    <script src="{{ asset('MiniBlog/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('MiniBlog/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('MiniBlog/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('MiniBlog/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('MiniBlog/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('MiniBlog/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('MiniBlog/js/aos.js') }}"></script>

    <script src="{{ asset('MiniBlog/js/main.js') }}"></script>

    @stack('ajax')
    @include('common.notification')
</body>

</html>
