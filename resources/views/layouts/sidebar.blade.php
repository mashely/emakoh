<style>
    #fp-logo{
        color: white;
        font-size: 25px;
        font-weight: 900;
    }
</style>
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="#" class="logo logo-dark">
            <span class="logo-sm">
                <i id="fp-logo">fplan-kidigital</i>
                {{-- <img src="{{ asset('assets/images/logo-sm.png')}}" alt="" height="22"> --}}
            </span>
            <span class="logo-lg">
                <i id="fp-logo">fplan-kidigital </i>
                {{-- <img src="{{ asset('assets/images/logo-dark.png')}}" alt="" height="17"> --}}
            </span>
        </a>
        <!-- Light Logo-->
        <a href="#" class="logo logo-light">
            <span class="logo-sm">
                <i id="fp-logo">fplan-kidigital </i>
                {{-- <img src="{{ asset('assets/images/logo-sm.png')}}" alt="" height="22"> --}}
            </span>
            <span class="logo-lg">
                <i id="fp-logo">fplan-kidigital  </i>
                {{-- <img src="{{ asset('assets/images/logo-light.png')}}" alt="" height="17"> --}}
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Dashboard</span></li>
                @if (Auth::user()->hasRole(1))
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ url('dashboard')}}">
                        <i class="bx bx-home"></i> <span data-key="t-landing">Home</span>
                    </a>
                </li>

                @endif
                @if ((Auth::user()->hasRole(2) || Auth::user()->hasRole(3)))
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('hospital.dashboard')}}">
                        <i class="bx bx-home"></i> <span data-key="t-landing">Home</span>
                    </a>
                </li>
                @endif
                <li class="menu-title"><span data-key="t-menu">Clients</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('clients.list')}}">
                        <i class="bx bxs-user-detail"></i> <span data-key="t-landing">Clients</span>
                    </a>
                </li>
                <li class="menu-title"><span data-key="t-menu"></span>Pregnant Woman</li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('clients.list')}}">
                        <i class="bx bxs-user-detail"></i> <span data-key="t-landing">Pregnant Woman</span>
                    </a>
                </li>
                <li class="menu-title"><span data-key="t-menu">Reminders</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('appointments.list')}}">
                        <i class="bx bx-list-ol"></i> <span data-key="t-landing">Reminders</span>
                        @if (todayReminders() > 0)
                        <span class="badge badge-pill bg-danger" data-key="t-new">{{ todayReminders() }}</span>
                        @endif

                    </a>
                </li>
                @if (Auth::user()->hasRole(1))
                <li class="menu-title"><span data-key="t-menu">Management</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('hospitals.list')}}">
                        <i class="bx bx-list-ol"></i> <span data-key="t-landing">Hospitals</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('users.list')}}">
                        <i class="bx bx-user"></i> <span data-key="t-landing">Users</span>
                    </a>
                </li>

                @endif
                @if (Auth::user()->hasRole(1))
                <li class="menu-title"><span data-key="t-menu">Reports</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarMaps" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarMaps">
                        <i class="las la-envelope"></i> <span data-key="t-maps">General Report</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarMaps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('hospital.report')}}" class="nav-link" data-key="t-google">
                                    Hospital
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('client.report')}}" class="nav-link" data-key="t-vector">
                                    Client
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('reminders.report')}}" class="nav-link" data-key="t-leaflet">
                                    Reminders
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.report')}}" class="nav-link" data-key="t-leaflet">
                                    Staff
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                @endif



            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
