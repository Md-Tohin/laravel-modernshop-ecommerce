@extends('layouts.admin_layout')
@section('title') Mordern Shop || User @endsection
@section('user') active @endsection

@section('admin-content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage User</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">User</a></li>
                    <li class="breadcrumb-item active">View</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

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
                            All Users
                        </h3>                        
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table users_table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Account</th>
                                    <th width="12%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($item->image && file_exists($item->image))
                                        <img src="{{ asset($item->image) }}" class="img-circle elevation-2 admin_image" alt="User Image" style="width: 80px; height: 80px;">
                                        @else
                                        <img src="{{ asset('assets/uploads/images/no-image.png') }}" class="img-circle elevation-2 admin_image" alt="no image" style="width: 80px; height: 80px;">
                                        @endif
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>
                                        @if ($item->isban == 0)
                                        <span class="badge rounded-pill bg-success">unbanned</span>
                                        @else
                                        <span class="badge rounded-pill bg-danger">banned</span>
                                        @endif
                                    </td>
                                    <td>
                                        @isset(auth()->user()->role->permission['permission']['role']['edit'])
                                            @if ($item->isban == 0)
                                            <a href="{{ route('admin.user.banned', $item->id) }}" class="updateBannedUnbanned btn btn-danger btn-sm" title="Banned Now"><i class="fa-solid fa-arrow-down"></i> Banned</a>
                                            @else
                                            <a href="{{ route('admin.user.unbanned', $item->id) }}" class="updateBannedUnbanned btn btn-success btn-sm" title="Unbanned Now"><i class="fa-solid fa-arrow-up"></i> Unbanned</a>
                                            @endif
                                        @endisset
                                    </td>
                                </tr>
                                @endforeach                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Account Type</th>
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
            //  banned or unbanned 
            $(document).on('click', '.updateBannedUnbanned', function(e){
                e.preventDefault();
                const href = $(this).attr('href');
                $.ajax({
                    url: href,
                    method: 'GET',
                    success: function(res){
                        if (res.status == 200) {                            
                            $('.users_table').load(location.href+' .users_table');
                            toastr.success(res.message);
                        }
                    },
                    error: function(err){
                        console.log(err);
                        toastr.error('Something went wrong!');
                    }
                });
            });    
        });
    </script>
@endsection