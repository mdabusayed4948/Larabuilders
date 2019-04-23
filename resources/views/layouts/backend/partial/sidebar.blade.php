
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">

            <img src="{{ asset( 'public/images/profile/'.Auth::user()->image )}}" width="48" height="48" alt="User" />

        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}

            </div>
            <div class="email">{{ Auth::user()->email }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="{{ route('home') }}" target="_blank"><i class="material-icons">near_me</i>Go To Site</a>
                    </li>
                    <li>
                        <a href="{{ Auth::user()->role->id==1 ? route('admin.settings') : 'Access denide' }}"><i class="material-icons">settings</i>settings</a>
                    </li>
                    <li role="seperator" class="divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i>Sign Out
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            @if(Request::is('admin*'))
                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/banner*') ? 'active' : '' }}">
                    <a href="{{ route('admin.banner.index') }}">
                        <i class="material-icons">slideshow</i>
                        <span>Banner</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/brand*') ? 'active' : '' }}">
                    <a href="{{ route('admin.brand.index') }}">
                        <i class="material-icons">branding_watermark</i>
                        <span>Brand</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/client*') ? 'active' : '' }}">
                    <a href="{{ route('admin.client.index') }}">
                        <i class="material-icons">group</i>
                        <span>Client</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/news*') ? 'active' : '' }}">
                    <a href="{{ route('admin.news.index') }}">
                        <i class="material-icons">assignment_returned</i>
                        <span>News</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/management*') ? 'active' : '' }}">
                    <a href="{{ route('admin.management.index') }}">
                        <i class="material-icons">group_add</i>
                        <span>Management</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/product*') ? 'active' : '' }}">
                    <a href="{{ route('admin.product.index') }}">
                        <i class="material-icons">local_parking</i>
                        <span>Product</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/career*') ? 'active' : '' }}">
                    <a href="{{ route('admin.career.index') }}">
                        <i class="material-icons"> school</i>
                        <span>Career</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/photo*') ? 'active' : '' }} {{ Request::is('admin/media*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">perm_media</i>
                        <span>Medias</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ Request::is('admin/media*') ? 'active' : '' }}">
                            <a href="{{ route('admin.media.index') }}">Media Gallery</a>
                        </li>
                        <li class="{{ Request::is('admin/photo*') ? 'active' : '' }}">
                            <a href="{{ route('admin.photo.index') }}"> Photo</a>
                        </li>
                    </ul>
                </li>

                <li class="header">System</li>

                <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings') }}">
                        <i class="material-icons">settings</i>
                        <span>settings</span>
                    </a>
                </li>

                <li class="">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i> <span>Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endif

            @if(Request::is('author*'))
                <li class="{{ Request::is('author/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('author.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="">
                    <a href="">
                        <i class="material-icons">library_books</i>
                        <span>Posts</span>
                    </a>
                </li>

                <li class="">
                    <a href="">
                        <i class="material-icons">favorite</i>
                        <span>Favorite Posts</span>
                    </a>
                </li>

                <li class="">
                    <a href="">
                        <i class="material-icons">comment</i>
                        <span>Comments</span>
                    </a>
                </li>

                <li class="header">System</li>

                <li class="">
                    <a href="">
                        <i class="material-icons">settings</i>
                        <span>settings</span>
                    </a>
                </li>

                <li class="">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i> <span>Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endif



        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy;2001- {{ date("Y") }} <a href="https://www.technobd.com/" target="_blank">Technobd</a> - All Right Reserve.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.0
        </div>
    </div>
    <!-- #Footer -->
</aside>