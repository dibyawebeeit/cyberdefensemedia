<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="{{ route('dashboard.index') }}" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{ asset('uploads/siteImage/' . sitesetting()->logo) }}" alt="logo" style="height: 50px;">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('uploads/siteImage/' . sitesetting()->favicon) }}" alt="small logo" style="background-color: #fff;">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="{{ route('dashboard.index') }}" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('uploads/siteImage/' . sitesetting()->logo) }}" alt="dark logo" style="height: 50px;">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('uploads/siteImage/' . sitesetting()->favicon) }}" alt="small logo" style="background-color: #fff;">
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </div>

    <!-- Full Sidebar Menu Close Button -->
    <div class="button-close-fullsidebar">
        <i class="ri-close-fill align-middle"></i>
    </div>

    <!-- Sidebar -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!-- Leftbar User -->
        <div class="leftbar-user">
            <a href="pages-profile.html">
                <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user-image" height="42"
                    class="rounded-circle shadow-sm">
                <span class="leftbar-user-name mt-2">Dominic Keller</span>
            </a>
        </div>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title">Navigation</li>

            <li class="side-nav-item">
                <a href="{{ route('dashboard.index') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    {{-- <span class="badge bg-success float-end">5</span> --}}
                    <span> Dashboard </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarSettings" aria-expanded="false"
                    aria-controls="sidebarSettings" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span> Settings </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarSettings">
                    <ul class="side-nav-second-level">

                        @can('setting')
                            <li><a href="{{ route('setting.index') }}">Site Setting</a></li>
                        @endcan

                        {{-- @can('role')
                            <li><a href="{{ route('role.index') }}">Roles</a></li>
                        @endcan

                        @can('permission')
                            <li><a href="{{ route('permission.index') }}">Permissions</a></li>
                        @endcan --}}

                    </ul>
                </div>
            </li>

            <li class="side-nav-title">Component</li>



            {{-- <li class="side-nav-item">
                <a href="{{route('faq.index')}}" class="side-nav-link">
                    <i class="uil uil-tachometer-fast"></i>
                    <span style="display: none" class="badge bg-danger text-white float-end">New</span>
                    <span> FAQ </span>
                </a>
            </li> --}}
            <li class="side-nav-item">
                <a href="{{route('defaultimage.index')}}" class="side-nav-link">
                    <i class="uil uil-tachometer-fast"></i>
                    <span> Default Image </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{route('feed.index')}}" class="side-nav-link">
                    <i class="uil uil-tachometer-fast"></i>
                    <span> Feed </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{route('contact.index')}}" class="side-nav-link">
                    <i class="uil uil-tachometer-fast"></i>
                    {{-- <span class="badge bg-danger text-white float-end">New</span> --}}
                    <span> Contact </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{route('newsletter.index')}}" class="side-nav-link">
                    <i class="uil uil-tachometer-fast"></i>
                    {{-- <span class="badge bg-danger text-white float-end">New</span> --}}
                    <span> Newsletter </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#cmsSection" aria-expanded="false"
                    aria-controls="cmsSection" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span> CMS </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="cmsSection">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('cms.home') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('cms.about_us') }}">About Us</a>
                        </li>
                    </ul>
                </div>
            </li>
            

            {{-- <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false"
                    aria-controls="sidebarEcommerce" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span> Ecommerce </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEcommerce">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="apps-ecommerce-products.html">Products</a>
                        </li>
                        <li>
                            <a href="apps-ecommerce-products-details.html">Products Details</a>
                        </li>
                        <li>
                            <a href="apps-ecommerce-orders.html">Orders</a>
                        </li>
                        <li>
                            <a href="apps-ecommerce-orders-details.html">Order Details</a>
                        </li>
                        <li>
                            <a href="apps-ecommerce-customers.html">Customers</a>
                        </li>
                        <li>
                            <a href="apps-ecommerce-shopping-cart.html">Shopping Cart</a>
                        </li>
                        <li>
                            <a href="apps-ecommerce-checkout.html">Checkout</a>
                        </li>
                        <li>
                            <a href="apps-ecommerce-sellers.html">Sellers</a>
                        </li>
                    </ul>
                </div>
            </li> --}}

        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->
