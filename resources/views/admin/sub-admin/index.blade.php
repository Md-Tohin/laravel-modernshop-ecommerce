@extends('layouts.admin_layout')
@section('title') Mordern Shop || Sub Admin @endsection
@section('sub-admin') active @endsection

@section('admin-content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Sub Admin</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Sub Admin</a></li>
                    <li class="breadcrumb-item active">View</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- add sub-admin Modal -->
<div class="modal fade" id="add_sub_admin_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Sub Admin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" id="add_sub_admin_form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Select Role Type <span class="text-danger">*</span></label>
                        <select class="form-control select2" name="role_id" style="width: 100%;">
                            <option value="" selected="selected">Choose One</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sub Admin Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Enter sub admin name">
                    </div>
                    <div class="form-group">
                        <label>Email Address <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email address">
                    </div>
                    <div class="form-group">
                        <label>Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" name="confirm_password" class="form-control"
                            placeholder="Enter Re-type password">
                    </div>                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="add_sub_admin_button" class="btn btn-primary">Save SubAdmin</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- add sub-admin Modal -->

<!-- edit sub-admin Modal -->
<div class="modal fade" id="edit_sub_admin_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Sub Admin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" id="update_role_form">
                @csrf
                <input type="hidden" name="sub_admin_id" id="sub_admin_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Select Role Type <span class="text-danger">*</span></label>
                        <select class="form-control select2" name="role_id" id="role_id" style="width: 100%;">
                            <option value="" selected="selected">Choose One</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sub Admin Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter sub admin name">
                    </div>
                    <div class="form-group">
                        <label>Email Address <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter email address">
                    </div>
                    <div class="form-group">
                        <label>Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" name="confirm_password" class="form-control"
                            placeholder="Enter Re-type password">
                    </div>                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="update_role_button" class="btn btn-primary">Update SubAdmin</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- edit sub-admin Modal -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i>
                            All Sub Admins
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                @isset(auth()->user()->role->permission['permission']['subadmin']['add'])
                                <li class="nav-item">
                                    <button type="button" class="btn btn-sm btn-success text-light text-md"
                                        data-toggle="modal" data-target="#add_sub_admin_modal"><i
                                            class="fa-solid fa-circle-plus mr-2"></i> Add SubAdmin </button>
                                </li>
                                @endisset
                            </ul>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table sub_admin_table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sub_admins as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        <span class="badge rounded-pill bg-success">{{ $item->role->name }}</span>
                                    </td>
                                    <td>
                                        @isset(auth()->user()->role->permission['permission']['subadmin']['edit'])
                                        <a href="{{ route('sub-admin.edit', $item->id) }}"
                                            class="editButton btn btn-success btn-sm" data-toggle="modal"
                                            data-target="#edit_sub_admin_modal" title="Edit"><i
                                                class="fa-solid fa-pen-to-square"></i></a>
                                        @endisset
                                        @isset(auth()->user()->role->permission['permission']['subadmin']['delete'])
                                        <a href="{{ route('sub-admin.destroy', $item->id) }}"
                                            class="btn btn-danger btn-sm confirmDelete" title="Delete"><i
                                                class="fa-solid fa-trash"></i></a>
                                        @endisset
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role Type</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.card -->
            </section>
            <!-- /.Left col -->

        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('custom-scripts')
<script>
    $(document).ready(function(){
        //  add 
        $('#add_sub_admin_form').on('submit', function(e){
            e.preventDefault();
            $('#add_sub_admin_button').text('Adding...');
            const fd = new FormData(this);
            $.ajax({
                url: "{{ route('sub-admin.store') }}",
                method: "POST",
                data: fd,
                catch: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(res){
                    if (res.status == 200) {
                        $('#add_sub_admin_form')[0].reset();
                        $('#add_sub_admin_button').text('Save SubAdmin');
                        $('#add_sub_admin_modal').modal('hide');
                        $('.sub_admin_table').load(location.href+' .sub_admin_table');
                        toastr.success('SubAdmin inserted successfully!');
                    }
                },
                error: function(err){
                    console.log(err);
                    $('#add_sub_admin_button').text('Save SubAdmin');
                    toastr.error('Something went wrong!');
                }
            });
        });

        //  edit 
        $(document).on('click', '.editButton', function(e){
            e.preventDefault();
            const href = $(this).attr('href');
            $.ajax({
                url: href,
                method: 'GET',
                success: function(res){                    
                    let RoleHTML = $('#role_id').html('<option value="" selected="selected">Choose One</option>');
                    $.each(res.roles, function(key, value){
                        if (value.id == res.user.role_id) {
                            RoleHTML += `<option value="${value.id}" selected="selected">${value.name}</option>`
                        } else {
                            RoleHTML += `<option value="${value.id}" >${value.name}</option>`
                        }
                    });
                    $('#name').val(res.user.name);
                    $('#email').val(res.user.email);
                    $('#sub_admin_id').val(res.user.id);
                    $('#role_id').html(RoleHTML);
                    
                },
                error: function(err){
                    console.log(err);
                    toastr.error('Something went wrong!');
                }
            });
        });

        //  update 
        $('#update_role_form').on('submit', function(e){
            e.preventDefault();
            $('#update_role_button').text('updating...');
            const fd = new FormData(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('sub-admin.edit-update') }}",
                method: "POST",
                data: fd,
                catch: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(res){                        
                    if (res.status == 200) {
                        $('#update_role_form')[0].reset();
                        $('#update_role_button').text('Update SubAdmin');
                        $('#edit_sub_admin_modal').modal('hide');
                        $('.sub_admin_table').load(location.href+' .sub_admin_table');
                        toastr.success('Role updated successfully!');
                    }
                },
                error: function(err){
                    console.log(err);
                    $('#update_role_button').text('Update SubAdmin');
                    toastr.error('Something went wrong!');
                }
            });
        });            
    });
</script>
@endsection