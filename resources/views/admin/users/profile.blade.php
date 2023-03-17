@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Users', 'value' => "Profile", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <!--Begin::App-->
        <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

            <!--Begin:: App Aside Mobile Toggle-->
            <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
                <i class="la la-close"></i>
            </button>

            <!--End:: App Aside Mobile Toggle-->

            <!--Begin:: App Aside-->
            <div class="kt-grid__item kt-app__toggle kt-app__aside" id="kt_user_profile_aside">

                <!--begin:: Widgets/Applications/User/Profile1-->
                <div class="kt-portlet ">
                    <div class="kt-portlet__head  kt-portlet__head--noborder">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body kt-portlet__body--fit-y">

                        <!--begin::Widget -->
                        <div class="kt-widget kt-widget--user-profile-1">
                            <div class="kt-widget__head">
                                <div class="kt-widget__media">
                                    <img src="{{ asset('storage/images/636382c3288a0_306039235_khiet-dan.png' ) }}"
                                         alt="image">
                                </div>
                                <div class="kt-widget__content">
                                    <div class="kt-widget__section">
                                        <a href="#" class="kt-widget__username">
                                            {{ $user->user_surname .' '. $user->user_middlename .' '. $user->user_givenname  }}
                                            <i class="flaticon2-correct kt-font-success"></i>
                                        </a>
                                        <span class="kt-widget__subtitle">
														Major: {{ $user->nganh }}
															</span>
                                    </div>
                                    <div class="kt-widget__action">
                                        <button type="button" class="btn btn-info btn-sm">chat</button>&nbsp;
                                        <button type="button" class="btn btn-success btn-sm">follow</button>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-widget__body">
                                <div class="kt-widget__content">
                                    <div class="kt-widget__info">
                                        <span class="kt-widget__label">Email:</span>
                                        <a href="#" class="kt-widget__data">{{ $user->user_email }}</a>
                                    </div>
                                    <div class="kt-widget__info">
                                        <span class="kt-widget__label">Phone:</span>
                                        <a href="#" class="kt-widget__data">{{ $user->user_telephone }}</a>
                                    </div>
                                    <div class="kt-widget__info">
                                        <span class="kt-widget__label">Location: </span>
                                        <span class="kt-widget__data col-lg-9 col-xl-8">{{ $user->user_address }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--end::Widget -->
                    </div>
                </div>

                <!--end:: Widgets/Applications/User/Profile1-->
            </div>

            <!--End:: App Aside-->

            <!--Begin:: App Content-->
            <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="kt-portlet">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">Account Information</h3>
                                </div>
                            </div>
                            <form class="kt-form kt-form--label-right">
                                <div class="kt-portlet__body">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Full name:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="text" disabled
                                                           value="{{ $user->user_surname .' '. $user->user_middlename .' '. $user->user_givenname }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">User code:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="text" disabled
                                                           value="{{ $user->user_code }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">User code AU:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="text"
                                                           value="{{ $user->user_code_au }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Gender:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <select class="form-control">
                                                        <option {{ $user->gender == 0 ? "selected" : "" }} value="0">Nữ</option>
                                                        <option {{ $user->gender == 1 ? "selected" : "" }} value="1">Nam</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Date of birth:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="date"
                                                           value="{{ $user->user_DOB }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Email:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="text" disabled
                                                           value="{{ $user->user_email }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Personal email:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="text" disabled
                                                           value="{{ $user->personal_email }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Address:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="text" disabled
                                                           value="{{ $user->user_address }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">User Telephone:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="text" disabled
                                                           value="{{ $user->user_telephone }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Address:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="text" disabled
                                                           value="{{ $user->user_address }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Parent Telephone:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="text" disabled
                                                           value="{{ $user->ph_telephone }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Course Plan:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="text" disabled
                                                           value="{{ $user->nganh }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Major Plan:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="text" disabled
                                                           value="{{ $user->major_lecturer }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Intake Year:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="text" value="{{ $user->intake }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Intake Major:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" disabled type="text" value="{{ $user->intake_major }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Identity card/Passport::</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" disabled type="text" value="{{ $user->cmt }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Admission Date:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" disabled type="text" value="{{ $user->created_date }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Semester:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <select class="form-control">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Scholarship:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" disabled type="text" value="{{ $user->promotion }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--End:: App Content-->
        </div>
        <!--End::App-->
    </div>
@endsection
