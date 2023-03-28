@extends('layouts.admin_layout')
@section('title') Mordern Shop || Role @endsection
@section('role') active @endsection

@section('admin-content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Role</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Role</a></li>
                    <li class="breadcrumb-item active">View</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- add role Modal -->
<div class="modal fade" id="add_role_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Role</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" id="add_role_form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Role Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Enter role name">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="add_role_button" class="btn btn-primary">Save Role</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- add role Modal -->

<!-- edit role Modal -->
<div class="modal fade" id="edit_role_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Role</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" id="update_role_form">
                @csrf
                <input type="hidden" name="role_id" id="role_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Role Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" @if (isset($role)) value="{{ $role->name }}" @endif class="form-control" placeholder="Enter role name">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="update_role_button" class="btn btn-primary">Update Role</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- edit role Modal -->

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
                            All Roles
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                @isset(auth()->user()->role->permission['permission']['role']['add'])
                                    <li class="nav-item">
                                        <button type="button" class="btn btn-sm btn-success text-light text-md"
                                            data-toggle="modal" data-target="#add_role_modal"><i
                                                class="fa-solid fa-circle-plus mr-2"></i> Add Role </button>
                                    </li>
                                @endisset                                
                            </ul>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table add_role_table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>                                   
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            <a href="{{ route('role.status') }}" module_id="{{ $item->id }}" status="active" class="updateStatus"><i class="fa-solid fa-toggle-on text-success" style="font-size: 25px;"></i></a>
                                        @else
                                        <a href="{{ route('role.status') }}" module_id="{{ $item->id }}" status="inactive" class="updateStatus"><i class="fa-solid fa-toggle-off text-danger" style="font-size: 25px;"></i></a>
                                        @endif
                                    </td>
                                    <td>
                                        @isset(auth()->user()->role->permission['permission']['role']['edit'])
                                        <a href="{{ route('role.edit', $item->id) }}" class="editButton btn btn-success btn-sm" data-toggle="modal" data-target="#edit_role_modal" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                        @endisset
                                        @isset(auth()->user()->role->permission['permission']['role']['delete'])
                                        <a href="{{ route('role.destroy', $item->id) }}" class="btn btn-danger btn-sm confirmDelete" title="Delete"><i class="fa-solid fa-trash"></i></a>
                                        @endisset
                                    </td>
                                </tr>
                                @endforeach                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Status</th>
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
            $('#add_role_form').on('submit', function(e){
                e.preventDefault();
                $('#add_role_button').text('Adding...');
                const fd = new FormData(this);
                $.ajax({
                    url: "{{ route('role.store') }}",
                    method: "POST",
                    data: fd,
                    catch: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(res){
                        if (res.status == 200) {
                            $('#add_role_form')[0].reset();
                            $('#add_role_button').text('Save Role');
                            $('#add_role_modal').modal('hide');
                            $('.add_role_table').load(location.href+' .add_role_table');
                            toastr.success('Role inserted successfully!');
                        }
                    },
                    error: function(err){
                        console.log(err);
                        $('#add_role_button').text('Save Role');
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
                        $('#role_id').val(res.id);
                        $('#name').val(res.name);
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
                    url: "{{ route('role.edit-update') }}",
                    method: "POST",
                    data: fd,
                    catch: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(res){                        
                        if (res.status == 200) {
                            $('#update_role_form')[0].reset();
                            $('#update_role_button').text('Update Role');
                            $('#edit_role_modal').modal('hide');
                            $('.add_role_table').load(location.href+' .add_role_table');
                            toastr.success('Role updated successfully!');
                        }
                    },
                    error: function(err){
                        console.log(err);
                        $('#update_role_button').text('Update Role');
                        toastr.error('Something went wrong!');
                    }
                });
            });            
        });
    </script>
@endsection