<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
    <!-- begin:: Aside -->
    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
        <br>
        <div class="kt-aside__brand-logo">
            <a href="{{route('rooms.index')}}">
                <img alt="Logo" src="{{asset('assets/admin/images/Logo_Technology.png')}}"/>
            </a>
        </div>
        <div class="kt-aside__brand-tools">
            <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
								<span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                           width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                           class="kt-svg-icon">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon points="0 0 24 0 24 24 0 24"/>
											<path
                                                d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                                fill="#000000" fill-rule="nonzero"
                                                transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) "/>
											<path
                                                d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3"
                                                transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) "/>
										</g>
									</svg></span>
                <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                           height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon points="0 0 24 0 24 24 0 24"/>
											<path
                                                d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z"
                                                fill="#000000" fill-rule="nonzero"/>
											<path
                                                d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3"
                                                transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "/>
										</g>
									</svg></span>
            </button>
            <!--
<button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
-->
        </div>
    </div>

    <!-- end:: Aside -->

    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1"
             data-ktmenu-dropdown-timeout="500">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__item kt-menu__item--active" aria-haspopup="true">
                    <a href="{{route('rooms.index')}}" class="kt-menu__link "><span
                            class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1"
                                                            class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24"/>
													<path
                                                        d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                                        fill="#000000" fill-rule="nonzero"/>
													<path
                                                        d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                                        fill="#000000" opacity="0.3"/>
												</g>
											</svg></span><span class="kt-menu__link-text">Dashboard</span></a></li>
                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">Custom</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                    <li class="kt-menu__item {{ Route::is('applications.*') ? 'kt-menu__item--open kt-menu__item--here' : '' }} kt-menu__item--submenu" aria-haspopup="true"
                        data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                                              class="kt-menu__link kt-menu__toggle"><span
                                class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                height="24px" viewBox="0 0 24 24" version="1.1"
                                                                class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"/>
													<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"/>
													<path
                                                        d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                                        fill="#000000" opacity="0.3"/>
												</g>
											</svg></span><span class="kt-menu__link-text">Applications</span><i
                                class="kt-menu__ver-arrow la la-angle-right"></i></a>
                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                        class="kt-menu__link"><span
                                            class="kt-menu__link-text">Applications</span></span>
                                </li>
                                <li class="kt-menu__item {{ Route::is('users.*') ? 'kt-menu__item--open kt-menu__item--here' : '' }} kt-menu__item--submenu" aria-haspopup="true"
                                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                                                          class="kt-menu__link kt-menu__toggle"><i
                                            class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                            class="kt-menu__link-text">Users</span><i
                                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item {{ Route::is('users.index') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                                <a href="{{route('users.index')}}" class="kt-menu__link ">
                                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                        class="kt-menu__link-text">List User</span></a>
                                            </li>
                                            <li class="kt-menu__item {{ Route::is('users.trash') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a
                                                    href="{{route('users.trash')}}" class="kt-menu__link "><i
                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                        class="kt-menu__link-text">Account Is Canceled</span></a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="kt-menu__item {{ Route::is('roles.*') ? 'kt-menu__item--open kt-menu__item--here' : '' }} kt-menu__item--submenu" aria-haspopup="true"
                                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                                                          class="kt-menu__link kt-menu__toggle"><i
                                            class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                            class="kt-menu__link-text">Roles</span><i
                                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item {{ Route::is('roles.index') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                                <a href="{{route('roles.index')}}" class="kt-menu__link ">
                                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                        class="kt-menu__link-text">List Role</span></a>
                                            </li>
                                            <li class="kt-menu__item {{ Route::is('roles.create') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a
                                                    href="{{route('roles.create')}}" class="kt-menu__link ">
                                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                        class="kt-menu__link-text">Create Role</span></a></li>
                                            <li class="kt-menu__item {{ Route::is('roles.trash') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a
                                                    href="{{route('roles.trash')}}" class="kt-menu__link "><i
                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                        class="kt-menu__link-text">Account Is Canceled</span></a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                                                          class="kt-menu__link kt-menu__toggle"><i
                                            class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                            class="kt-menu__link-text">Permissions</span><i
                                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item " aria-haspopup="true">
                                                <a href="{{route('permissions.index')}}" class="kt-menu__link ">
                                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                        class="kt-menu__link-text">List Permissions</span></a>
                                            </li>
                                            <li class="kt-menu__item " aria-haspopup="true"><a
                                                    href="{{route('permissions.create')}}" class="kt-menu__link ">
                                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                        class="kt-menu__link-text">Create Permissions</span></a></li>
                                            <li class="kt-menu__item " aria-haspopup="true"><a
                                                    href="{{route('permissions.trash')}}" class="kt-menu__link "><i
                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                        class="kt-menu__link-text">Account Is Canceled</span></a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                                          class="kt-menu__link kt-menu__toggle"><span
                            class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1"
                                                            class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"/>
													<rect fill="#000000" opacity="0.3" x="4" y="4" width="8"
                                                          height="16"/>
													<path
                                                        d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z"
                                                        fill="#000000" fill-rule="nonzero"/>
												</g>
											</svg></span><span class="kt-menu__link-text">Rooms</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                    class="kt-menu__link"><span class="kt-menu__link-text">Rooms</span></span></li>
                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                                                      class="kt-menu__link kt-menu__toggle"><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">Settings Room</span><i
                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item " aria-haspopup="true"><a
                                                href="{{ route('rooms.index') }}" class="kt-menu__link "><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                    class="kt-menu__link-text">Book Rooms</span></a></li>
                                        <li class="kt-menu__item " aria-haspopup="true"><a
                                                href="{{ route('list.rooms') }}" class="kt-menu__link "><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                    class="kt-menu__link-text">List Rooms</span></a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                                          class="kt-menu__link kt-menu__toggle"><span
                            class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1"
                                                            class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"></rect>
													<path
                                                        d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z"
                                                        fill="#000000" opacity="0.3"></path>
													<path
                                                        d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z"
                                                        fill="#000000"></path>
												</g>
											</svg></span><span class="kt-menu__link-text">Course</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                    class="kt-menu__link"><span
                                        class="kt-menu__link-text">Course</span></span></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a
                                    href="{{ route('course.index') }}" class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">List Course</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a
                                    href="{{ route('course.create') }}" class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">Create Course</span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                                          class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                              xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                              height="24px" viewBox="0 0 24 24" version="1.1"
                                                              class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"></rect>
													<path
                                                        d="M5,5 L5,15 C5,15.5948613 5.25970314,16.1290656 5.6719139,16.4954176 C5.71978107,16.5379595 5.76682388,16.5788906 5.81365532,16.6178662 C5.82524933,16.6294602 15,7.45470952 15,7.45470952 C15,6.9962515 15,6.17801499 15,5 L5,5 Z M5,3 L15,3 C16.1045695,3 17,3.8954305 17,5 L17,15 C17,17.209139 15.209139,19 13,19 L7,19 C4.790861,19 3,17.209139 3,15 L3,5 C3,3.8954305 3.8954305,3 5,3 Z"
                                                        fill="#000000" fill-rule="nonzero"
                                                        transform="translate(10.000000, 11.000000) rotate(-315.000000) translate(-10.000000, -11.000000) "></path>
													<path
                                                        d="M20,22 C21.6568542,22 23,20.6568542 23,19 C23,17.8954305 22,16.2287638 20,14 C18,16.2287638 17,17.8954305 17,19 C17,20.6568542 18.3431458,22 20,22 Z"
                                                        fill="#000000" opacity="0.3"></path>
												</g>
											</svg></span>
                        <span class="kt-menu__link-text">Term</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                    class="kt-menu__link"><span class="kt-menu__link-text">Term</span></span>
                            </li>
                            <li class="kt-menu__item " aria-haspopup="true"><a
                                    href="{{ route('term.index') }}" class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">List Term</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a
                                    href="{{ route('term.trash') }}" class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">Term Cancel</span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                                          class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"></rect>
													<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
													<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
												</g>
											</svg></span>
                        <span class="kt-menu__link-text">Group</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                    class="kt-menu__link"><span
                                        class="kt-menu__link-text">Group</span></span></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a
                                    href="{{ route('group.index') }}" class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">List Group</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a
                                    href="{{ route('group.schedule') }}" class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">Schedule</span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                                          class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"></rect>
													<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
													<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
												</g>
											</svg></span>
                        <span class="kt-menu__link-text">Event</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                    class="kt-menu__link"><span
                                        class="kt-menu__link-text">Event</span></span></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a
                                    href="{{ route('event.index') }}" class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">List Event</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a
                                    href="{{ route('event.history') }}" class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">History Event</span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                                          class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"></rect>
													<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
													<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
												</g>
											</svg></span>
                        <span class="kt-menu__link-text">Club</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                    class="kt-menu__link"><span
                                        class="kt-menu__link-text">Club</span></span></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a
                                    href="{{ route('club.index') }}" class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">Club List</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a
                                    href="#" class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">History Club</span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                                          class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"></rect>
													<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
													<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
												</g>
											</svg></span>
                        <span class="kt-menu__link-text">Items</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                    class="kt-menu__link"><span
                                        class="kt-menu__link-text">List</span></span></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a
                                    href="{{ route('items.list') }}" class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">Item List</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a
                                    href="{{ route('items.category') }}" class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">Item Categories</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a
                                    href="{{ route('bills.index') }}" class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">Bills</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a
                                    href="{{ route('promotion.index') }}" class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">Promotions</span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                                          class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"></rect>
													<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
													<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
												</g>
											</svg></span>
                        <span class="kt-menu__link-text">Survey</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                    class="kt-menu__link"><span
                                        class="kt-menu__link-text">List</span></span></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a
                                    href="{{ route('survey.list') }}" class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">List</span></a></li>
{{--                            <li class="kt-menu__item " aria-haspopup="true"><a--}}
{{--                                    href="{{ route('survey.answer') }}" class="kt-menu__link "><i--}}
{{--                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span--}}
{{--                                        class="kt-menu__link-text">Item Categories</span></a></li>--}}

                        </ul>
                    </div>
                </li>

                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover"><a href="{{ route('personal.index') }}"
                                                          class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"></rect>
													<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
													<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
												</g>
											</svg></span>
                        <span class="kt-menu__link-text">Personal Information</span></a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                                          class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"></rect>
													<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
													<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
												</g>
											</svg></span>
                        <span class="kt-menu__link-text">Fees</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                    class="kt-menu__link"><span
                                        class="kt-menu__link-text">Tuition Fee</span></span></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a
                                    href="{{ route('fee.index') }}" class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">Tuition Fee</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a
                                    href="{{ route('event.email') }}" class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">Send Mail</span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                                          class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"></rect>
													<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
													<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
												</g>
											</svg></span>
                        <span class="kt-menu__link-text">Notifications</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                    class="kt-menu__link"><span
                                        class="kt-menu__link-text">Notifications</span></span></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a
                                    href="{{ route('notifications.list-send') }}" class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">List Send Mail</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a
                                    href="{{ route('notifications.send.grade') }}" class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">Send Grade</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a
                                    href="{{ route('notifications.send.group') }}" class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                        class="kt-menu__link-text">Send Group</span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover"><a href="{{ route('evaluate.index') }}"
                                                          class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"></rect>
													<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
													<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
												</g>
											</svg></span>
                        <span class="kt-menu__link-text">Student ACB</span></a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover"><a href="{{ route('queries.index') }}"
                                                          class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"></rect>
													<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
													<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
												</g>
											</svg></span>
                        <span class="kt-menu__link-text">Queries</span></a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover"><a href="{{ route('curriculum.index') }}"
                                                          class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"></rect>
													<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
													<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
												</g>
											</svg></span>
                        <span class="kt-menu__link-text">Curriculum</span></a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover"><a href="{{ route('student.index') }}"
                                                          class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"></rect>
													<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
													<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
												</g>
											</svg></span>
                        <span class="kt-menu__link-text">List Student</span></a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover"><a href="{{ route('gold.index') }}"
                                                          class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"></rect>
													<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
													<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
												</g>
											</svg></span>
                        <span class="kt-menu__link-text">Gold</span></a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover"><a href="{{ route('guidline.index') }}"
                                                          class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"></rect>
													<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
													<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
												</g>
											</svg></span>
                        <span class="kt-menu__link-text">Guidline</span></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- end:: Aside Menu -->
</div>
