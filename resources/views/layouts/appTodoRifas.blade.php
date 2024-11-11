<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'Dashboard')</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('assets/css/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>

        #kt_content {
            margin-top: 80px;
            margin-left: 250px; }

        .sidebar {
            width: 250px;
        }

        @media (max-width: 768px) {
            #kt_content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-disabled">

<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
        <!--begin::Sidebar-->
        <div class="sidebar col-md-3 col-lg-2 d-none d-md-block">
            @yield('sidebar')
        </div>
        <!--end::Sidebar-->

        <!-- Button to toggle sidebar on smaller screens -->
        <button class="btn btn-icon btn-active-color-primary me-n4 d-md-none" id="kt_aside_toggle">
            <i class="ki-duotone ki-abstract-14 fs-2x">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </button>

        <!--begin::Wrapper-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <!--begin::Header tablet and mobile-->
            @yield('headerMobile')
            <!--end::Header tablet and mobile-->

            <!--begin::Header-->
            @yield('header')
            <!--end::Header-->

            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::Container-->
                <div class="container-xxl" id="kt_content_container">
                    @yield('content')
                </div>
                <!--end::Container-->
            </div>
            <!--end::Content-->

            <!--begin::Footer-->
            <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                <!--begin::Container-->
                <div class="container-fluid d-flex flex-column flex-md-row flex-stack">
                    <!--begin::Copyright-->
                    <div class="text-gray-900 order-2 order-md-1">
                        <span class="text-gray-500 fw-semibold me-1">Created by</span>
                        <a href="https://keenthemes.com" target="_blank" class="text-muted text-hover-primary fw-semibold me-2 fs-6">Keenthemes</a>
                    </div>
                    <!--end::Copyright-->
                    <!--begin::Menu-->
                    <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                        <li class="menu-item">
                            <a href="https://keenthemes.com" target="_blank" class="menu-link px-2">About</a>
                        </li>
                        <li class="menu-item">
                            <a href="https://devs.keenthemes.com" target="_blank" class="menu-link px-2">Support</a>
                        </li>
                        <li class="menu-item">
                            <a href="https://1.envato.market/Vm7VRE" target="_blank" class="menu-link px-2">Purchase</a>
                        </li>
                    </ul>
                    <!--end::Menu-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Root-->

<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{ asset('assets/js/plugins.min.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/js/modalRoles.js') }}"></script>
<!--end::Global Javascript Bundle-->
</body>
</html>
