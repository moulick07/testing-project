<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    {{-- <link rel="stylesheet" href="style.css"> --}}
    <style>
        body {
            background-color: #05c46b;
            font-family: Verdana;
            text-align: center;
        }

        /* Styling the Form (Color, Padding, Shadow) */
        form {
            background-color: #fff;
            max-width: 500px;
            margin: 50px auto;
            padding: 30px 20px;
            box-shadow: 2px 5px 10px rgba(0, 0, 0, 0.5);
        }

        /* Styling form-control Class */
        .form-control {
            text-align: left;
            margin-bottom: 25px;
        }

        /* Styling form-control Label */
        .form-control label {
            display: block;
            margin-bottom: 10px;
        }

        /* Styling form-control input,
  select, textarea */
        .form-control input,
        .form-control select,
        .form-control textarea {
            border: 1px solid #777;
            border-radius: 2px;
            font-family: inherit;
            padding: 10px;
            display: block;
            width: 95%;
        }

        /* Styling form-control Radio
  button and Checkbox */
        .form-control input[type="radio"],
        .form-control input[type="checkbox"] {
            display: inline-block;
            width: auto;
        }

        /* Styling Button */
        button {
            background-color: #05c46b;
            border: 1px solid #777;
            border-radius: 2px;
            font-family: inherit;
            font-size: 21px;
            display: block;
            width: 100%;
            margin-top: 50px;
            margin-bottom: 20px;
        }
    </style>
    <!----===== Iconscout CSS ===== -->
    <!------ Include the above in your HEAD tag ---------->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="{{ URL::asset('admin.css') }}" rel="stylesheet" type="text/css" />
    <title>Admin Panel</title>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                {{-- <img src="images/logo.png" alt=""> --}}
            </div>

            <span class="logo_name">Variations</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="#">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dahsboard</span>
                    </a></li>
                <li><a href="">
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

                

                {{-- <form id="form" action="{{ url('variation-added/'.$category->id) }}">
                    <h2>Add Variations </h2>


                    <!-- Details -->
                    <div class="form-control">
                        <label for="title" id="label-name">
                            Title
                        </label>

                        <!-- Input Type Text -->
                        <input type="text" id="name" name="title" placeholder="Enter Category Title" />
                    </div>
                    <div class="form-control">
                        <label for="type" id="label-name">
                            Type
                        </label>

                        <!-- Input Type Text -->
                        <input type="text" id="name" name="type" placeholder="types of variation " />
                    </div>

                    <div class="form-control">
                        <span>Prefix :</span>
                        <input type="text" id="name" name="prefix" placeholder="Enter prefix for the variations" />

                    </div>

                    <div class="form-control">
                        <span>Postfix :</span>
                        <input type="text" id="name" name="postfix" placeholder="Enter postfix for the variations " />

                    </div>
                    <div class="form-control d-flex">
                        <span>countable :</span>
                        <label class="radio-inline">
                            <input type="radio" name="countable" value="1">yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="countable" value="0">No
                        </label>
                    </div>
                    <div class="form-control">
                        <span>Value :</span>
                        <input type="text" id="name" name="value" placeholder="Enter types " />

                    </div>

                    
                   
                    
                    <button type="submit" value="submit">
                        Save
                    </button>
                 
                </form> --}}
                    
            </div>
        </div>
    </section>

    {{-- <script src="script.js"></script> --}}
</body>
<script src="{{ URL::asset('admin.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
</html>
