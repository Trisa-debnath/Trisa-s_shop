<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin & Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, admin, dashboard, template">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('admin_asset/img/icons/logo.png')}}" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

    <title>@yield('admin_page_title')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <link href="{{ asset('admin_asset/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin') }}">
    <img src="{{ asset('admin_asset/img/icons/logo.png') }}" style="height:30px;" class="me-2">
    <span class="fw-bold">Admin Panel</span>
</a>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">Main</li>
                    <li class="sidebar-item {{ request()->routeIs('admin') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin') }}">
                            <i class="align-middle" data-feather="sliders"></i>
                            <span class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-header">Category</li>
                    <li class="sidebar-item {{ request()->routeIs('category.create') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('category.create') }}">
                            <i class="align-middle" data-feather="plus"></i>
                            <span class="align-middle">Create</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('category.manage') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('category.manage') }}">
                            <i class="align-middle" data-feather="list"></i>
                            <span class="align-middle">Manage</span>
                        </a>
                    </li>

                    <li class="sidebar-header">Sub Category</li>
                    <li class="sidebar-item {{ request()->routeIs('subcategory.create') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('subcategory.create') }}">
                            <i class="align-middle" data-feather="plus"></i>
                            <span class="align-middle">Subcategory Create</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('subcategory.manage') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('subcategory.manage') }}">
                            <i class="align-middle" data-feather="list"></i>
                            <span class="align-middle">Subcategory Manage</span>
                        </a>
                    </li>

                    <li class="sidebar-header">Product</li>
                    <li class="sidebar-item {{ request()->routeIs('product.manage') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('product.manage') }}">
                            <i class="align-middle" data-feather="shopping-bag"></i>
                            <span class="align-middle">Product Manage</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('product.manageproductreview') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('product.manageproductreview') }}">
                            <i class="align-middle" data-feather="star"></i>
                            <span class="align-middle">Manage Product Review</span>
                        </a>
                    </li>

                    <li class="sidebar-header">History</li>
                    <li class="sidebar-item {{ request()->routeIs('admin.cart.history') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.cart.history') }}">
                            <i class="align-middle" data-feather="shopping-cart"></i>
                            <span class="align-middle">Cart History</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('admin.order.history') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.order.history') }}">
                            <i class="align-middle" data-feather="list"></i>
                            <span class="align-middle">Order History</span>
                        </a>
                    </li>

                    <li class="sidebar-header">Product Attribute</li>
                    <li class="sidebar-item {{ request()->routeIs('productattribute.create') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('productattribute.create') }}">
                            <i class="align-middle" data-feather="plus"></i>
                            <span class="align-middle">Product Attribute Create</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('productattribute.manage') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('productattribute.manage') }}">
                            <i class="align-middle" data-feather="list"></i>
                            <span class="align-middle">Product Attribute Manage</span>
                        </a>
                    </li>

                    <li class="sidebar-header">Discount</li>
                    <li class="sidebar-item {{ request()->routeIs('discount.create') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('discount.create') }}">
                            <i class="align-middle" data-feather="plus"></i>
                            <span class="align-middle">Discount Create</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('discount.manage') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('discount.manage') }}">
                            <i class="align-middle" data-feather="list"></i>
                            <span class="align-middle">Discount Manage</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.seeting') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.seeting') }}">
                            <i class="align-middle" data-feather="settings"></i>
                            <span class="align-middle">Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main -->
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle"><i class="hamburger align-self-center"></i></a>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav ms-auto">
                        @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
 <img src="{{ asset('admin_asset/img/icons/logo.png') }}" class="avatar img-fluid rounded me-1" alt="{{ auth()->user()->name }}" />
                                <span class="text-dark">{{ auth()->user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger" type="submit">
                                        <i class="align-middle me-1" data-feather="log-out"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                        @endauth
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        @endguest
                    </ul>
                </div>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">
                    @yield('admin_layout')
                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted" href="#" target="_blank">  © {{ date('Y') }} <strong>Trisha's Shop</strong></a> - Trish's Shop Admin site
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item"><a class="text-muted" href="#">Support</a></li>
                                <li class="list-inline-item"><a class="text-muted" href="#">Help Center</a></li>
                                <li class="list-inline-item"><a class="text-muted" href="#">Privacy</a></li>
                                <li class="list-inline-item"><a class="text-muted" href="#">Terms</a></li>
                            </ul>
                             Developed by <strong>Trisa</strong>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('admin_asset/js/app.js') }}"></script>
</body>

</html>
