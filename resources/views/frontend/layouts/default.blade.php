<!DOCTYPE html>
<html lang="en">

<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog App | @yield('title', 'Trang chủ')</title>

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="{{ asset('Typerite/css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('Typerite/css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('Typerite/css/main.css') }}">

    <!-- script
    ================================================== -->
    <script src="{{ asset('Typerite/js/modernizr.js') }}"></script>

    <!-- favicons
    ================================================== -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('Typerite/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png') }}" sizes="32x32" href="{{ asset('Typerite/favicon-32x32.png') }}">
    <link rel="icon" type="image/png') }}" sizes="16x16" href="{{ asset('Typerite/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('Typerite/site.webmanifest') }}">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/css/bootstrap-multiselect.css" />

</head>

<body>

    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader" class="dots-fade">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <div id="top" class="s-wrap site-wrapper">

        <!-- site header
        ================================================== -->
        <header class="s-header">

            <div class="header__top">
                <div class="header__logo">
                    <a class="site-logo" href="{{ route('frontend.home') }}">
                        {{-- <img src="{{ asset('Typerite/images/logo.svg') }}" alt="Homepage"> --}}
                        <span class="brand-text font-weight-light">Blog App</span>
                    </a>
                </div>

                <div class="header__search">

                    <form role="search" method="get" class="header__search-form" action="#">
                        <label>
                            <span class="hide-content">Search for:</span>
                            <input type="search" class="header__search-field" placeholder="Type Keywords" value=""
                                name="s" title="Search for:" autocomplete="off">
                        </label>
                        <input type="submit" class="header__search-submit" value="Search">
                    </form>

                    <a href="#" title="Close Search" class="header__search-close">Close</a>

                </div> <!-- end header__search -->

                <!-- toggles -->
                <a href="{{ asset('Typerite/#0') }}" class="header__search-trigger"></a>
                <a href="{{ asset('Typerite/#0') }}" class="header__menu-toggle"><span>Menu</span></a>

            </div> <!-- end header__top -->

            <nav class="header__nav-wrap">

                <ul class="header__nav">
                    <li class="current"><a href="{{ route('frontend.home') }}" title="">Trang chủ</a></li>
                    @foreach ($categories as $cat)
                        @if ($cat->getChildCategories()->exists())
                            <li class="has-children">
                                <a href="#" title="{{ $cat->name }}">{{ $cat->name }}</a>

                                <ul class="sub-menu">
                                    @foreach ($cat->getChildCategories as $childCat)
                                        <li><a
                                                href="{{ route('frontend.category.index', $childCat->name_route) }}">{{ $childCat->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                            </li>
                        @endif
                    @endforeach
                    {{-- <li><a href="{{ asset('Typerite/styles.html') }}" title="">Styles</a></li> --}}
                    <li><a href="{{ asset('Typerite/page-about.html') }}" title="">About</a></li>
                    <li><a href="{{ asset('Typerite/page-contact.html') }}" title="">Contact</a></li>
                    @if (Auth::check())
                        <li><a href="{{ route('backend.index') }}" title="">Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}" title="">Login</a></li>
                    @endif
                </ul> <!-- end header__nav -->

                <ul class="header__social">
                    <li class="ss-facebook">
                        <a href="{{ asset('Typerite/https://facebook.com/') }}">
                            <span class="screen-reader-text">Facebook</span>
                        </a>
                    </li>
                    <li class="ss-twitter">
                        <a href="{{ asset('Typerite/#0') }}">
                            <span class="screen-reader-text">Twitter</span>
                        </a>
                    </li>
                    <li class="ss-dribbble">
                        <a href="{{ asset('Typerite/#0') }}">
                            <span class="screen-reader-text">Dribbble</span>
                        </a>
                    </li>
                    <li class="ss-pinterest">
                        <a href="{{ asset('Typerite/#0') }}">
                            <span class="screen-reader-text">Behance</span>
                        </a>
                    </li>
                </ul>

            </nav> <!-- end header__nav-wrap -->



        </header> <!-- end s-header -->

        @yield('content')


        <!-- footer
        ================================================== -->
        <footer class="s-footer">
            <div class="row">
                <div class="column large-full footer__content">
                    <div class="footer__copyright">
                        <span>© Copyright Typerite 2019</span>
                        <span>Design by <a
                                href="{{ asset('Typerite/https://www.styleshout.com/') }}">StyleShout</a></span>
                    </div>
                </div>
            </div>

            <div class="go-top">
                <a class="smoothscroll" title="Back to Top" href="{{ asset('Typerite/#top') }}"></a>
            </div>
        </footer>

    </div> <!-- end s-wrap -->


    <!-- Java Script
    ================================================== -->
    <script src="{{ asset('Typerite/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('Typerite/js/plugins.js') }}"></script>
    <script src="{{ asset('Typerite/js/main.js') }}"></script>
    @stack('script')
    @stack('ajax')
</body>

</html>
