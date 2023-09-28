<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    {{-- <link rel="stylesheet" href="style.css"> --}}
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="{{ URL::asset('admin.css') }}" rel="stylesheet" type="text/css" />

    <title>Admin  Panel</title>
</head>
<body>
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
                <li><a href="{{ route('getData') }}">
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

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>
            
            <!--<img src="images/profile.jpg" alt="">-->
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <i class="uil uil-thumbs-up"></i>
                        <span class="text">Total Products</span>
                        <span class="number">0</span>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-comments"></i>
                        <span class="text">Category</span>
                        <span class="number">0</span>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-share"></i>
                        <span class="text">Total Share</span>
                        <span class="number">10,120</span>
                    </div>
                </div>
            </div>

          
        </div>
    </section>

    {{-- <script src="script.js"></script> --}}
</body>
<script src="{{ URL::asset('admin.js') }}"></script>
</html>