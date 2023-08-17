<!DOCTYPE html>
<html lang="en">
<head>
    <base href="../../../">
    <meta charset="utf-8"/>
    <title>Swinburne | VN</title>
    <meta name="description" content="Login page example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Page Custom Styles(used by this page) -->
    @include('admin.templates.css')
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body
    class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
        <div
            class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">

            <!--begin::Aside-->
            <div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside"
                 style="background-image: url({{asset('assets/admin/images/bg-4.jpg')}});">
                <div class="kt-grid__item">
                    <a href="#" class="kt-login__logo">
                        <img src="{{asset('assets/admin/images/Swinburne-logo.jpg')}}" style="width:150px">
                    </a>
                </div>
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
                    <div class="kt-grid__item kt-grid__item--middle">
                        <h3 class="kt-login__title">Welcome to Swinburne!</h3>
                        <h4 class="kt-login__subtitle">The ultimate Bootstrap & Angular 6 admin theme framework for next
                            generation web apps.</h4>
                    </div>
                </div>
                <div class="kt-grid__item">
                    <div class="kt-login__info">
                        <div class="kt-login__copyright">
                            &copy 2022 Swinburne VN
                        </div>
                    </div>
                </div>
            </div>
            <!--begin::Aside-->
            <!--begin::Content-->
            <div
                class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">
                <!--begin::Head-->
                <!--end::Head-->
                <!--begin::Body-->
                <div class="kt-login__body">

                    <!--begin::Signin-->
                    <div class="kt-login__form">
                        <div class="kt-login__title">
                            <h3>Sign In</h3>
                        </div>
                        <!--begin::Form-->
                        <form enctype="multipart/form-data"
                              class="kt-form" action="" name="campusform" novalidate="novalidate" id="kt_login_form">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Username or email"
                                       name="user_email">
                            </div>
                            @error('user_email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <input class="form-control" type="password" placeholder="Password" name="password">
                            </div>
                            @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="row kt-login__extra" style="margin-top: 10px">
                                <div class="col">
                                    <label class="kt-checkbox">
                                        <input type="checkbox" name="remember_token"> Remember me
                                        <span></span>
                                    </label>
                                </div>
                                <div class="col kt-align-right">
                                    <a href="javascript:;" id="kt_login_forgot" class="kt-link kt-login__link">Forget
                                        Password ?</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelect1">Choose Campus</label>
                                <select class="form-control" id="campus_id" name="campus_id">
                                    <option value="">Choose Campus</option>
                                    @if(!empty($campus))
                                        {
                                        @for($i = 0; $i < count($campus); $i++)
                                            <option {{ $campusCode == $campus[$i]->campus_code ? 'selected' : ""}}
                                                    value="{{ $campus[$i]->campus_code}}">{{ $campus[$i]->campus_name }}</option>
                                        @endfor
                                    @endif
                                </select>
                            </div>
                            <div class="pt-1 mb-4">
                                <button class="btn btn-danger btn-lg btn-block" id="btn_login_google" type="button"><i
                                        class="fab fa-google"></i>
                                    Sign In With
                                </button>
                            </div>
                            <!--begin::Action-->
                            <!--end::Action-->
                        </form>
                        <!--end::Form-->
                        <!--begin::Divider-->
                        <!--begin::Options-->

                        <!--end::Options-->
                    </div>
                    <!--end::Signin-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Content-->
        </div>
    </div>
</div>
<!-- end:: Page -->
@include('admin.templates.script')

<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>
