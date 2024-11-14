@extends('layouts.appTodoRifas')

@section('title')
    Perfil
@endsection

@section('subtitle')
    Acá podrás ver información sobre tu perfil
@endsection

@section('content')
<div class="container-xxl" id="kt_content_container">
    <!--begin::Navbar-->
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <!--begin::Details-->
            <div class="d-flex flex-wrap flex-sm-nowrap">
                <!--begin: Pic-->
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img src="{{ auth()->user()->avatar ?? asset('assets/media/images/todo_rifas_pet.png') }}" alt="Profile image">
                    </div>
                </div>
                <!--end::Pic-->
                <!--begin::Info-->
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <!--begin::User-->
                        <div class="d-flex flex-column">
                            <!--begin::Name-->
                            @if(auth()->check())
                                <div class="d-flex align-items-center mb-2">
                                    <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{auth()->user()->name}}</a>
                                    <a href="#">
                                        <i class="ki-duotone ki-verify fs-1 text-primary">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                </div>

                                <!--end::Name-->
                                <!--begin::Info-->
                                <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                    <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary mb-2">
                                    <i class="ki-duotone ki-sms fs-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>{{auth()->user()->email}}</a>
                                </div>
                                <!--end::Info-->
                            @endif
                        </div>
                        <!--end::User-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Details-->
        </div>
    </div>
    <!--end::Navbar-->
    <!--begin::details View-->
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Detalles del perfil</h3>
            </div>
            <!--end::Card title-->
            <!--begin::Action-->
            <a href="{{route('user-config')}}" class="btn btn-sm btn-primary align-self-center">Editar Perfil</a>
            <!--end::Action-->
        </div>
        <!--begin::Card header-->
        <!--begin::Card body-->
        <div class="card-body p-9">
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-semibold text-muted">Nombre Completo</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{auth()->user()->name}}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Input group-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-semibold text-muted">Email</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-semibold text-gray-800 fs-6">{{auth()->user()->email}}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-semibold text-muted">Numero de Contacto</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 d-flex align-items-center">
                    <span class="fw-bold fs-6 text-gray-800 me-2"><!--seccion para numero de contacto --></span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-semibold text-muted">Fecha de nacimiento</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800 me-2">{{auth()->user()->date_of_birth}}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::details View-->
    <!--begin::Row-->
    <div class="row gy-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-xl-8 mb-xl-10">
            <!--begin::Chart widget 5-->
            <div class="card card-flush h-lg-100">
                <!--begin::Header-->
                <div class="card-header flex-nowrap pt-5">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-900">Top Selling Categories</span>
                        <span class="text-gray-500 pt-2 fw-semibold fs-6">8k social visitors</span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Menu-->
                        <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                            <i class="ki-duotone ki-dots-square fs-1 text-gray-500 me-n1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </button>
                        <!--begin::Menu 2-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator mb-3 opacity-75"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Ticket</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Customer</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                <!--begin::Menu item-->
                                <a href="#" class="menu-link px-3">
                                    <span class="menu-title">New Group</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <!--end::Menu item-->
                                <!--begin::Menu sub-->
                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Admin Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Staff Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Member Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu sub-->
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Contact</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator mt-3 opacity-75"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content px-3 py-3">
                                    <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                </div>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu 2-->
                        <!--end::Menu-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-5 ps-6">
                    <div id="kt_charts_widget_5" class="min-h-auto" style="min-height: 365px;"><div id="apexcharts6l4g5133" class="apexcharts-canvas apexcharts6l4g5133 apexcharts-theme-" style="width: 700px; height: 350px;"><svg id="SvgjsSvg1096" width="700" height="350" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)"><foreignObject x="0" y="0" width="700" height="350"><div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml" style="max-height: 175px;"></div><style type="text/css">
.apexcharts-flip-y {
transform: scaleY(-1) translateY(-100%);
transform-origin: top;
transform-box: fill-box;
}
.apexcharts-flip-x {
transform: scaleX(-1);
transform-origin: center;
transform-box: fill-box;
}
.apexcharts-legend {
display: flex;
overflow: auto;
padding: 0 10px;
}
.apexcharts-legend.apx-legend-position-bottom, .apexcharts-legend.apx-legend-position-top {
flex-wrap: wrap
}
.apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
flex-direction: column;
bottom: 0;
}
.apexcharts-legend.apx-legend-position-bottom.apexcharts-align-left, .apexcharts-legend.apx-legend-position-top.apexcharts-align-left, .apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
justify-content: flex-start;
}
.apexcharts-legend.apx-legend-position-bottom.apexcharts-align-center, .apexcharts-legend.apx-legend-position-top.apexcharts-align-center {
justify-content: center;
}
.apexcharts-legend.apx-legend-position-bottom.apexcharts-align-right, .apexcharts-legend.apx-legend-position-top.apexcharts-align-right {
justify-content: flex-end;
}
.apexcharts-legend-series {
cursor: pointer;
line-height: normal;
display: flex;
align-items: center;
}
.apexcharts-legend-text {
position: relative;
font-size: 14px;
}
.apexcharts-legend-text *, .apexcharts-legend-marker * {
pointer-events: none;
}
.apexcharts-legend-marker {
position: relative;
display: flex;
align-items: center;
justify-content: center;
cursor: pointer;
margin-right: 1px;
}

.apexcharts-legend-series.apexcharts-no-click {
cursor: auto;
}
.apexcharts-legend .apexcharts-hidden-zero-series, .apexcharts-legend .apexcharts-hidden-null-series {
display: none !important;
}
.apexcharts-inactive-legend {
opacity: 0.45;
}</style></foreignObject><g id="SvgjsG1098" class="apexcharts-inner apexcharts-graphical" transform="translate(105.642578125, 30)"><defs id="SvgjsDefs1097"><linearGradient id="SvgjsLinearGradient1101" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1102" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)" offset="0"></stop><stop id="SvgjsStop1103" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop><stop id="SvgjsStop1104" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop></linearGradient><clipPath id="gridRectMask6l4g5133"><rect id="SvgjsRect1106" width="571.357421875" height="277.494" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectBarMask6l4g5133"><rect id="SvgjsRect1107" width="575.357421875" height="281.494" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMask6l4g5133"><rect id="SvgjsRect1108" width="571.357421875" height="277.494" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMask6l4g5133"></clipPath><clipPath id="nonForecastMask6l4g5133"></clipPath></defs><rect id="SvgjsRect1105" width="0" height="277.494" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3" fill="url(#SvgjsLinearGradient1101)" class="apexcharts-xcrosshairs" y2="277.494" filter="none" fill-opacity="0.9"></rect><line id="SvgjsLine1135" x1="0" y1="277.494" x2="0" y2="283.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1137" x1="190.45247395833334" y1="277.494" x2="190.45247395833334" y2="283.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1139" x1="380.9049479166667" y1="277.494" x2="380.9049479166667" y2="283.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1141" x1="571.357421875" y1="277.494" x2="571.357421875" y2="283.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><g id="SvgjsG1130" class="apexcharts-grid"><g id="SvgjsG1131" class="apexcharts-gridlines-horizontal"></g><g id="SvgjsG1132" class="apexcharts-gridlines-vertical"><line id="SvgjsLine1136" x1="190.45247395833334" y1="0" x2="190.45247395833334" y2="277.494" stroke="#dbdfe9" stroke-dasharray="4" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1138" x1="380.9049479166667" y1="0" x2="380.9049479166667" y2="277.494" stroke="#dbdfe9" stroke-dasharray="4" stroke-linecap="butt" class="apexcharts-gridline"></line></g><line id="SvgjsLine1143" x1="0" y1="277.494" x2="571.357421875" y2="277.494" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1142" x1="0" y1="1" x2="0" y2="277.494" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG1133" class="apexcharts-grid-borders"><line id="SvgjsLine1134" x1="0" y1="0" x2="0" y2="277.494" stroke="#dbdfe9" stroke-dasharray="4" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1140" x1="571.357421875" y1="0" x2="571.357421875" y2="277.494" stroke="#dbdfe9" stroke-dasharray="4" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG1111" class="apexcharts-bar-series apexcharts-plot-series"><g id="SvgjsG1112" class="apexcharts-series" rel="1" seriesName="series-1" data:realIndex="0"><path id="SvgjsPath1117" d="M 4.101 8.321000000000002 L 567.458421875 8.321000000000002 C 569.458421875 8.321000000000002 571.458421875 10.321000000000002 571.458421875 12.321000000000002 L 571.458421875 27.321 C 571.458421875 29.321 569.458421875 31.321 567.458421875 31.321 L 4.101 31.321 C 2.101 31.321 0.101 29.321 0.101 27.321 L 0.101 12.321000000000002 C 0.101 10.321000000000002 2.101 8.321000000000002 4.101 8.321000000000002 Z " fill="rgba(62,151,255,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area undefined" index="0" clip-path="url(#gridRectBarMask6l4g5133)" pathTo="M 4.101 8.321000000000002 L 567.458421875 8.321000000000002 C 569.458421875 8.321000000000002 571.458421875 10.321000000000002 571.458421875 12.321000000000002 L 571.458421875 27.321 C 571.458421875 29.321 569.458421875 31.321 567.458421875 31.321 L 4.101 31.321 C 2.101 31.321 0.101 29.321 0.101 27.321 L 0.101 12.321000000000002 C 0.101 10.321000000000002 2.101 8.321000000000002 4.101 8.321000000000002 Z " pathFrom="M 0.101 8.321000000000002 L 0.101 8.321000000000002 L 0.101 31.321 L 0.101 31.321 L 0.101 31.321 L 0.101 31.321 L 0.101 31.321 L 0.101 8.321000000000002 Z" cy="47.96300000000001" cx="571.457421875" j="0" val="15" barHeight="23" barWidth="571.357421875"></path><path id="SvgjsPath1119" d="M 4.101 47.96300000000001 L 453.1869375 47.96300000000001 C 455.1869375 47.96300000000001 457.1869375 49.96300000000001 457.1869375 51.96300000000001 L 457.1869375 66.96300000000001 C 457.1869375 68.96300000000001 455.1869375 70.96300000000001 453.1869375 70.96300000000001 L 4.101 70.96300000000001 C 2.101 70.96300000000001 0.101 68.96300000000001 0.101 66.96300000000001 L 0.101 51.96300000000001 C 0.101 49.96300000000001 2.101 47.96300000000001 4.101 47.96300000000001 Z " fill="rgba(241,65,108,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area undefined" index="0" clip-path="url(#gridRectBarMask6l4g5133)" pathTo="M 4.101 47.96300000000001 L 453.1869375 47.96300000000001 C 455.1869375 47.96300000000001 457.1869375 49.96300000000001 457.1869375 51.96300000000001 L 457.1869375 66.96300000000001 C 457.1869375 68.96300000000001 455.1869375 70.96300000000001 453.1869375 70.96300000000001 L 4.101 70.96300000000001 C 2.101 70.96300000000001 0.101 68.96300000000001 0.101 66.96300000000001 L 0.101 51.96300000000001 C 0.101 49.96300000000001 2.101 47.96300000000001 4.101 47.96300000000001 Z " pathFrom="M 0.101 47.96300000000001 L 0.101 47.96300000000001 L 0.101 70.96300000000001 L 0.101 70.96300000000001 L 0.101 70.96300000000001 L 0.101 70.96300000000001 L 0.101 70.96300000000001 L 0.101 47.96300000000001 Z" cy="87.60500000000002" cx="457.1859375" j="1" val="12" barHeight="23" barWidth="457.0859375"></path><path id="SvgjsPath1121" d="M 4.101 87.60500000000002 L 377.0059479166667 87.60500000000002 C 379.0059479166667 87.60500000000002 381.0059479166667 89.60500000000002 381.0059479166667 91.60500000000002 L 381.0059479166667 106.60500000000002 C 381.0059479166667 108.60500000000002 379.0059479166667 110.60500000000002 377.0059479166667 110.60500000000002 L 4.101 110.60500000000002 C 2.101 110.60500000000002 0.101 108.60500000000002 0.101 106.60500000000002 L 0.101 91.60500000000002 C 0.101 89.60500000000002 2.101 87.60500000000002 4.101 87.60500000000002 Z " fill="rgba(80,205,137,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area undefined" index="0" clip-path="url(#gridRectBarMask6l4g5133)" pathTo="M 4.101 87.60500000000002 L 377.0059479166667 87.60500000000002 C 379.0059479166667 87.60500000000002 381.0059479166667 89.60500000000002 381.0059479166667 91.60500000000002 L 381.0059479166667 106.60500000000002 C 381.0059479166667 108.60500000000002 379.0059479166667 110.60500000000002 377.0059479166667 110.60500000000002 L 4.101 110.60500000000002 C 2.101 110.60500000000002 0.101 108.60500000000002 0.101 106.60500000000002 L 0.101 91.60500000000002 C 0.101 89.60500000000002 2.101 87.60500000000002 4.101 87.60500000000002 Z " pathFrom="M 0.101 87.60500000000002 L 0.101 87.60500000000002 L 0.101 110.60500000000002 L 0.101 110.60500000000002 L 0.101 110.60500000000002 L 0.101 110.60500000000002 L 0.101 110.60500000000002 L 0.101 87.60500000000002 Z" cy="127.24700000000001" cx="381.0049479166667" j="2" val="10" barHeight="23" barWidth="380.9049479166667"></path><path id="SvgjsPath1123" d="M 4.101 127.24700000000001 L 300.8249583333333 127.24700000000001 C 302.8249583333333 127.24700000000001 304.8249583333333 129.247 304.8249583333333 131.247 L 304.8249583333333 146.247 C 304.8249583333333 148.247 302.8249583333333 150.247 300.8249583333333 150.247 L 4.101 150.247 C 2.101 150.247 0.101 148.247 0.101 146.247 L 0.101 131.247 C 0.101 129.247 2.101 127.24700000000001 4.101 127.24700000000001 Z " fill="rgba(255,199,0,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area undefined" index="0" clip-path="url(#gridRectBarMask6l4g5133)" pathTo="M 4.101 127.24700000000001 L 300.8249583333333 127.24700000000001 C 302.8249583333333 127.24700000000001 304.8249583333333 129.247 304.8249583333333 131.247 L 304.8249583333333 146.247 C 304.8249583333333 148.247 302.8249583333333 150.247 300.8249583333333 150.247 L 4.101 150.247 C 2.101 150.247 0.101 148.247 0.101 146.247 L 0.101 131.247 C 0.101 129.247 2.101 127.24700000000001 4.101 127.24700000000001 Z " pathFrom="M 0.101 127.24700000000001 L 0.101 127.24700000000001 L 0.101 150.247 L 0.101 150.247 L 0.101 150.247 L 0.101 150.247 L 0.101 150.247 L 0.101 127.24700000000001 Z" cy="166.889" cx="304.82395833333334" j="3" val="8" barHeight="23" barWidth="304.7239583333333"></path><path id="SvgjsPath1125" d="M 4.101 166.889 L 262.7344635416667 166.889 C 264.7344635416667 166.889 266.7344635416667 168.889 266.7344635416667 170.889 L 266.7344635416667 185.889 C 266.7344635416667 187.889 264.7344635416667 189.889 262.7344635416667 189.889 L 4.101 189.889 C 2.101 189.889 0.101 187.889 0.101 185.889 L 0.101 170.889 C 0.101 168.889 2.101 166.889 4.101 166.889 Z " fill="rgba(114,57,234,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area undefined" index="0" clip-path="url(#gridRectBarMask6l4g5133)" pathTo="M 4.101 166.889 L 262.7344635416667 166.889 C 264.7344635416667 166.889 266.7344635416667 168.889 266.7344635416667 170.889 L 266.7344635416667 185.889 C 266.7344635416667 187.889 264.7344635416667 189.889 262.7344635416667 189.889 L 4.101 189.889 C 2.101 189.889 0.101 187.889 0.101 185.889 L 0.101 170.889 C 0.101 168.889 2.101 166.889 4.101 166.889 Z " pathFrom="M 0.101 166.889 L 0.101 166.889 L 0.101 189.889 L 0.101 189.889 L 0.101 189.889 L 0.101 189.889 L 0.101 189.889 L 0.101 166.889 Z" cy="206.531" cx="266.7334635416667" j="4" val="7" barHeight="23" barWidth="266.6334635416667"></path><path id="SvgjsPath1127" d="M 4.101 206.531 L 148.46297916666666 206.531 C 150.46297916666666 206.531 152.46297916666666 208.531 152.46297916666666 210.531 L 152.46297916666666 225.531 C 152.46297916666666 227.531 150.46297916666666 229.531 148.46297916666666 229.531 L 4.101 229.531 C 2.101 229.531 0.101 227.531 0.101 225.531 L 0.101 210.531 C 0.101 208.531 2.101 206.531 4.101 206.531 Z " fill="rgba(80,205,205,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area undefined" index="0" clip-path="url(#gridRectBarMask6l4g5133)" pathTo="M 4.101 206.531 L 148.46297916666666 206.531 C 150.46297916666666 206.531 152.46297916666666 208.531 152.46297916666666 210.531 L 152.46297916666666 225.531 C 152.46297916666666 227.531 150.46297916666666 229.531 148.46297916666666 229.531 L 4.101 229.531 C 2.101 229.531 0.101 227.531 0.101 225.531 L 0.101 210.531 C 0.101 208.531 2.101 206.531 4.101 206.531 Z " pathFrom="M 0.101 206.531 L 0.101 206.531 L 0.101 229.531 L 0.101 229.531 L 0.101 229.531 L 0.101 229.531 L 0.101 229.531 L 0.101 206.531 Z" cy="246.173" cx="152.46197916666665" j="5" val="4" barHeight="23" barWidth="152.36197916666666"></path><path id="SvgjsPath1129" d="M 4.101 246.173 L 110.372484375 246.173 C 112.372484375 246.173 114.372484375 248.173 114.372484375 250.173 L 114.372484375 265.173 C 114.372484375 267.173 112.372484375 269.173 110.372484375 269.173 L 4.101 269.173 C 2.101 269.173 0.101 267.173 0.101 265.173 L 0.101 250.173 C 0.101 248.173 2.101 246.173 4.101 246.173 Z " fill="rgba(63,66,84,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area undefined" index="0" clip-path="url(#gridRectBarMask6l4g5133)" pathTo="M 4.101 246.173 L 110.372484375 246.173 C 112.372484375 246.173 114.372484375 248.173 114.372484375 250.173 L 114.372484375 265.173 C 114.372484375 267.173 112.372484375 269.173 110.372484375 269.173 L 4.101 269.173 C 2.101 269.173 0.101 267.173 0.101 265.173 L 0.101 250.173 C 0.101 248.173 2.101 246.173 4.101 246.173 Z " pathFrom="M 0.101 246.173 L 0.101 246.173 L 0.101 269.173 L 0.101 269.173 L 0.101 269.173 L 0.101 269.173 L 0.101 269.173 L 0.101 246.173 Z" cy="285.815" cx="114.371484375" j="6" val="3" barHeight="23" barWidth="114.271484375"></path><g id="SvgjsG1114" class="apexcharts-bar-goals-markers"><g id="SvgjsG1116" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMask6l4g5133)"></g><g id="SvgjsG1118" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMask6l4g5133)"></g><g id="SvgjsG1120" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMask6l4g5133)"></g><g id="SvgjsG1122" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMask6l4g5133)"></g><g id="SvgjsG1124" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMask6l4g5133)"></g><g id="SvgjsG1126" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMask6l4g5133)"></g><g id="SvgjsG1128" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMask6l4g5133)"></g></g><g id="SvgjsG1115" class="apexcharts-bar-shadows apexcharts-hidden-element-shown"></g></g><g id="SvgjsG1113" class="apexcharts-datalabels apexcharts-hidden-element-shown" data:realIndex="0"></g></g><line id="SvgjsLine1144" x1="0" y1="0" x2="571.357421875" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1145" x1="0" y1="0" x2="571.357421875" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1160" class="apexcharts-yaxis apexcharts-xaxis-inversed" rel="0"><g id="SvgjsG1161" class="apexcharts-yaxis-texts-g apexcharts-xaxis-inversed-texts-g" transform="translate(-81.70538330078125, 0)"><text id="SvgjsText1163" font-family="Helvetica, Arial, sans-serif" x="0" y="23.622909090909094" text-anchor="left" dominant-baseline="auto" font-size="14px" font-weight="600" fill="#252f4a" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1164">Phones</tspan><title>Phones</title></text><text id="SvgjsText1166" font-family="Helvetica, Arial, sans-serif" x="0" y="63.2649090909091" text-anchor="left" dominant-baseline="auto" font-size="14px" font-weight="600" fill="#252f4a" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1167">Laptops</tspan><title>Laptops</title></text><text id="SvgjsText1169" font-family="Helvetica, Arial, sans-serif" x="0" y="102.9069090909091" text-anchor="left" dominant-baseline="auto" font-size="14px" font-weight="600" fill="#252f4a" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1170">Headsets</tspan><title>Headsets</title></text><text id="SvgjsText1172" font-family="Helvetica, Arial, sans-serif" x="0" y="142.5489090909091" text-anchor="left" dominant-baseline="auto" font-size="14px" font-weight="600" fill="#252f4a" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1173">Games</tspan><title>Games</title></text><text id="SvgjsText1175" font-family="Helvetica, Arial, sans-serif" x="0" y="182.1909090909091" text-anchor="left" dominant-baseline="auto" font-size="14px" font-weight="600" fill="#252f4a" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1176">Keyboardsy</tspan><title>Keyboardsy</title></text><text id="SvgjsText1178" font-family="Helvetica, Arial, sans-serif" x="0" y="221.83290909090908" text-anchor="left" dominant-baseline="auto" font-size="14px" font-weight="600" fill="#252f4a" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1179">Monitors</tspan><title>Monitors</title></text><text id="SvgjsText1181" font-family="Helvetica, Arial, sans-serif" x="0" y="261.4749090909091" text-anchor="left" dominant-baseline="auto" font-size="14px" font-weight="600" fill="#252f4a" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1182">Speakers</tspan><title>Speakers</title></text></g></g><g id="SvgjsG1146" class="apexcharts-xaxis apexcharts-yaxis-inversed"><g id="SvgjsG1147" class="apexcharts-xaxis-texts-g" transform="translate(0, -9.333333333333334)"><text id="SvgjsText1148" font-family="Helvetica, Arial, sans-serif" x="571.357421875" y="307.494" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="600" fill="#c4cada" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1150">15K</tspan><title>15K</title></text><text id="SvgjsText1151" font-family="Helvetica, Arial, sans-serif" x="380.80494791666666" y="307.494" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="600" fill="#c4cada" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1153">10K</tspan><title>10K</title></text><text id="SvgjsText1154" font-family="Helvetica, Arial, sans-serif" x="190.25247395833338" y="307.494" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="600" fill="#c4cada" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1156">5K</tspan><title>5K</title></text><text id="SvgjsText1157" font-family="Helvetica, Arial, sans-serif" x="-0.2999999999999545" y="307.494" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="600" fill="#c4cada" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1159">0K</tspan><title>0K</title></text></g></g><g id="SvgjsG1183" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1184" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1185" class="apexcharts-point-annotations"></g></g><g id="SvgjsG1109" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"></g><g id="SvgjsG1110" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"></g></svg><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-0" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(62, 151, 255);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Chart widget 5-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-4 mb-5 mb-xl-10">
            <!--begin::Engage widget 1-->
            <div class="card h-md-100" dir="ltr">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column flex-center">
                    <!--begin::Heading-->
                    <div class="mb-2">
                        <!--begin::Title-->
                        <h1 class="fw-semibold text-gray-800 text-center lh-lg">Have you tried
                        <br>new
                        <span class="fw-bolder">Mobile Application ?</span></h1>
                        <!--end::Title-->
                        <!--begin::Illustration-->
                        <div class="py-10 text-center">
                            <img src="assets/media/svg/illustrations/easy/1.svg" class="theme-light-show w-200px" alt="">
                            <img src="assets/media/svg/illustrations/easy/1-dark.svg" class="theme-dark-show w-200px" alt="">
                        </div>
                        <!--end::Illustration-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Links-->
                    <div class="text-center mb-1">
                        <!--begin::Link-->
                        <a class="btn btn-sm btn-primary me-2" data-bs-target="#kt_modal_create_app" data-bs-toggle="modal">Try now</a>
                        <!--end::Link-->
                        <!--begin::Link-->
                        <a class="btn btn-sm btn-light" href="apps/invoices/view/invoice-1.html">Learn more</a>
                        <!--end::Link-->
                    </div>
                    <!--end::Links-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Engage widget 1-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row gy-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-xl-4">
            <!--begin::List widget 5-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-900">Product Delivery</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-6">1M Products Shipped so far</span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <a href="apps/ecommerce/sales/details.html" class="btn btn-sm btn-light">Order Details</a>
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Scroll-->
                    <div class="hover-scroll-overlay-y pe-6 me-n6" style="height: 415px">
                        <!--begin::Item-->
                        <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
                            <!--begin::Info-->
                            <div class="d-flex flex-stack mb-3">
                                <!--begin::Wrapper-->
                                <div class="me-3">
                                    <!--begin::Icon-->
                                    <img src="assets/media/stock/ecommerce/210.png" class="w-50px ms-n1 me-1" alt="">
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bold">Elephant 1802</a>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Action-->
                                <div class="m-0">
                                    <!--begin::Menu-->
                                    <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                        <i class="ki-duotone ki-dots-square fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </button>
                                    <!--begin::Menu 2-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator mb-3 opacity-75"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Ticket</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Customer</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                            <!--begin::Menu item-->
                                            <a href="#" class="menu-link px-3">
                                                <span class="menu-title">New Group</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <!--end::Menu item-->
                                            <!--begin::Menu sub-->
                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Admin Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Staff Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Member Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu sub-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Contact</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator mt-3 opacity-75"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content px-3 py-3">
                                                <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                            </div>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu 2-->
                                    <!--end::Menu-->
                                </div>
                                <!--end::Action-->
                            </div>
                            <!--end::Info-->
                            <!--begin::Customer-->
                            <div class="d-flex flex-stack">
                                <!--begin::Name-->
                                <span class="text-gray-500 fw-bold">To:
                                <a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bold">Jason Bourne</a></span>
                                <!--end::Name-->
                                <!--begin::Label-->
                                <span class="badge badge-light-success">Delivered</span>
                                <!--end::Label-->
                            </div>
                            <!--end::Customer-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
                            <!--begin::Info-->
                            <div class="d-flex flex-stack mb-3">
                                <!--begin::Wrapper-->
                                <div class="me-3">
                                    <!--begin::Icon-->
                                    <img src="assets/media/stock/ecommerce/209.png" class="w-50px ms-n1 me-1" alt="">
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bold">RiseUP</a>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Action-->
                                <div class="m-0">
                                    <!--begin::Menu-->
                                    <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                        <i class="ki-duotone ki-dots-square fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </button>
                                    <!--begin::Menu 2-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator mb-3 opacity-75"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Ticket</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Customer</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                            <!--begin::Menu item-->
                                            <a href="#" class="menu-link px-3">
                                                <span class="menu-title">New Group</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <!--end::Menu item-->
                                            <!--begin::Menu sub-->
                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Admin Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Staff Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Member Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu sub-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Contact</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator mt-3 opacity-75"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content px-3 py-3">
                                                <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                            </div>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu 2-->
                                    <!--end::Menu-->
                                </div>
                                <!--end::Action-->
                            </div>
                            <!--end::Info-->
                            <!--begin::Customer-->
                            <div class="d-flex flex-stack">
                                <!--begin::Name-->
                                <span class="text-gray-500 fw-bold">To:
                                <a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bold">Marie Durant</a></span>
                                <!--end::Name-->
                                <!--begin::Label-->
                                <span class="badge badge-light-primary">Shipping</span>
                                <!--end::Label-->
                            </div>
                            <!--end::Customer-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
                            <!--begin::Info-->
                            <div class="d-flex flex-stack mb-3">
                                <!--begin::Wrapper-->
                                <div class="me-3">
                                    <!--begin::Icon-->
                                    <img src="assets/media/stock/ecommerce/214.png" class="w-50px ms-n1 me-1" alt="">
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bold">Yellow Stone</a>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Action-->
                                <div class="m-0">
                                    <!--begin::Menu-->
                                    <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                        <i class="ki-duotone ki-dots-square fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </button>
                                    <!--begin::Menu 2-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator mb-3 opacity-75"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Ticket</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Customer</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                            <!--begin::Menu item-->
                                            <a href="#" class="menu-link px-3">
                                                <span class="menu-title">New Group</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <!--end::Menu item-->
                                            <!--begin::Menu sub-->
                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Admin Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Staff Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Member Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu sub-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Contact</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator mt-3 opacity-75"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content px-3 py-3">
                                                <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                            </div>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu 2-->
                                    <!--end::Menu-->
                                </div>
                                <!--end::Action-->
                            </div>
                            <!--end::Info-->
                            <!--begin::Customer-->
                            <div class="d-flex flex-stack">
                                <!--begin::Name-->
                                <span class="text-gray-500 fw-bold">To:
                                <a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bold">Dan Wilson</a></span>
                                <!--end::Name-->
                                <!--begin::Label-->
                                <span class="badge badge-light-danger">Confirmed</span>
                                <!--end::Label-->
                            </div>
                            <!--end::Customer-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
                            <!--begin::Info-->
                            <div class="d-flex flex-stack mb-3">
                                <!--begin::Wrapper-->
                                <div class="me-3">
                                    <!--begin::Icon-->
                                    <img src="assets/media/stock/ecommerce/211.png" class="w-50px ms-n1 me-1" alt="">
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bold">Elephant 1802</a>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Action-->
                                <div class="m-0">
                                    <!--begin::Menu-->
                                    <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                        <i class="ki-duotone ki-dots-square fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </button>
                                    <!--begin::Menu 2-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator mb-3 opacity-75"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Ticket</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Customer</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                            <!--begin::Menu item-->
                                            <a href="#" class="menu-link px-3">
                                                <span class="menu-title">New Group</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <!--end::Menu item-->
                                            <!--begin::Menu sub-->
                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Admin Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Staff Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Member Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu sub-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Contact</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator mt-3 opacity-75"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content px-3 py-3">
                                                <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                            </div>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu 2-->
                                    <!--end::Menu-->
                                </div>
                                <!--end::Action-->
                            </div>
                            <!--end::Info-->
                            <!--begin::Customer-->
                            <div class="d-flex flex-stack">
                                <!--begin::Name-->
                                <span class="text-gray-500 fw-bold">To:
                                <a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bold">Lebron Wayde</a></span>
                                <!--end::Name-->
                                <!--begin::Label-->
                                <span class="badge badge-light-success">Delivered</span>
                                <!--end::Label-->
                            </div>
                            <!--end::Customer-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
                            <!--begin::Info-->
                            <div class="d-flex flex-stack mb-3">
                                <!--begin::Wrapper-->
                                <div class="me-3">
                                    <!--begin::Icon-->
                                    <img src="assets/media/stock/ecommerce/215.png" class="w-50px ms-n1 me-1" alt="">
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bold">RiseUP</a>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Action-->
                                <div class="m-0">
                                    <!--begin::Menu-->
                                    <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                        <i class="ki-duotone ki-dots-square fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </button>
                                    <!--begin::Menu 2-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator mb-3 opacity-75"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Ticket</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Customer</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                            <!--begin::Menu item-->
                                            <a href="#" class="menu-link px-3">
                                                <span class="menu-title">New Group</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <!--end::Menu item-->
                                            <!--begin::Menu sub-->
                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Admin Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Staff Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Member Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu sub-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Contact</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator mt-3 opacity-75"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content px-3 py-3">
                                                <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                            </div>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu 2-->
                                    <!--end::Menu-->
                                </div>
                                <!--end::Action-->
                            </div>
                            <!--end::Info-->
                            <!--begin::Customer-->
                            <div class="d-flex flex-stack">
                                <!--begin::Name-->
                                <span class="text-gray-500 fw-bold">To:
                                <a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bold">Ana Simmons</a></span>
                                <!--end::Name-->
                                <!--begin::Label-->
                                <span class="badge badge-light-primary">Shipping</span>
                                <!--end::Label-->
                            </div>
                            <!--end::Customer-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="border border-dashed border-gray-300 rounded px-7 py-3">
                            <!--begin::Info-->
                            <div class="d-flex flex-stack mb-3">
                                <!--begin::Wrapper-->
                                <div class="me-3">
                                    <!--begin::Icon-->
                                    <img src="assets/media/stock/ecommerce/192.png" class="w-50px ms-n1 me-1" alt="">
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bold">Yellow Stone</a>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Action-->
                                <div class="m-0">
                                    <!--begin::Menu-->
                                    <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                        <i class="ki-duotone ki-dots-square fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </button>
                                    <!--begin::Menu 2-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator mb-3 opacity-75"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Ticket</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Customer</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                            <!--begin::Menu item-->
                                            <a href="#" class="menu-link px-3">
                                                <span class="menu-title">New Group</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <!--end::Menu item-->
                                            <!--begin::Menu sub-->
                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Admin Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Staff Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Member Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu sub-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Contact</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator mt-3 opacity-75"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content px-3 py-3">
                                                <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                            </div>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu 2-->
                                    <!--end::Menu-->
                                </div>
                                <!--end::Action-->
                            </div>
                            <!--end::Info-->
                            <!--begin::Customer-->
                            <div class="d-flex flex-stack">
                                <!--begin::Name-->
                                <span class="text-gray-500 fw-bold">To:
                                <a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bold">Kevin Leonard</a></span>
                                <!--end::Name-->
                                <!--begin::Label-->
                                <span class="badge badge-light-danger">Confirmed</span>
                                <!--end::Label-->
                            </div>
                            <!--end::Customer-->
                        </div>
                        <!--end::Item-->
                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::List widget 5-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-8">
            <!--begin::Table Widget 5-->
            <div class="card card-flush h-xl-100">
                <!--begin::Card header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-900">Stock Report</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-6">Total 2,356 Items in the Stock</span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Actions-->
                    <div class="card-toolbar">
                        <!--begin::Filters-->
                        <div class="d-flex flex-stack flex-wrap gap-4">
                            <!--begin::Destination-->
                            <div class="d-flex align-items-center fw-bold">
                                <!--begin::Label-->
                                <div class="text-muted fs-7 me-2">Cateogry</div>
                                <!--end::Label-->
                                <!--begin::Select-->
                                <select class="form-select form-select-transparent text-gray-900 fs-7 lh-1 fw-bold py-0 ps-3 w-auto select2-hidden-accessible" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="Select an option" data-select2-id="select2-data-7-w8r8" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                    <option></option>
                                    <option value="Show All" selected="selected" data-select2-id="select2-data-9-u9cu">Show All</option>
                                    <option value="a">Category A</option>
                                    <option value="b">Category B</option>
                                </select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-8-76ck" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-transparent text-gray-900 fs-7 lh-1 fw-bold py-0 ps-3 w-auto" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-ybzx-container" aria-controls="select2-ybzx-container"><span class="select2-selection__rendered" id="select2-ybzx-container" role="textbox" aria-readonly="true" title="Show All">Show All</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                <!--end::Select-->
                            </div>
                            <!--end::Destination-->
                            <!--begin::Status-->
                            <div class="d-flex align-items-center fw-bold">
                                <!--begin::Label-->
                                <div class="text-muted fs-7 me-2">Status</div>
                                <!--end::Label-->
                                <!--begin::Select-->
                                <select class="form-select form-select-transparent text-gray-900 fs-7 lh-1 fw-bold py-0 ps-3 w-auto select2-hidden-accessible" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="Select an option" data-kt-table-widget-5="filter_status" data-select2-id="select2-data-10-p8y9" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                    <option></option>
                                    <option value="Show All" selected="selected" data-select2-id="select2-data-12-2hlm">Show All</option>
                                    <option value="In Stock">In Stock</option>
                                    <option value="Out of Stock">Out of Stock</option>
                                    <option value="Low Stock">Low Stock</option>
                                </select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-11-5q6k" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-transparent text-gray-900 fs-7 lh-1 fw-bold py-0 ps-3 w-auto" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-8slw-container" aria-controls="select2-8slw-container"><span class="select2-selection__rendered" id="select2-8slw-container" role="textbox" aria-readonly="true" title="Show All">Show All</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                <!--end::Select-->
                            </div>
                            <!--end::Status-->
                            <!--begin::Search-->
                            <a href="apps/ecommerce/catalog/products.html" class="btn btn-light btn-sm">View Stock</a>
                            <!--end::Search-->
                        </div>
                        <!--begin::Filters-->
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Table-->
                    <div id="kt_table_widget_5_table_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer"><div id="" class="table-responsive"><table class="table align-middle table-row-dashed fs-6 gy-3 dataTable" id="kt_table_widget_5_table" style="width: 100%;"><colgroup><col data-dt-column="0" style="width: 150px;"><col data-dt-column="1" style="width: 100px;"><col data-dt-column="2" style="width: 150px;"><col data-dt-column="3" style="width: 100px;"><col data-dt-column="4" style="width: 119.484px;"><col data-dt-column="5" style="width: 75px;"></colgroup>
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0"><th class="min-w-150px dt-orderable-asc dt-orderable-desc" data-dt-column="0" rowspan="1" colspan="1" aria-label="Item: Activate to sort" tabindex="0"><span class="dt-column-title" role="button">Item</span><span class="dt-column-order"></span></th><th class="text-end pe-3 min-w-100px dt-orderable-none" data-dt-column="1" rowspan="1" colspan="1" aria-label="Product ID"><span class="dt-column-title">Product ID</span><span class="dt-column-order"></span></th><th class="text-end pe-3 min-w-150px dt-orderable-asc dt-orderable-desc" data-dt-column="2" rowspan="1" colspan="1" aria-label="Date Added: Activate to sort" tabindex="0"><span class="dt-column-title" role="button">Date Added</span><span class="dt-column-order"></span></th><th class="text-end pe-3 min-w-100px dt-type-numeric dt-orderable-asc dt-orderable-desc" data-dt-column="3" rowspan="1" colspan="1" aria-label="Price: Activate to sort" tabindex="0"><span class="dt-column-title" role="button">Price</span><span class="dt-column-order"></span></th><th class="text-end pe-3 min-w-100px dt-orderable-asc dt-orderable-desc" data-dt-column="4" rowspan="1" colspan="1" aria-label="Status: Activate to sort" tabindex="0"><span class="dt-column-title" role="button">Status</span><span class="dt-column-order"></span></th><th class="text-end pe-0 min-w-75px dt-type-numeric dt-orderable-asc dt-orderable-desc" data-dt-column="5" rowspan="1" colspan="1" aria-label="Qty: Activate to sort" tabindex="0"><span class="dt-column-title" role="button">Qty</span><span class="dt-column-order"></span></th></tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600"><tr>
                                <!--begin::Item-->
                                <td>
                                    <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-900 text-hover-primary">Macbook Air M1</a>
                                </td>
                                <!--end::Item-->
                                <!--begin::Product ID-->
                                <td class="text-end">#XGY-356</td>
                                <!--end::Product ID-->
                                <!--begin::Date added-->
                                <td class="text-end" data-order="2024-04-20T00:00:00-05:00">02 Apr, 2024</td>
                                <!--end::Date added-->
                                <!--begin::Price-->
                                <td class="text-end dt-type-numeric">$1,230</td>
                                <!--end::Price-->
                                <!--begin::Status-->
                                <td class="text-end">
                                    <span class="badge py-3 px-4 fs-7 badge-light-primary">In Stock</span>
                                </td>
                                <!--end::Status-->
                                <!--begin::Qty-->
                                <td class="text-end dt-type-numeric" data-order="58">
                                    <span class="text-gray-900 fw-bold">58 PCS</span>
                                </td>
                                <!--end::Qty-->
                            </tr><tr>
                                <!--begin::Item-->
                                <td>
                                    <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-900 text-hover-primary">Surface Laptop 4</a>
                                </td>
                                <!--end::Item-->
                                <!--begin::Product ID-->
                                <td class="text-end">#YHD-047</td>
                                <!--end::Product ID-->
                                <!--begin::Date added-->
                                <td class="text-end" data-order="2024-04-20T00:00:00-05:00">01 Apr, 2024</td>
                                <!--end::Date added-->
                                <!--begin::Price-->
                                <td class="text-end dt-type-numeric">$1,060</td>
                                <!--end::Price-->
                                <!--begin::Status-->
                                <td class="text-end">
                                    <span class="badge py-3 px-4 fs-7 badge-light-danger">Out of Stock</span>
                                </td>
                                <!--end::Status-->
                                <!--begin::Qty-->
                                <td class="text-end dt-type-numeric" data-order="0">
                                    <span class="text-gray-900 fw-bold">0 PCS</span>
                                </td>
                                <!--end::Qty-->
                            </tr><tr>
                                <!--begin::Item-->
                                <td>
                                    <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-900 text-hover-primary">Logitech MX 250</a>
                                </td>
                                <!--end::Item-->
                                <!--begin::Product ID-->
                                <td class="text-end">#SRR-678</td>
                                <!--end::Product ID-->
                                <!--begin::Date added-->
                                <td class="text-end" data-order="2024-03-20T00:00:00-05:00">24 Mar, 2024</td>
                                <!--end::Date added-->
                                <!--begin::Price-->
                                <td class="text-end dt-type-numeric">$64</td>
                                <!--end::Price-->
                                <!--begin::Status-->
                                <td class="text-end">
                                    <span class="badge py-3 px-4 fs-7 badge-light-primary">In Stock</span>
                                </td>
                                <!--end::Status-->
                                <!--begin::Qty-->
                                <td class="text-end dt-type-numeric" data-order="290">
                                    <span class="text-gray-900 fw-bold">290 PCS</span>
                                </td>
                                <!--end::Qty-->
                            </tr><tr>
                                <!--begin::Item-->
                                <td>
                                    <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-900 text-hover-primary">AudioEngine HD3</a>
                                </td>
                                <!--end::Item-->
                                <!--begin::Product ID-->
                                <td class="text-end">#PXF-578</td>
                                <!--end::Product ID-->
                                <!--begin::Date added-->
                                <td class="text-end" data-order="2024-03-20T00:00:00-05:00">24 Mar, 2024</td>
                                <!--end::Date added-->
                                <!--begin::Price-->
                                <td class="text-end dt-type-numeric">$1,060</td>
                                <!--end::Price-->
                                <!--begin::Status-->
                                <td class="text-end">
                                    <span class="badge py-3 px-4 fs-7 badge-light-danger">Out of Stock</span>
                                </td>
                                <!--end::Status-->
                                <!--begin::Qty-->
                                <td class="text-end dt-type-numeric" data-order="46">
                                    <span class="text-gray-900 fw-bold">46 PCS</span>
                                </td>
                                <!--end::Qty-->
                            </tr><tr>
                                <!--begin::Item-->
                                <td>
                                    <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-900 text-hover-primary">HP Hyper LTR</a>
                                </td>
                                <!--end::Item-->
                                <!--begin::Product ID-->
                                <td class="text-end">#PXF-778</td>
                                <!--end::Product ID-->
                                <!--begin::Date added-->
                                <td class="text-end" data-order="2024-01-20T00:00:00-05:00">16 Jan, 2024</td>
                                <!--end::Date added-->
                                <!--begin::Price-->
                                <td class="text-end dt-type-numeric">$4500</td>
                                <!--end::Price-->
                                <!--begin::Status-->
                                <td class="text-end">
                                    <span class="badge py-3 px-4 fs-7 badge-light-primary">In Stock</span>
                                </td>
                                <!--end::Status-->
                                <!--begin::Qty-->
                                <td class="text-end dt-type-numeric" data-order="78">
                                    <span class="text-gray-900 fw-bold">78 PCS</span>
                                </td>
                                <!--end::Qty-->
                            </tr><tr>
                                <!--begin::Item-->
                                <td>
                                    <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-900 text-hover-primary">Dell 32 UltraSharp</a>
                                </td>
                                <!--end::Item-->
                                <!--begin::Product ID-->
                                <td class="text-end">#XGY-356</td>
                                <!--end::Product ID-->
                                <!--begin::Date added-->
                                <td class="text-end" data-order="2024-12-20T00:00:00-05:00">22 Dec, 2024</td>
                                <!--end::Date added-->
                                <!--begin::Price-->
                                <td class="text-end dt-type-numeric">$1,060</td>
                                <!--end::Price-->
                                <!--begin::Status-->
                                <td class="text-end">
                                    <span class="badge py-3 px-4 fs-7 badge-light-warning">Low Stock</span>
                                </td>
                                <!--end::Status-->
                                <!--begin::Qty-->
                                <td class="text-end dt-type-numeric" data-order="8">
                                    <span class="text-gray-900 fw-bold">8 PCS</span>
                                </td>
                                <!--end::Qty-->
                            </tr><tr>
                                <!--begin::Item-->
                                <td>
                                    <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-900 text-hover-primary">Google Pixel 6 Pro</a>
                                </td>
                                <!--end::Item-->
                                <!--begin::Product ID-->
                                <td class="text-end">#XVR-425</td>
                                <!--end::Product ID-->
                                <!--begin::Date added-->
                                <td class="text-end" data-order="2024-12-20T00:00:00-05:00">27 Dec, 2024</td>
                                <!--end::Date added-->
                                <!--begin::Price-->
                                <td class="text-end dt-type-numeric">$1,060</td>
                                <!--end::Price-->
                                <!--begin::Status-->
                                <td class="text-end">
                                    <span class="badge py-3 px-4 fs-7 badge-light-primary">In Stock</span>
                                </td>
                                <!--end::Status-->
                                <!--begin::Qty-->
                                <td class="text-end dt-type-numeric" data-order="124">
                                    <span class="text-gray-900 fw-bold">124 PCS</span>
                                </td>
                                <!--end::Qty-->
                            </tr></tbody>
                        <!--end::Table body-->
                    <tfoot></tfoot></table></div><div id="" class="row"><div id="" class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start dt-toolbar"></div><div id="" class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end"></div></div></div>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Table Widget 5-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
</div>
@endsection
