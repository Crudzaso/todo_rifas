
<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <title>TodoRifas</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="canonical" href="http://preview.keenthemes.comlanding.html" />
    <link rel="shortcut icon" href="{{asset('assets/media/images/todo_rifas v2.png')}}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{asset('assets/css/stylesLanding.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" data-bs-spy="scroll" data-bs-target="#kt_landing_menu" class="bg-body position-relative">
<!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
<!--end::Theme mode setup on page load-->
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Header Section-->
    <div class="mb-0" id="home">
        <!--begin::Wrapper-->
        <div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom landing-dark-bg" style="background-image: url(assets/media/svg/illustrations/landing.svg); height: 65vh;">
            <!--begin::Header-->
          <x-header_landing></x-header_landing>
          <x-hero_landing></x-hero_landing>
        <!--end::Wrapper-->
        <!--begin::Curve bottom-->
        <div class="landing-curve landing-dark-color mb-10 mb-lg-20">
            <svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z" fill="currentColor"></path>
            </svg>
        </div>
        <!--end::Curve bottom-->
    </div>
    <!--end::Header Section-->
    <!--begin::How It Works Section-->
    <div class="mb-n10 mb-lg-n20 z-index-2">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Heading-->
            <div class="text-center mb-17">
                <!--begin::Title-->
                <h3 class="fs-2hx text-gray-900 mb-5" id="how-it-works" data-kt-scroll-offset="{default: 100, lg: 150}">Cómo funciona</h3>
                <br><br><br>
                <!--end::Title-->
            <!--begin::Row-->
            <div class="row w-100 gy-10 mb-md-20">
                <!--begin::Col-->
                <div class="col-md-4 px-5">
                    <!--begin::Story-->
                    <div class="text-center mb-10 mb-md-0">
                        <!--begin::Illustration-->
                        <img src="https://img.icons8.com/ios/50/000000/user.png" alt="Sign Up" class="mx-auto mb-4 w-16 h-16">
                        <!--end::Illustration-->
                        <!--begin::Heading-->
                        <div class="d-flex flex-center mb-5">
                            <!--begin::Badge-->
                            <span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">1</span>
                            <!--end::Badge-->
                            <!--begin::Title-->
                            <div class="fs-5 fs-lg-3 fw-bold text-gray-900">Registrate con nosotros</div>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Description-->
                        <div class="fw-semibold fs-6 fs-lg-4 text-muted">Crea tu cuenta con nosotros para empezar a participar en nuestras rifas, recuerda que
                        ¡la suerte está en tus manos!</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Story-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-4 px-5">
                    <!--begin::Story-->
                    <div class="text-center mb-10 mb-md-0">
                        <!--begin::Illustration-->
                        <img src="https://img.icons8.com/ios/50/000000/ticket.png" alt="Buy Tickets" class="mx-auto mb-4 w-16 h-16">
                        <!--end::Illustration-->
                        <!--begin::Heading-->
                        <div class="d-flex flex-center mb-5">
                            <!--begin::Badge-->
                            <span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">2</span>
                            <!--end::Badge-->
                            <!--begin::Title-->
                            <div class="fs-5 fs-lg-3 fw-bold text-gray-900">Compra tus numeros</div>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Description-->
                        <div class="fw-semibold fs-6 fs-lg-4 text-muted">Compra tus numeros para participar en nuestras
                            <br />rifas transparentes y reguladas!
                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Story-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-4 px-5">
                    <!--begin::Story-->
                    <div class="text-center mb-10 mb-md-0">
                        <!--begin::Illustration-->
                        <img src="https://img.icons8.com/ios/50/000000/waiting-room.png" alt="Wait for the Draw" class="mx-auto mb-4 w-16 h-16">
                        <!--end::Illustration-->
                        <!--begin::Heading-->
                        <div class="d-flex flex-center mb-5">
                            <!--begin::Badge-->
                            <span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">3</span>
                            <!--end::Badge-->
                            <!--begin::Title-->
                            <div class="fs-5 fs-lg-3 fw-bold text-gray-900">Espera el día de la rifa</div>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Description-->
                        <div class="fw-semibold fs-6 fs-lg-4 text-muted">Espera el día dela rifa para
                            <br />saber los resultados de la misma. Recuerda que
                            <br />los resultados se basan en las rifas locales!</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Story-->
                </div>
                <!--end::Col-->
                
            </div>
            <!--end::Row-->
        <!--begin::Action-->
        <a href="{{route('login')}}" class="btn btn-primary">Registrate aquí</a>
        <!--end::Action-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::How It Works Section-->
    <!--begin::Footer Section-->
    <x-footer></x-footer>
    <!--end::Footer Section-->
</div>
<!--end::Root-->
<!--end::Main-->
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
</body>
<!--end::Body-->
</html>
