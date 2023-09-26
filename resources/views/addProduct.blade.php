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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

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


                <div class="container-xxl flex-grow-1 container-p-y">



                    <h4 class="py-3 mb-4">
                        <span class="text-muted fw-light">eCommerce /</span><span> Add Product</span>
                    </h4>

                    <div class="app-ecommerce">

                        <!-- Add Product -->
                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">

                            <div class="d-flex flex-column justify-content-center">
                                <h4 class="mb-1 mt-3">Add a new Product</h4>
                                <p>Orders placed across your store</p>
                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-3">
                               
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save
                                    product</button>
                            </div>
                        </div>

                        <div class="row">

                            <!-- First column-->
                            <div class="col-12 col-lg-8">
                                <!-- Product Information -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="card-tile mb-0">Product information</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-floating form-floating-outline mb-4">
                                            <input type="text" class="form-control" id="ecommerce-product-name"
                                                placeholder="Product title" name="productTitle"
                                                aria-label="Product title">
                                            <label for="ecommerce-product-name">Name</label>
                                        </div>


                                        <div class="row mb-3">
                                            <div class="col">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="number" class="form-control"
                                                        id="ecommerce-product-sku" placeholder="00000" name="productSku"
                                                        aria-label="Product SKU">
                                                    <label for="ecommerce-product-sku">In Stock</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control"
                                                        id="ecommerce-product-barcode" placeholder="0123-4567"
                                                        name="productBarcode" aria-label="Product barcode">
                                                    <label for="ecommerce-product-name">Short Description</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Comment -->
                                        <div class="col">
                                            <div class="form-floating form-floating-outline">
                                                <textarea type="text" class="form-control"
                                                    id="ecommerce-product-barcode" placeholder="0123-4567"
                                                    name="productBarcode" aria-label="Product barcode"></textarea>
                                                <label for="ecommerce-product-name">Long Description</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Product Information -->
                                <!-- Media -->
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0 card-title">Media</h5>
                                        <a href="#" class="fw-medium">Add media from URL</a>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <input type="file" id="imageInput" accept="image/*">
                                        </form>
                                    </div>
                                </div>
                                <!-- /Media -->
                                <!-- Variants -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Variants</h5>
                                    </div>
                                    <div class="card-body">
                                        <form class="w-px-500 p-3 p-md-3" action="#" method="post">
                                            @csrf
                                            <div class="row clone-row">
                                                <div class="col-md-5 mb-4">
                                                    <label class="form-label">Option</label>
                                                    <select class="form-control form-control-sm" name="Language[]">
                                                        <option value="AK">PHP</option>
                                                        <option value="HI">Laravel</option>
                                                        <option value="CA">Cake PHP</option>
                                                        <option value="NV">Symphony</option>
                                                        <option value="OR">YII</option>
                                                        <option value="VA">Zend</option>
                                                        <option value="WV">Phalcon</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-5 mb-4">
                                                    <label class="form-label">add Value</label>
                                                    <input type="text" name="value[]" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-md-1" style="margin-top:27px;">
                                                    <span class="btn btn-danger btn-xs pull-right btn-del-select py-0">Remove</span>
                                                </div>
                                            </div>
                                            <div class="col-md-2" style="margin-left: 5px;">
                                                <span class="btn btn-secondary btn-xs add-select py-0">Add More</span>
                                            </div>
                                            
                                            
                                        </form>
                                    </div>
                                </div>
                                <!-- /Variants -->

                            </div>
                            <!-- /Second column -->

                            <!-- Second column -->
                            <div class="col-12 col-lg-4">
                                <!-- Pricing Card -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Pricing</h5>
                                    </div>
                                    <div class="card-body">
                                        <!-- Base Price -->
                                        <div class="form-floating form-floating-outline mb-4">
                                            <input type="number" class="form-control" id="ecommerce-product-price"
                                                placeholder="Price" name="productPrice" aria-label="Product price">
                                            <label for="ecommerce-product-price">Best Price</label>
                                        </div>

                                        <!-- Discounted Price -->
                                        <div class="form-floating form-floating-outline mb-4">
                                            <input type="number" class="form-control"
                                                id="ecommerce-product-discount-price" placeholder="Discounted Price"
                                                name="productDiscountedPrice" aria-label="Product discounted price">
                                            <label for="ecommerce-product-discount-price">Discounted Price</label>
                                        </div>


                                    </div>
                                </div>

                                <!-- Organize Card -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Organize</h5>
                                    </div>
                                    <div class="card-body">
                                        <!-- Vendor -->
                                        <div class="mb-4 col ecommerce-select2-dropdown">
                                            <div class="form-floating form-floating-outline">
                                                <div class="position-relative">


                                                    <div class="form-floating form-floating-outline mb-4">
                                                        <input type="text" class="form-control"
                                                            id="ecommerce-product-discount-price"
                                                            placeholder="Discounted Price"
                                                            name="productDiscountedPrice"
                                                            aria-label="Product discounted price">
                                                        <label for="ecommerce-product-discount-price">Brand </label>
                                                    </div>
                                                    <!-- Collection -->
                                                    <select id="status-org"
                                                        class="select2 form-select select2-hidden-accessible"
                                                        data-placeholder="Select Status" data-select2-id="status-org"
                                                        tabindex="-1" aria-hidden="true">
                                                        <option value="" data-select2-id="12">Select Category
                                                        </option>
                                                        <option value="Published" data-select2-id="35">Published
                                                        </option>
                                                    </select>

                                                    <!-- Status -->

                                                    <!-- Tags -->
                                                    <label for="vendor"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Category -->

                                    </div>
                                </div>
                                <!-- /Organize Card -->
                            </div>
                            <!-- /Second column -->
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>

    {{-- <script src="script.js"></script> --}}
</body>
<script src="{{ URL::asset('admin.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    $('.btn-del-select').hide();
    $(document).on('click','.add-select', function(){
        $(this).parent().parent().find(".clone-row").clone().insertBefore($(this).parent()).removeClass("clone-row");
        $('.btn-del-select').fadeIn();
        $(this).parent().parent().find(".btn-del-select").click(function(e) {
            $(this).parent().parent().remove(); 
        });
    });
</script>
</html>
