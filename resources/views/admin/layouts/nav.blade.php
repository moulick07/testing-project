<nav>
    <div class="logo-name">
        <div class="logo-image">
           {{-- <img src="images/logo.png" alt=""> --}}
        </div>

        <span class="logo_name">CodingLab</span>
    </div>

    <div class="menu-items">
        <ul class="nav-links">
            <li><a href="{{ route('admin.home') }}">
                <i class="uil uil-estate"></i>
                <span class="link-name">Dahsboard</span>
            </a></li>
            <li><a href="{{ route('productList') }}">
                <i class="uil uil-files-landscapes"></i>
                <span class="link-name">Product</span>
            </a></li>
            <li><a href="{{ route('category') }}">
                <i class="uil uil-chart"></i>
                <span class="link-name">Category</span>
            </a></li>
           
        </ul>
        
        <ul class="logout-mode">
            <li><a href="{{ route('logout') }}">
                <i class="uil uil-signout"></i>
                <span class="link-name">Logout</span>
            </a></li>

            <li class="mode">
                <a href="#">
                    <i class="uil uil-moon"></i>
                <span class="link-name">Dark Mode</span>
            </a>

            <div class="mode-toggle">
              <span class="switch"></span>
            </div>
        </li>
        </ul>
    </div>
</nav>
