<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="style.css">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ URL::asset('admin.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('category.css') }}" rel="stylesheet" type="text/css" />

    <title>Admin Panel</title>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="images/logo.png" alt="">
            </div>

            <span class="logo_name">CodingLab</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="{{ route('admin.home') }}">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dahsboard</span>
                    </a></li>
                <li><a href="">
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

    <section class="dashboard">

        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <!--<img src="images/profile.jpg" alt="">-->
        </div>
        
      

        <div class="container-fluid px-1 py-5 mx-auto">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                    <div class="topnav">
                        <a href="{{ route('category') }}">Add Category</a> /
                        <a href="{{ route('variation') }}">Add Variations</a>
                        
                      </div>    
                    <h3>Add Category</h3>

                    <div class="card">

                        <form class="form-card" action="{{ route('save-category') }}">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if ($message = Session::get('success'))
                                <div class="alert alert-success ">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            <div class="row justify-content-between text-left">
                                <div class="form-group col-sm-6 flex-column d-flex"> <label
                                        class="form-control-label px-3">Category title<span class="text-danger">
                                            *</span></label> <input type="text" id="fname" name="title"
                                        placeholder="Enter category title" onblur="validate(1)"> </div>
                                <div class="form-group col-sm-6 flex-column d-flex"> <label
                                        class="form-control-label px-3">description<span class="text-danger">
                                            *</span></label> <input type="text" id="lname" name="Description"
                                        placeholder="Enter description" onblur="validate(2)"> </div>
                            </div>
                            <div class="row justify-content-between text-left">
                                <div class="form-group col-sm-6 flex-column d-flex">
                                    <label class="form-control-label px-3"> is parent<span class="text-danger">
                                            *</span></label>
                                </div>
                                <div class="col-sm-6 custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" name="is_parent" value="1"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="1">yes</label>


                                    <input type="radio" id="customRadioInline2" name="is_parent" value="0"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="0">no</label>
                                </div>
                            </div>

                            <div class="row justify-content-between text-left">
                                <div class="form-group col-12 flex-column d-flex"> <label
                                        class="form-control-label px-3">parent category<span class="text-danger">
                                            *</span></label>
                                    <select class="form-select  search-dropdown" name="parent-cat"
                                        class="form-control">
                                        <option value="0">Main Category</option>
                                        @foreach ($categories as $parentCategory)
                                            <option value="{{ $parentCategory->id }}">
                                                {{ $parentCategory->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group col-sm-6"> <button type="submit"
                                        class="btn-block btn-primary">Add Category</button> </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>

</body>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="{{ URL::asset('admin.js') }}"></script>
<script src="{{ URL::asset('category.js') }}"></script>
</html>