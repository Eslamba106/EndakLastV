<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="horizontal" data-nav-style="menu-hover" data-theme-mode="light">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Eslam Badawy">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/themes/fontawesome-stars.css"
        rel="stylesheet">

    <!-- TITLE -->
    <title>@yield('title')</title>


    <!-- Meta -->
    <meta property="og:title" content="عندك">
    <meta property="og:description" content="وصف مختصر عن الموقع.">
    <meta property="og:image" content="{{ asset('images/logo.jpg') }}" >
    <meta property="og:url" content="https://endak.net/" >

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo2.jpg') }}">


    <!-- Favicon -->
    {{-- <link rel="icon" href="{{ asset('assets/images/brand/favicon.ico') }}" type="image/x-icon"> --}}
    <link rel="stylesheet" href="{{ asset('home/assets/css/line-awesome.min.css') }}">

    <!-- BOOTSTRAP CSS -->
    {{-- <link id="style" href="{{ asset('home/assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"> --}}

    <!-- STYLE CSS -->
    <link href="{{ asset('home/assets/css/styles.css') }}" rel="stylesheet">
    {{-- @if(config('app.locale') == 'ar') --}}
    <link href="{{ asset('home/assets/libs/bootstrap/css/bootstrap.rtl.min.css') }}" rel="stylesheet">
    {{-- @else --}}
    <link id="style" href="{{ asset('home/assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- @endif --}}
    <!-- Simonwep-picker CSS -->
    <link href="{{ asset('home/assets/libs/@simonwep/pickr/themes/classic.min.css') }}" rel="stylesheet">
    <link href="{{ asset('home/assets/libs/@simonwep/pickr/themes/monolith.min.css') }}" rel="stylesheet">
    <link href="{{ asset('home/assets/libs/@simonwep/pickr/themes/nano.min.css') }}" rel="stylesheet">

    <!-- ICONS CSS -->
    <link href="{{ asset('home/assets/css/icons.css') }}" rel="stylesheet">
    @yield('style')
    <style>
        a{
            text-decoration: none;
            color: black
        }
        *{
            color: black
        }
    </style>

</head>

<body class="main-body light-theme">


    <!-- Back-to-top -->


    <!-- <a href="javascript:void(0);" class="buy-now" data-target="html">
        <span class="fe fe-message-square"></span>
    </a> -->
    <a href="#top" id="back-to-top" class="back-to-top rounded-circle shadow all-ease-03 fade-in">
        <i class="fe fe-arrow-up"></i>
    </a>

    <div class="page">


        @include('layouts.server_provider.header')

        <div class="main-content app-content">

            @yield('header')
            {{-- <section>
                <div class="section banner-4 banner-section">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-12 text-center">
                                <div class="">
                                    <p class="mb-3 content-1 h5 text-white">Blog <span class="tx-info-dark">Page</span></p>
                                    <p class="mb-0 tx-28">We Fight Passionately to Get Our Clients Every Time They Deserve</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section> --}}
            @yield('content')

        </div>

        @include('layouts.server_provider.footer')

        @if (Session::has('error'))
            <script>
                swal("Message", "{{ Session::get('error') }}", 'error', {
                    button: true,
                    button: "Ok",
                    timer: 3000,
                })
            </script>
        @endif

        <!-- Bootstrap js -->
        <script src="{{ asset('home/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Popper JS -->
        <script src="{{ asset('home/assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>

        <!-- Defaultmenu JS -->
        <script src="{{ asset('home/assets/js/defaultmenu.js') }}"></script>

        <!-- Categorymenu JS -->
        <script src="{{ asset('home/assets/js/category-menu.js') }}"></script>

        <!-- Accept-cookie JS -->
        <script src="{{ asset('home/assets/js/cookies.js') }}"></script>

        <!-- Custom-switcher JS -->
        <script src="{{ asset('home/assets/js/custom-switcher.js') }}"></script>

        <!-- Sticky JS -->
        <script src="{{ asset('home/assets/js/sticky.js') }}"></script>

        <!-- CUSTOM JS -->
        <script src="{{ asset('home/assets/js/custom.js') }}"></script>
        <script>
            // الحصول على لغة التطبيق من Laravel
            // $lang = config('app.locale');
            const appLanguage = "{{ config('app.locale') }}";
            // const appLanguage = "{{ app()->getLocale() }}";
            const rtlBtn = document.getElementById('rtlBtn'); // استبدل 'rtl-button-id' بالمعرف الفعلي للزر RTL
            const ltrBtn = document.getElementById('ltrBtn'); // استبدل 'ltr-button-id' بالمعرف الفعلي للزر LTR

            // تحديد الاتجاه بناءً على اللغة
            if (appLanguage === "ar") {
                localStorage.setItem("hostmartl", true);
                localStorage.removeItem("hostmaltr");
                rtlFn(); // نفذ وظيفة RTL إذا كانت اللغة العربية
            } else {
                localStorage.setItem("hostmaltr", true);
                localStorage.removeItem("hostmartl");
                ltrFn(); // نفذ وظيفة LTR إذا كانت اللغة ليست عربية
            }

            // إضافة مستمع للأزرار إذا كانت موجودة
            if (rtlBtn) {
                rtlBtn.addEventListener('click', () => {
                    localStorage.setItem("hostmartl", true);
                    localStorage.removeItem("hostmaltr");
                    rtlFn();
                });
            }

            if (ltrBtn) {
                ltrBtn.addEventListener('click', () => {
                    localStorage.setItem("hostmaltr", true);
                    localStorage.removeItem("hostmartl");
                    ltrFn();
                });
            }
        </script>

        @yield('script')
</body>

</html>
