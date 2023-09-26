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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">

    <link href="{{ URL::asset('admin.css') }}" rel="stylesheet" type="text/css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <title>Admin Panel</title>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                {{-- <img src="images/logo.png" alt=""> --}}
            </div>

            <a><span class="category-detail">Category Detail</span></a>
            <span class="category-detail"></span>
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
                    <a href=""></a> <span class="text">Category detail</span>

                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="" class="btn ">Category Detail</a>

                        {{-- <a href="{{ url('addVariation/'.$detailcategory[0]->id) }}" class="btn ">Add Variation</a> --}}
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Add Variation
                        </button>

                 
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Variation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ url('variation-added/' . $detailcategory[0]->id) }}"
                                        method="GET">
                                        {{ csrf_field() }}
                                        <div class="modal-body gap-4">
                                            <div class="form-group row mb-3">
                                                <label for="title" class="col-sm-4 col-form-label">Title</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="title" name="title"
                                                        class="form-control" placeholder="Enter title" required>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label for="value" class="col-sm-4 col-form-label">Value</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="value" name="value"
                                                        class="form-control" placeholder="Enter value" required>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label for="type" class="col-sm-4 col-form-label">Type</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="type" name="type"
                                                        class="form-control" placeholder="Enter Type">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label for="prefix" class="col-sm-4 col-form-label">Prefix</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="prefix" name="prefix"
                                                        class="form-control" placeholder="Enter prefix">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label for="postfix" class="col-sm-4 col-form-label">Postfix</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="postfix" name="postfix"
                                                        class="form-control" placeholder="Enter Postfix">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label class="col-sm-4 col-form-label">Countable:</label>
                                                <div class="col-sm-8">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="countable" id="countableYes" value="1">
                                                        <label class="form-check-label" for="countableYes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="countable" id="countableNo" value="0">
                                                        <label class="form-check-label" for="countableNo">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- Modal end here --}}

                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="datatable"
                                    class="table table-bordered dt-responsive w-100 dataTable no-footer dtr-inline data-table">
                                    <thead>
                                        <tr>
                                            <th class="align-middle">title</th>
                                            <th class="align-middle">Description</th>
                                            <th class="align-middle">is_parent</th>
                                            <th class="align-middle">Parent_category</th>
                                            <th class="align-middle">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detailcategory as $detailcategory)
                                            <tr>
                                                <td>{{ $detailcategory->title }}</td>
                                                <td>{{ $detailcategory->description }}</td>
                                                <td>{{ $detailcategory->is_parent }}</td>
                                                <td>{{ $detailcategory->parent_category }}</td>
                                                <td><button type="button" class="btn " data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal1">
                                                        <i class="fa fa-edit" style="font-size:24px"></i>
                                                    </button></a>

                                                    <button type="button" class="btn " data-bs-toggle="modal"
                                                        data-bs-target="#deletemodal">
                                                        <i class="fa fa-trash" aria-hidden="true"></i></i>
                                                    </button>
                                                </td>
                                        @endforeach


                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- edit modal --}}
            <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('updateCategory/' . $detailcategory->id) }}" method="POST">
                            {{ csrf_field() }}
                            <div class="modal-body gap-4">
                                <div class="form-group row mb-3">
                                    <label for="title" class="col-sm-4 col-form-label">Title</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="title" name="title" class="form-control"
                                            value="{{ $detailcategory->title }}"
                                            placeholder="{{ $detailcategory->title }}" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="description" class="col-sm-4 col-form-label">Description</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="value" name="description" class="form-control"
                                            value="{{ $detailcategory->description }}" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="parent_category" class="col-sm-4 col-form-label">Parent
                                        Category</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="postfix" name="parent_category"
                                            class="form-control" value="{{ $detailcategory->parent_category }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-sm-4 col-form-label">is parent:</label>
                                    <div class="col-sm-8">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_parent"
                                                id="countableYes" value='1'
                                                {{ $detailcategory->is_parent == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="countableYes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_parent"
                                                id="countableNo" value='0'
                                                {{ $detailcategory->is_parent == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="countableNo">No</label>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- end edit modal --}}

            {{-- delete modal --}}
            {{-- !-- Delete Warning Modal -->  --}}
            <div class="modal fade" id="deletemodal">
                <div class="modal-dialog">
                    <form action="{{ url('deleteCategory/'.$detailcategory->id) }}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" id="close-modal">No</button>
                                <button type="submit" class="btn btn-danger">Yes</button>

                            </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- end edit modal  --}}
        </div>
    </section>

    {{-- <script src="script.js"></script> --}}
</body>
<script src="{{ URL::asset('admin.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
<script></script>

</html>
