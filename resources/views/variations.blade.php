<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!----======== CSS ======== -->
    {{-- <link rel="stylesheet" href="style.css"> --}}

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="{{ URL::asset('admin.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ URL::asset('category.css') }}" rel="stylesheet" type="text/css" /> --}}

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" />
    <title>Admin Panel</title>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="images/logo.png" alt="">
            </div>

            <span class="logo_name">Variations</span>
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
        <div class="top col-3">
            <i class="uil uil-bars sidebar-toggle"></i>
        </div>
        
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <div class="topnav">
                       <h5><a>Category Listing</a> 
               

                    </div>
                    
                </div>
              
                

                
                <div class="container-fluid px-1 py-5 mx-auto">
                    <div class="row d-flex justify-content-center">
                        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                            <div class="d-flex justify-content-end">
    
                                <a href="{{ route('category') }}" >
                                    <button type="button" class="btn btn-outline-danger">Add Data</button>
                                </a>
                            </div>
                            
                            <table class="table table-bordered data-table" id="empTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Parent Category</th>
                                        <th width="105px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>


                <!--edit category model-->

                <!-- Modal -->
                <div id="updateModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Update Category</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="title">Categroy Title</label>
                                    <input type="text" class="form-control" id="title"
                                        placeholder="Enter Category title" required>
                                </div>
                                <div class="form-group">
                                    <label for="Description">Description</label>
                                    <input type="Description" class="form-control" id="description"
                                        placeholder="Enter Description">
                                </div>
                                <div class="form-group">
                                    <label for="parent-cat">parent-cat</label>
                                    <select id='gender' class="form-control">
                                        <option value="0">Main Category</option>
                                        @foreach ($categories as $parentCategory)
                                            <option value="{{ $parentCategory->id }}">
                                                {{ $parentCategory->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 form-group custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" name="is_parent" value="1"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="1">yes</label>


                                    <input type="radio" id="customRadioInline2" name="is_parent" value="0"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="0">no</label>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="txt_empid" value="0">
                                <button type="button" class="btn btn-success btn-sm" id="btn_save">Save</button>
                                <button type="button" class="btn btn-default btn-sm"
                                    data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
                
                <!-- end edit category model -->

            </div>
        </div>
    </section>

    {{-- <script src="script.js"></script> --}}

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="{{ URL::asset('admin.js') }}"></script>

<script>
    $(function() {

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('getData') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'parent_category',
                    name: 'parent_category'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

    });
</script>
<script>
    // Update record
    $('#empTable').on('click', '.updateUser', function() {
        var id = $(this).data('id');

        $('#txt_empid').val(id);

        // AJAX request
        $.ajax({
            url: "{{ route('getCategorydata') }}",
            type: 'get',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {

                if (response.success == 1) {

                    $('#title').val(response.title);
                    $('#Description').val(response.Description);
                    $('#parent-cat').val(response.parent - cat);
                    $('#is_parent').val(response.is_parent);

                    empTable.ajax.reload();
                } else {
                    alert("Invalid ID.");
                }
            }
        });

    });

    // Save user 
    $('#btn_save').click(function() {
        var id = $('#txt_empid').val();

        var title = $('#title').val().trim();
        var Description = $('#Description').val();
        var parentcat = $('#parent-cat').val();
        var is_parent = $('#is_parent').val();

        if (title != '' && Description != '' && is_parent != '') {

            // AJAX request
            $.ajax({
                url: "{{ route('updateCategory') }}",
                type: 'post',
                data: {
                    id: id,
                    title: title,
                    Description: Description,
                    parentcat: parentcat,
                    is_parent: is_parent
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success == 1) {
                        alert(response.msg);

                        // Empty and reset the values
                        $('#title', '#Description', '#parent-cat').val('');
                        $('#is_parent').val(1);
                        $('#txt_empid').val(0);

                        // Reload DataTable
                        empTable.ajax.reload();

                        // Close modal
                        $('#updateModal').modal('toggle');
                    } else {
                        alert(response.msg);
                    }
                }
            });

        } else {
            alert('Please fill all fields.');
        }
    });

    // Delete record
    $('#empTable').on('click', '.deleteUser', function() {
        var id = $(this).data('id');

        var deleteConfirm = confirm("Are you sure?");
        if (deleteConfirm == true) {
            // AJAX request
            $.ajax({
                url: "{{ route('deleteCategory') }}",
                type: 'post',
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.success == 1) {
                        alert("Record deleted.");

                        // Reload DataTable

                    } else {
                        alert("Invalid ID.");
                    }
                }
            });
        }

    });
</script>

</html>
