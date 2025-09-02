<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-TzBZ-AB8Hng2jGB_"></script>

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Supplier Assessment | Management System</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/dashboard.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/dashboard.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/dashboard.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/dashboard.png') }}">
    <link rel="manifest" href="{{ asset('asset/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('img/dashboard.png') }}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('asset/js/config.js') }}"></script>
    <script src="{{ asset('vendors/overlayscrollbars/OverlayScrollbars.min.js') }}"></script>


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap"
        rel="stylesheet">
    <link href="{{ asset('vendors/overlayscrollbars/OverlayScrollbars.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/theme-rtl.min.css') }}" rel="stylesheet" id="style-rtl">
    <link href="{{ asset('asset/css/theme.min.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('asset/css/user-rtl.min.css') }}" rel="stylesheet" id="user-style-rtl">
    <link href="{{ asset('asset/css/user.min.css') }}" rel="stylesheet" id="user-style-default">

    @yield('base.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var isRTL = JSON.parse(localStorage.getItem('isRTL'));
        if (isRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script>
    <style>
        .kaki {
            background: rgb(238, 174, 202);
            background: radial-gradient(circle, rgba(200, 13, 13, 0.94) 0%, rgba(17, 103, 200, 1) 100%);
            position: fixed;
            bottom: 0;
            left: 0;
            border-top-right-radius: 15px 15px;
            border-top-left-radius: 15px 15px;
            width: 100%;
            height: 70px;
            border-style: solid;
            border-width: thin;
            border-color: #0ae9b5;
            box-shadow: 0px 0px 5px 5px #dabebe;
            /* background-color: rgba(5, 5, 5, 0.9); */

        }
    </style>
</head>

<body>

    <main class="main" id="top">
        <div class="container" data-layout="container">
            <script>
                var isFluid = JSON.parse(localStorage.getItem('isFluid'));
                if (isFluid) {
                    var container = document.querySelector('[data-layout]');
                    container.classList.remove('container');
                    container.classList.add('container-fluid');
                }
            </script>

            <div class="content">
                <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand">

                    <a class="navbar-brand me-1 me-sm-3 d-none d-lg-block" href="#">
                        <div class="d-flex align-items-center"><img class="me-2"
                                src="{{ asset('asset/img/icons/spot-illustrations/falcon.png') }}" alt=""
                                width="40" /><span class="font-sans-serif">System</span>
                        </div>
                    </a>
                    <ul class="navbar-nav align-items-center ">
                        <li class="nav-item">
                            <div class="search-box" data-list='{"valueNames":["title"]}'>
                                <form class="position-relative" data-bs-toggle="search" data-bs-display="">
                                    <input class="form-control search-input fuzzy-search" type="search"
                                        placeholder="Search..." aria-label="Search" />
                                    <span class="fas fa-search search-box-icon"></span>

                                </form>
                                <div class="btn-close-falcon-container position-absolute end-0 top-50 translate-middle shadow-none"
                                    data-bs-dismiss="search">
                                    <div class="btn-close-falcon" aria-label="Close"></div>
                                </div>
                                <div class="dropdown-menu border font-base start-0 mt-2 py-0 overflow-hidden w-100">
                                    <div class="scrollbar list py-3" style="max-height: 24rem;">
                                        <h6 class="dropdown-header fw-medium text-uppercase px-card fs--2 pt-0 pb-2">
                                            Recently Browsed</h6>
                                        <a class="dropdown-item fs--1 px-card py-1 hover-primary" href="#">
                                            <div class="d-flex align-items-center">
                                                <span class="fas fa-circle me-2 text-300 fs--2"></span>

                                                <div class="fw-normal title">Pages <span
                                                        class="fas fa-chevron-right mx-1 text-500 fs--2"
                                                        data-fa-transform="shrink-2"></span> Dashboard</div>
                                            </div>
                                        </a>

                                        <hr class="bg-200 dark__bg-900" />
                                    </div>
                                    <div class="text-center mt-n3">
                                        <p class="fallback fw-bold fs-1 d-none">No Result Found.</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center ">
                        <li class="nav-item d-none d-lg-block">
                            <div class="theme-control-toggle fa-icon-wait px-2">
                                <input class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle"
                                    type="checkbox" data-theme-control="theme" value="dark" />
                                <label class="mb-0 theme-control-toggle-label theme-control-toggle-light"
                                    for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Switch to light theme"><span class="fas fa-sun fs-0"></span></label>
                                <label class="mb-0 theme-control-toggle-label theme-control-toggle-dark"
                                    for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Switch to dark theme"><span class="fas fa-moon fs-0"></span></label>
                            </div>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link px-0 notification-indicator notification-indicator-warning notification-indicator-fill fa-icon-wait"
                                href="#"><span class="fas fa-shopping-cart" data-fa-transform="shrink-7"
                                    style="font-size: 33px;"></span><span
                                    class="notification-indicator-number">1</span></a>

                        </li> --}}
                        <li class="nav-item dropdown d-none d-lg-block">
                            <a class="nav-link notification-indicator notification-indicator-primary px-0 fa-icon-wait"
                                id="navbarDropdownNotification" href="#" role="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><span class="fas fa-bell"
                                    data-fa-transform="shrink-6" style="font-size: 33px;"></span></a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-card dropdown-menu-notification"
                                aria-labelledby="navbarDropdownNotification">
                                <div class="card card-notification shadow-none">
                                    <div class="card-header">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <h6 class="card-header-title mb-0">Notifications</h6>
                                            </div>
                                            <div class="col-auto ps-0 ps-sm-3"><a class="card-link fw-normal"
                                                    href="#">Mark all as read</a></div>
                                        </div>
                                    </div>
                                    <div class="scrollbar-overlay" style="max-height:19rem" id="show-notification">

                                    </div>
                                    <div class="card-footer text-center border-top"><a class="card-link d-block"
                                            href="../app/social/notifications.html">View all</a></div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown d-none d-lg-block">
                            <a class="nav-link pe-0" id="navbarDropdownUser" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="avatar avatar-xl">
                                    <img class="rounded-circle" src="{{ asset('asset/img/team/avatar.png') }}" alt="" />

                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
                                <div class="bg-white dark__bg-1000 rounded-2 py-2">
                                    {{-- <a class="dropdown-item fw-bold text-warning" href="#!"><span
                                            class="fas fa-crown me-1"></span><span>Go Pro</span></a> --}}
                                    <a class="dropdown-item text-primary text-center">{{ Auth::user()->fullname }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#!" id="button-setup-notification"
                                        data-bs-toggle="modal" data-bs-target="#modal-template-sm"><span
                                            class="fas fa-volume-down"></span> Set Notification</a>
                                    <a class="dropdown-item" href="#" id="button-setup-profil" data-bs-toggle="modal"
                                        data-bs-target="#modal-template-xl"><span class="fas fa-user-cog"></span>
                                        Profile &amp;
                                        account</a>
                                    <div class="dropdown-divider"></div>
                                    {{-- <a class="dropdown-item" href="#">Settings</a> --}}
                                    <a class="dropdown-item" href="{{ route('logout') }}"><span
                                            class="fab fa-keycdn"></span> Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

                <div class="card bg-200 border border-dark">
                    <div class="card-body overflow-hidden p-lg-3">
                        <div class="row g-3">

                            <div class="col-sm-6 col-lg-3">
                                <div class="card overflow-hidden" >
                                    <div class="card-img-top"><img class="img-fluid" src="{{ asset('img/android.png') }}"
                                            alt="Card image cap" /></div>
                                    <div class="card-body">
                                        <h5 class="card-title">Inventaris App</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make
                                            up the bulk of the card's content.</p><a class="btn btn-primary btn-sm"
                                            href="#!" id="button-login-system" data-bs-toggle="modal" data-bs-target="#modal-login">login</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="card overflow-hidden" >
                                    <div class="card-img-top"><img class="img-fluid" src="{{ asset('img/android.png') }}"
                                            alt="Card image cap" /></div>
                                    <div class="card-body">
                                        <h5 class="card-title">MCU Monitoring</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make
                                            up the bulk of the card's content.</p><a class="btn btn-primary btn-sm"
                                            href="#!">Go somewhere</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="card overflow-hidden" >
                                    <div class="card-img-top"><img class="img-fluid" src="{{ asset('img/android.png') }}"
                                            alt="Card image cap" /></div>
                                    <div class="card-body">
                                        <h5 class="card-title">E Supplier</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make
                                            up the bulk of the card's content.</p><a class="btn btn-primary btn-sm"
                                            href="#!">Go somewhere</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="data">
                        <form>
                            @csrf
                            <input type="text" name="email" id="email" size="20" />
                            <br /><br />
                            <input type="text" id="password" name="password" />
                            <input type="button" id="upload" value="upload" />
                        </form>
                    </div>
                </div>

                <footer class="footer">
                    <div class="row g-0 justify-content-between fs--1 mt-4 mb-3">
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600">Thank you for creating with Transforma<span
                                    class="d-none d-sm-inline-block">| </span><br class="d-sm-none" /> 2025 &copy;
                                <a href="#">{{ Env('APP_NAME') }}</a>
                                <button class="btn btn-primary" id="liveToastBtn" type="button" hidden></button>
                            </p>
                        </div>
                        <div class="col-12 col-sm-auto text-center">
                            <img src="{{ asset('img/logo.png') }}" alt="" width="80">
                        </div>
                    </div>
                </footer>
                <div class="d-lg-none kaki">
                    <ul class="nav nav-pills nav-fill mt-0">
                        <li class="nav-item m-2"><a class="btn btn-light btn-sm py-1 px-2 m-0" href="123"><i
                                    class="fas fa-home"></i><br> Home</a></li>
                        <li class="nav-item m-2">
                            <div class="dropdown font-sans-serif mb-2">
                            <a class="btn btn-falcon-default btn-sm" id="dropdownMenuLink" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                                class="fas fa-book-open"></i><br> Menu</a>
                            <div class="dropdown-menu dropdown-menu-end py-0" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a>
                            </div>
                            </div>
                        </li>
                        <li class="nav-item m-2"><a class="btn btn-light btn-sm py-1 px-2 m-0" href="123"><i
                                    class="fas fa-book-open"></i><br> Menu</a></li>
                        <li class="nav-item m-2"><a class="btn btn-light btn-sm py-1 px-2 m-0" href="#" type="button"><i
                                    class="fas fa-user"></i><br> User</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </main>

    <div class="modal fade" id="modal-login" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 95%;">
            <div class="modal-content border-0">
                <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="menu-login"></div>
            </div>
        </div>
    </div>
    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="{{ asset('vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('vendors/is/is.min.js') }}"></script>
    <script src="{{ asset('vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('vendors/lodash/lodash.min.js') }}"></script>
    <script src="{{ asset('vendors/list.js/list.min.js') }}"></script>
    <script src="{{ asset('asset/js/theme.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on("click", "#button-login-system", function(e) {
            e.preventDefault();
            $('#button-login-system').html(
                '<div class="spinner-border my-0" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
            );
            $('#menu-login').html('<iframe src="http://inventory.pramita.co.id:8000/app/dashboard_home" style="width:100%; height:633px;" frameborder="0"></iframe>');

        });
    </script>
    <script>

    </script>
</body>

</html>
