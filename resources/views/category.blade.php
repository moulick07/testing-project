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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ URL::asset('admin.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('category.css') }}" rel="stylesheet" type="text/css" />

    <title>Admin  Panel</title>
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
       
        <div class="form-body">
            <div class="row">
                <div class="form-holder">
                    <div class="form-content">
                        <div class="form-items">
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
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                            <h3>Add Category</h3>
                            <p>Fill in the data below.</p>
                            <form class="requires-validation" action="{{ route('save-category') }}" novalidate>
    
                                <div class="col-md-12">
                                   <input class="form-control" type="text" name="title" placeholder="Enter Category Title" required>
                                   <div class="valid-feedback">Title is Valid</div>
                                   <div class="invalid-feedback">title field cannot be blank!</div>
                                </div>
    
                                <div class="col-md-12">
                                    <input class="form-control" type="text" name="Description" placeholder="enter description of the category" required>
                                     <div class="valid-feedback">Description field is valid!</div>
                                     <div class="invalid-feedback">Description field cannot be blank!</div>
                                </div>
    
                                <div class="col-md-12">
                                    parent category
                               </div>
                               <div class="form-check form-control-inline">
                                <input class="form-check-input" type="radio" name="is_parent" id="inlineRadio1" value="1">
                                <label class="form-check-label" for="inlineRadio1">yes</label>
                              </div>
                              <div class="form-check form-control-inline">
                                <input class="form-check-input" type="radio" name="is_parent" id="inlineRadio2" value="0">
                                <label class="form-check-label" for="inlineRadio2">no</label>
                              </div>
                              
                              <div class="form-group col-md-12">
                                <label for="parent-cat"  >Select parent Category</label>
                                <select id="parent-cat" name="parent-cat" class="form-control">
                                  <option selected>Choose...</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                </select>
                              </div>
    
                                <div class="form-button mt-3">
                                    <button id="submit" type="submit" class="btn btn-primary">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </section>

    <script src="script.js"></script>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="{{ URL::asset('admin.js') }}"></script>
<script src="{{ URL::asset('category.js') }}"></script>
</html>