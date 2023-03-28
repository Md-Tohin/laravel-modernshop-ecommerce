@extends('layouts.admin_layout')
@section('title') Mordern Shop || Permission @endsection
@section('permission') active @endsection

@section('admin-content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Permission</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Permission</a></li>
                    <li class="breadcrumb-item active">View</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- add sub-admin Modal -->
<div class="modal fade" id="add_permission_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Permission</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" id="add_permission_form">
                @csrf
                <div class="modal-body">
                    <div class="row px-2">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Select Role Type <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="role_id" style="width: 100%;">
                                    <option value="" selected="selected">Choose One</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <table class="table table-bordered table-secondary table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Permission</th>
                                        <th>List</th>
                                        <th>Add</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        <th>Status</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Brand</td>
                                        <td><input type="checkbox" name="permission[brand][list]" value="1"></td>
                                        <td><input type="checkbox" name="permission[brand][add]" value="1"></td>
                                        <td><input type="checkbox" name="permission[brand][edit]" value="1"></td>
                                        <td><input type="checkbox" name="permission[brand][delete]" value="1"></td>
                                        <td><input type="checkbox" name="permission[brand][status]" value="1"></td>
                                        <td><input type="checkbox" name="permission[brand][view]" value="1"></td>
                                    </tr>
                                    <tr>
                                        <td>Category</td>
                                        <td><input type="checkbox" name="permission[category][list]" value="1"></td>
                                        <td><input type="checkbox" name="permission[category][add]" value="1"></td>
                                        <td><input type="checkbox" name="permission[category][edit]" value="1"></td>
                                        <td><input type="checkbox" name="permission[category][delete]" value="1"></td>
                                        <td><input type="checkbox" name="permission[category][status]" value="1"></td>
                                        <td><input type="checkbox" name="permission[category][view]" value="1"></td>
                                    </tr>
                                    <tr>
                                        <td>Product</td>
                                        <td><input type="checkbox" name="permission[product][list]" value="1"></td>
                                        <td><input type="checkbox" name="permission[product][add]" value="1"></td>
                                        <td><input type="checkbox" name="permission[product][edit]" value="1"></td>
                                        <td><input type="checkbox" name="permission[product][delete]" value="1"></td>
                                        <td><input type="checkbox" name="permission[product][status]" value="1"></td>
                                        <td><input type="checkbox" name="permission[product][view]" value="1"></td>
                                    </tr>
                                    <tr>
                                        <td>Slider</td>
                                        <td><input type="checkbox" name="permission[slider][list]" value="1"></td>
                                        <td><input type="checkbox" name="permission[slider][add]" value="1"></td>
                                        <td><input type="checkbox" name="permission[slider][edit]" value="1"></td>
                                        <td><input type="checkbox" name="permission[slider][delete]" value="1"></td>
                                        <td><input type="checkbox" name="permission[slider][status]" value="1"></td>
                                        <td><input type="checkbox" name="permission[slider][view]" value="1"></td>
                                    </tr>
                                    <tr>
                                        <td>Role</td>
                                        <td><input type="checkbox" name="permission[role][list]" value="1"></td>
                                        <td><input type="checkbox" name="permission[role][add]" value="1"></td>
                                        <td><input type="checkbox" name="permission[role][edit]" value="1"></td>
                                        <td><input type="checkbox" name="permission[role][delete]" value="1"></td>
                                        <td><input type="checkbox" name="permission[role][status]" value="1"></td>
                                        <td><input type="checkbox" name="permission[role][view]" value="1"></td>
                                    </tr>
                                    <tr>
                                        <td>Sub Admin</td>
                                        <td><input type="checkbox" name="permission[subadmin][list]" value="1"></td>
                                        <td><input type="checkbox" name="permission[subadmin][add]" value="1"></td>
                                        <td><input type="checkbox" name="permission[subadmin][edit]" value="1"></td>
                                        <td><input type="checkbox" name="permission[subadmin][delete]" value="1"></td>
                                        <td><input type="checkbox" name="permission[subadmin][status]" value="1"></td>
                                        <td><input type="checkbox" name="permission[subadmin][view]" value="1"></td>
                                    </tr>
                                    <tr>
                                        <td>Permission</td>
                                        <td><input type="checkbox" name="permission[permission][list]" value="1"></td>
                                        <td><input type="checkbox" name="permission[permission][add]" value="1"></td>
                                        <td><input type="checkbox" name="permission[permission][edit]" value="1"></td>
                                        <td><input type="checkbox" name="permission[permission][delete]" value="1"></td>
                                        <td><input type="checkbox" name="permission[permission][status]" value="1"></td>
                                        <td><input type="checkbox" name="permission[permission][view]" value="1"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="add_permission_button" class="btn btn-primary">Save Permission</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- add sub-admin Modal -->

<!-- edit sub-admin Modal -->
<div class="modal fade" id="edit_permission_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Permission</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" id="update_permission_form">
                @csrf
                <input type="hidden" name="permission_id" id="permission_id">
                <div class="modal-body">
                    <div class="row px-2">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Select Role Type <span class="text-danger">*</span></label>
                                <select class="form-control select2" id="role_id" name="role_id" style="width: 100%;">
                                    <option value="" selected="selected">Choose One</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <table class="table table-bordered table-secondary table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Permission</th>
                                        <th>List</th>
                                        <th>Add</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        <th>Status</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Brand</td>
                                        <td><input type="checkbox" id="brand-list" name="permission[brand][list]" value="1"></td>
                                        <td><input type="checkbox" id="brand-add" name="permission[brand][add]" value="1"></td>
                                        <td><input type="checkbox" id="brand-edit" name="permission[brand][edit]" value="1"></td>
                                        <td><input type="checkbox" id="brand-delete" name="permission[brand][delete]" value="1"></td>
                                        <td><input type="checkbox" id="brand-status" name="permission[brand][status]" value="1"></td>
                                        <td><input type="checkbox" id="brand-view" name="permission[brand][view]" value="1"></td>
                                    </tr>
                                    <tr>
                                        <td>Category</td>
                                        <td><input type="checkbox" id="category-list" name="permission[category][list]" value="1"></td>
                                        <td><input type="checkbox" id="category-add" name="permission[category][add]" value="1"></td>
                                        <td><input type="checkbox" id="category-edit" name="permission[category][edit]" value="1"></td>
                                        <td><input type="checkbox" id="category-delete" name="permission[category][delete]" value="1"></td>
                                        <td><input type="checkbox" id="category-status" name="permission[category][status]" value="1"></td>
                                        <td><input type="checkbox" id="category-view" name="permission[category][view]" value="1"></td>
                                    </tr>
                                    <tr>
                                        <td>Product</td>
                                        <td><input type="checkbox" id="product-list" name="permission[product][list]" value="1"></td>
                                        <td><input type="checkbox" id="product-add" name="permission[product][add]" value="1"></td>
                                        <td><input type="checkbox" id="product-edit" name="permission[product][edit]" value="1"></td>
                                        <td><input type="checkbox" id="product-delete" name="permission[product][delete]" value="1"></td>
                                        <td><input type="checkbox" id="product-status" name="permission[product][status]" value="1"></td>
                                        <td><input type="checkbox" id="product-view" name="permission[product][view]" value="1"></td>
                                    </tr>
                                    <tr>
                                        <td>Slider</td>
                                        <td><input type="checkbox" id="slider-list" name="permission[slider][list]" value="1"></td>
                                        <td><input type="checkbox" id="slider-add" name="permission[slider][add]" value="1"></td>
                                        <td><input type="checkbox" id="slider-edit" name="permission[slider][edit]" value="1"></td>
                                        <td><input type="checkbox" id="slider-delete" name="permission[slider][delete]" value="1"></td>
                                        <td><input type="checkbox" id="slider-status" name="permission[slider][status]" value="1"></td>
                                        <td><input type="checkbox" id="slider-view" name="permission[slider][view]" value="1"></td>
                                    </tr>
                                    <tr>
                                        <td>Role</td>
                                        <td><input type="checkbox" id="role-list" name="permission[role][list]" value="1"></td>
                                        <td><input type="checkbox" id="role-add" name="permission[role][add]" value="1"></td>
                                        <td><input type="checkbox" id="role-edit" name="permission[role][edit]" value="1"></td>
                                        <td><input type="checkbox" id="role-delete" name="permission[role][delete]" value="1"></td>
                                        <td><input type="checkbox" id="role-status" name="permission[role][status]" value="1"></td>
                                        <td><input type="checkbox" id="role-view" name="permission[role][view]" value="1"></td>
                                    </tr>
                                    <tr>
                                        <td>Sub Admin</td>
                                        <td><input type="checkbox" id="subadmin-list" name="permission[subadmin][list]" value="1"></td>
                                        <td><input type="checkbox" id="subadmin-add" name="permission[subadmin][add]" value="1"></td>
                                        <td><input type="checkbox" id="subadmin-edit" name="permission[subadmin][edit]" value="1"></td>
                                        <td><input type="checkbox" id="subadmin-delete" name="permission[subadmin][delete]" value="1"></td>
                                        <td><input type="checkbox" id="subadmin-status" name="permission[subadmin][status]" value="1"></td>
                                        <td><input type="checkbox" id="subadmin-view" name="permission[subadmin][view]" value="1"></td>
                                    </tr>
                                    <tr>
                                        <td>Permission</td>
                                        <td><input type="checkbox" id="permission-list" name="permission[permission][list]" value="1"></td>
                                        <td><input type="checkbox" id="permission-add" name="permission[permission][add]" value="1"></td>
                                        <td><input type="checkbox" id="permission-edit" name="permission[permission][edit]" value="1"></td>
                                        <td><input type="checkbox" id="permission-delete" name="permission[permission][delete]" value="1"></td>
                                        <td><input type="checkbox" id="permission-status" name="permission[permission][status]" value="1"></td>
                                        <td><input type="checkbox" id="permission-view" name="permission[permission][view]" value="1"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="update_permission_button" class="btn btn-primary">Update Permission</button>
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
                            All Permissions
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                @isset(auth()->user()->role->permission['permission']['permission']['add'])
                                <li class="nav-item">
                                    <button type="button" class="btn btn-sm btn-success text-light text-md"
                                        data-toggle="modal" data-target="#add_permission_modal"><i
                                            class="fa-solid fa-circle-plus mr-2"></i> Add Permission </button>
                                </li>
                                @endisset
                            </ul>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table permission_table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Role Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $item->role->name }}
                                    </td>
                                    <td>
                                        @isset(auth()->user()->role->permission['permission']['permission']['edit'])
                                        <a href="{{ route('permission.edit', $item->id) }}"
                                            class="editButton btn btn-success btn-sm" data-toggle="modal"
                                            data-target="#edit_permission_modal" title="Edit"><i
                                                class="fa-solid fa-pen-to-square"></i></a>
                                        @endisset
                                        @isset(auth()->user()->role->permission['permission']['permission']['delete'])
                                        <a href="{{ route('permission.destroy', $item->id) }}"
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
        $('#add_permission_form').on('submit', function(e){
            e.preventDefault();
            $('#add_permission_button').text('Adding...');
            const fd = new FormData(this);
            $.ajax({
                url: "{{ route('permission.store') }}",
                method: "POST",
                data: fd,
                catch: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(res){
                    if (res.status == 200) {
                        $('#add_permission_form')[0].reset();
                        $('#add_permission_button').text('Save Permission');
                        $('#add_permission_modal').modal('hide');
                        $('.permission_table').load(location.href+' .permission_table');
                        toastr.success('Permission inserted successfully!');
                    }
                },
                error: function(err){
                    console.log(err);
                    $('#add_permission_button').text('Save Permission');
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
                        if (value.id == res.permission['role_id']) {
                            RoleHTML += `<option value="${value.id}" selected="selected">${value.name}</option>`
                        } else {
                            RoleHTML += `<option value="${value.id}" >${value.name}</option>`
                        }
                    });                    
                    $('#role_id').html(RoleHTML);
                    $('#permission_id').val(res.permission['id']);
                    //  brand
                    if (res.permission['permission']['brand']) {
                        if (res.permission['permission']['brand']['list']) {
                            $("#brand-list").attr("checked","checked");
                        }else{
                            $("#brand-list").removeAttr("checked");
                        }
                        if (res.permission['permission']['brand']['add']) {
                            $("#brand-add").attr("checked","checked");
                        }else{
                            $("#brand-add").removeAttr("checked");
                        }
                        if (res.permission['permission']['brand']['edit']) {
                            $("#brand-edit").attr("checked","checked");
                        }else{
                            $("#brand-edit").removeAttr("checked");
                        }
                        if (res.permission['permission']['brand']['delete']) {
                            $("#brand-delete").attr("checked","checked");
                        }else{
                            $("#brand-delete").removeAttr("checked");
                        }
                        if (res.permission['permission']['brand']['status']) {
                            $("#brand-status").attr("checked","checked");
                        }else{
                            $("#brand-status").removeAttr("checked");
                        }
                        if (res.permission['permission']['brand']['view']) {
                            $("#brand-view").attr("checked","checked");
                        }else{
                            $("#brand-view").removeAttr("checked");
                        }
                    }

                    //  category
                    if (res.permission['permission']['category']) {
                        if (res.permission['permission']['category']['list']) {
                            $("#category-list").attr("checked","checked");
                        }else{
                            $("#category-list").removeAttr("checked");
                        }
                        if (res.permission['permission']['category']['add']) {
                            $("#category-add").attr("checked","checked");
                        }else{
                            $("#category-add").removeAttr("checked");
                        }
                        if (res.permission['permission']['category']['edit']) {
                            $("#category-edit").attr("checked","checked");
                        }else{
                            $("#category-edit").removeAttr("checked");
                        }
                        if (res.permission['permission']['category']['delete']) {
                            $("#category-delete").attr("checked","checked");
                        }else{
                            $("#category-delete").removeAttr("checked");
                        }
                        if (res.permission['permission']['category']['status']) {
                            $("#category-status").attr("checked","checked");
                        }else{
                            $("#category-status").removeAttr("checked");
                        }
                        if (res.permission['permission']['category']['view']) {
                            $("#category-view").attr("checked","checked");
                        }else{
                            $("#category-view").removeAttr("checked");
                        }
                    }
                    
                    //  product
                    if (res.permission['permission']['product']) {
                        if (res.permission['permission']['product']['list']) {
                            $("#product-list").attr("checked","checked");
                        }else{
                            $("#product-list").removeAttr("checked");
                        }
                        if (res.permission['permission']['product']['add']) {
                            $("#product-add").attr("checked","checked");
                        }else{
                            $("#product-add").removeAttr("checked");
                        }
                        if (res.permission['permission']['product']['edit']) {
                            $("#product-edit").attr("checked","checked");
                        }else{
                            $("#product-edit").removeAttr("checked");
                        }
                        if (res.permission['permission']['product']['delete']) {
                            $("#product-delete").attr("checked","checked");
                        }else{
                            $("#product-delete").removeAttr("checked");
                        }
                        if (res.permission['permission']['product']['status']) {
                            $("#product-status").attr("checked","checked");
                        }else{
                            $("#product-status").removeAttr("checked");
                        }
                        if (res.permission['permission']['product']['view']) {
                            $("#product-view").attr("checked","checked");
                        }else{
                            $("#product-view").removeAttr("checked");
                        }
                        
                    }

                    //  slider
                    if (res.permission['permission']['slider']) {
                        if (res.permission['permission']['slider']['list']) {
                            $("#slider-list").attr("checked","checked");
                        }else{
                            $("#slider-list").removeAttr("checked");
                        }
                        if (res.permission['permission']['slider']['add']) {
                            $("#slider-add").attr("checked","checked");
                        }else{
                            $("#slider-add").removeAttr("checked");
                        }
                        if (res.permission['permission']['slider']['edit']) {
                            $("#slider-edit").attr("checked","checked");
                        }else{
                            $("#slider-edit").removeAttr("checked");
                        }
                        if (res.permission['permission']['slider']['delete']) {
                            $("#slider-delete").attr("checked","checked");
                        }else{
                            $("#slider-delete").removeAttr("checked");
                        }
                        if (res.permission['permission']['slider']['status']) {
                            $("#slider-status").attr("checked","checked");
                        }else{
                            $("#slider-status").removeAttr("checked");
                        }
                        if (res.permission['permission']['slider']['view']) {
                            $("#slider-view").attr("checked","checked");
                        }else{
                            $("#slider-view").removeAttr("checked");
                        }
                    }

                    //  role
                    if (res.permission['permission']['role']) {
                        if (res.permission['permission']['role']['list']) {
                            $("#role-list").attr("checked","checked");
                        }else{
                            $("#role-list").removeAttr("checked");
                        }
                        if (res.permission['permission']['role']['add']) {
                            $("#role-add").attr("checked","checked");
                        }else{
                            $("#role-add").removeAttr("checked");
                        }
                        if (res.permission['permission']['role']['edit']) {
                            $("#role-edit").attr("checked","checked");
                        }else{
                            $("#role-edit").removeAttr("checked");
                        }
                        if (res.permission['permission']['role']['delete']) {
                            $("#role-delete").attr("checked","checked");
                        }else{
                            $("#role-delete").removeAttr("checked");
                        }
                        if (res.permission['permission']['role']['status']) {
                            $("#role-status").attr("checked","checked");
                        }else{
                            $("#role-status").removeAttr("checked");
                        }
                        if (res.permission['permission']['role']['view']) {
                            $("#role-view").attr("checked","checked");
                        }else{
                            $("#role-view").removeAttr("checked");
                        }
                    }

                    //  subadmin
                    if (res.permission['permission']['subadmin']) {
                        if (res.permission['permission']['subadmin']['list']) {
                            $("#subadmin-list").attr("checked","checked");
                        }else{
                            $("#subadmin-list").removeAttr("checked");
                        }
                        if (res.permission['permission']['subadmin']['add']) {
                            $("#subadmin-add").attr("checked","checked");
                        }else{
                            $("#subadmin-add").removeAttr("checked");
                        }
                        if (res.permission['permission']['subadmin']['edit']) {
                            $("#subadmin-edit").attr("checked","checked");
                        }else{
                            $("#subadmin-edit").removeAttr("checked");
                        }
                        if (res.permission['permission']['subadmin']['delete']) {
                            $("#subadmin-delete").attr("checked","checked");
                        }else{
                            $("#subadmin-delete").removeAttr("checked");
                        }
                        if (res.permission['permission']['subadmin']['status']) {
                            $("#subadmin-status").attr("checked","checked");
                        }else{
                            $("#subadmin-status").removeAttr("checked");
                        }
                        if (res.permission['permission']['subadmin']['view']) {
                            $("#subadmin-view").attr("checked","checked");
                        }else{
                            $("#subadmin-view").removeAttr("checked");
                        }
                    }

                    //  permission
                    if (res.permission['permission']['permission']) {
                        if (res.permission['permission']['permission']['list']) {
                            $("#permission-list").attr("checked","checked");
                        }else{
                            $("#permission-list").removeAttr("checked");
                        }
                        if (res.permission['permission']['permission']['add']) {
                            $("#permission-add").attr("checked","checked");
                        }else{
                            $("#permission-add").removeAttr("checked");
                        }
                        if (res.permission['permission']['permission']['edit']) {
                            $("#permission-edit").attr("checked","checked");
                        }else{
                            $("#permission-edit").removeAttr("checked");
                        }
                        if (res.permission['permission']['permission']['delete']) {
                            $("#permission-delete").attr("checked","checked");
                        }else{
                            $("#permission-delete").removeAttr("checked");
                        }
                        if (res.permission['permission']['permission']['status']) {
                            $("#permission-status").attr("checked","checked");
                        }else{
                            $("#permission-status").removeAttr("checked");
                        }
                        if (res.permission['permission']['permission']['view']) {
                            $("#permission-view").attr("checked","checked");
                        }else{
                            $("#permission-view").removeAttr("checked");
                        }
                    }
                    console.log(res.permission['permission']);
                },
                error: function(err){
                    console.log(err);
                    toastr.error('Something went wrong!');
                }
            });
        });

        //  update 
        $('#update_permission_form').on('submit', function(e){
            e.preventDefault();
            $('#update_permission_button').text('updating...');
            const fd = new FormData(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('permission.edit-update') }}",
                method: "POST",
                data: fd,
                catch: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(res){                        
                    if (res.status == 200) {
                        $('#update_permission_form')[0].reset();
                        $('#update_permission_button').text('Update SubAdmin');
                        $('#edit_permission_modal').modal('hide');
                        $('.permission_table').load(location.href+' .permission_table');
                        toastr.success('Permission updated successfully!');
                    }
                },
                error: function(err){
                    console.log(err);
                    $('#update_permission_button').text('Update SubAdmin');
                    toastr.error('Something went wrong!');
                }
            });
        });            
    });
</script>
@endsection