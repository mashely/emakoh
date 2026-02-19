<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="assets/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="assets/images/logo-dark.png" alt="" height="17">
                        </span>
                    </a>

                    <a href="index.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="assets/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="assets/images/logo-light.png" alt="" height="17">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                    id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- App Search-->
                <form class="app-search d-none d-md-block">
                    <div class="position-relative">
                        <input type="hidden" class="form-control" placeholder="Search..." autocomplete="off"
                            id="search-options" value="" >
                        {{-- <span class="mdi mdi-magnify search-widget-icon"></span> --}}
                        <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                            id="search-close-options"></span>
                    </div>
                </form>
            </div>

            <div class="d-flex align-items-center">

                <div class="dropdown d-md-none topbar-head-dropdown header-item" style="display: none">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="bx bx-search fs-22"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-search-dropdown">
                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..."
                                        aria-label="Recipient's username">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="dropdown topbar-head-dropdown ms-1 header-item">
                    <button type="button" class="btn btn-light waves-effect"
                        id="page-header-cart-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                        aria-haspopup="true" aria-expanded="false">
                        <i class='bx bx-search-alt-2'></i> {{ __('app.search') }} ....
                    </button>
                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end p-0 dropdown-menu-cart"
                        aria-labelledby="page-header-cart-dropdown">
                        <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
                            <div class="row align-items-center text-center">
                                <div class="col">
                                    <h6 class="m-0 fs-16 fw-semibold"> {{ __('app.client_search') }}</h6>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 300px;">
                            <div class="p-2">
                                <form action="{{ route('client.search')}}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="Client ID" class="form-label">{{ __('app.search_client_id') }}</label>
                                        <input type="number"  class="form-control" name="client_id" placeholder="Enter Client ID ..."  />
                                    </div>
                                    <div class="mb-3">
                                        <label for="Phone Number" class="form-label">{{ __('app.search_phone_number') }}</label>
                                        <input type="number" class="form-control" name="phone_number" placeholder="Enter Phone Number ....." />
                                    </div>
                                    <div class="mb-3">
                                        <label for="Phone Number" class="form-label">{{ __('app.search_id_number') }}</label>
                                        <input type="number" class="form-control" name="id_number" placeholder="Enter ID Number ....." />
                                    </div>
                                    <div class="mb-3">
                                        <button  type="submit" class="btn btn-success text-center w-100"> <i class='bx bx-search-alt-2'></i> {{ __('app.search') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button"
                        class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>
                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="{{ asset('assets/images/users/user-dummy-img.jpg')}}"
                                alt="Header Avatar">
                                {{-- <i class="las la-user"></i> --}}
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ Auth::user()->name }}</span>
                                {{-- <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">Founder</span> --}}
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">{{ __('app.welcome') }} {{ Auth::user()->name }}!</h6>
                        <a class="dropdown-item" href="{{ route('profile.index')}}"><i
                                class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">{{ __('app.profile') }}</span></a>
                        <a class="dropdown-item" href="#"><i
                                class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">{{ __('app.settings') }}</span></a>
                        {{-- <a class="dropdown-item" href="auth-lockscreen-basic.html"><i
                                class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">Lock screen</span></a> --}}
                        <a class="dropdown-item" href="{{ route('logout.user')}}"><i
                                class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle" data-key="t-logout">{{ __('app.logout') }}</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
