<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Swinburne | VN</title>

    <!-- Google Font: Source Sans Pro -->
    @include('admin.templates.css')
</head>

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right
    kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed
    kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
    <div class="kt-header-mobile__logo">
        <a href="index.html">
            <img alt="Logo" src="assets/media/logos/logo-light.png"/>
        </a>
    </div>
    <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler">
            <span></span></button>
        <button class="kt-header-mobile__toggler" id="kt_header_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i
                class="flaticon-more"></i></button>
    </div>
</div>
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        @include('admin.templates.nav-bar')
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
            @include('admin.templates.header')
            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                @yield('content')
            </div>
            @include('admin.templates.footer')
        </div>
    </div>
</div>
@include('admin.templates.script')

</body>
</html>
