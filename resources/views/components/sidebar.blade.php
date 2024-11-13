<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link href="{{ asset('css/style.aside.css') }}" rel="stylesheet">
</head>

<body>
<div id="kt_aside" class="aside" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="auto" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
    <!--begin::Logo-->
    <div class="aside-logo flex-column-auto pt-10 pt-lg-7" id="kt_aside_logo">
        <a href="index.html">
            <img alt="Logo" src="{{asset('images/todo_rifas v2.png')}}" class="h-40px" />
        </a>
    </div>
    <!--end::Logo-->
    <div class="aside-menu flex-column-fluid pt-0 pb-7 py-lg-10" id="kt_aside_menu">
        <!--begin::Aside menu-->
        <div id="kt_aside_menu_wrapper" class="w-100 hover-scroll-y scroll-lg-ms d-flex" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: trur}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu" data-kt-scroll-offset="0">
            <div id="kt_aside_menu" class="menu menu-column menu-title-gray-600 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-icon-gray-500 menu-arrow-gray-500 fw-semibold fs-6 my-auto" data-kt-menu="true">
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item here show py-2">
                    <!--begin:Menu link-->

                    <span class="menu-icon me-0">
                        <a class="menu-link btn btn-sm btn-success p-0 w-50" style="" href="{{route('admin.roles.index')}}">Roles</a>
                    </span>
                    <!--end:Menu item-->
                </div>
                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item here show py-2">
                    <!--begin:Menu link-->

                    <span class="menu-icon me-0">
                        <a class="menu-link btn btn-sm btn-success p-0 w-50" style="" href="{{route('raffles.index')}}">Rifas</a>
                    </span>
                    <!--end:Menu item-->
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
</body>
</html>
