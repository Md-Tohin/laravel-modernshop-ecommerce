@extends('layouts.admin_layout')
@section('title') Mordern Shop || Admin Profile @endsection
@section('profile') active @endsection

@section('admin-content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">User Profile</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            @if (!empty(Auth::user()->image) && file_exists(Auth::user()->image))
                            <img class="profile-user-img img-fluid img-circle admin_image" src="{{ asset(Auth::user()->image) }}"
                                alt="User profile picture">
                            @else
                            <img class="profile-user-img img-fluid img-circle admin_image"
                                src="{{ asset('assets/uploads/images/no-image.png') }}" alt="User profile picture">
                            @endif
                        </div>

                        <h3 class="profile-username text-center profile_name">{{ Auth::user()->name }}</h3>

                        <p class="text-muted text-center">{{ Auth::user()->email }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Phone</b> <a class="float-right profile_phone">{{ Auth::user()->phone }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Role Type</b> <a class="float-right"><span class="badge rounded-pill bg-success">{{
                                        Auth::user()->role->name }}</span></a>
                            </li>
                            <li class="list-group-item">
                                <b>Last Seen</b> <a class="float-right">13,287</a>
                            </li>
                        </ul>

                        <a class="btn btn-primary btn-block" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            <b>Logout</b>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#details"
                                    data-toggle="tab">Details</a></li>
                            <li class="nav-item"><a class="nav-link" href="#change_image" data-toggle="tab">Image</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#change_password"
                                    data-toggle="tab">Password</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="details">
                                <form action="{{ route('profile.update.detail') }}" method="POST" id="update_profile_detail_form" class="form-horizontal">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email"
                                                value="{{ Auth::user()->email }}" readonly placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ Auth::user()->name }}" placeholder="Name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="phone" name="phone"
                                            value="{{ Auth::user()->phone }}" placeholder="Phone">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" id="update_profile_detail_button" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="change_image">
                                <form action="{{ route('profile.update.image') }}" method="POST" id="update_profile_image_form" class="form-horizontal" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-2 col-form-label">Image</label>
                                        <div class="col-sm-10">
                                            <div class="custom-file">
                                                <input type="file" onchange="loadFile(this)" class="custom-file-input" name="image">
                                                <label class="custom-file-label" for="image">Choose file</label>
                                            </div>
                                            <div class="mt-3">
                                                @if (!empty(Auth::user()->image) && file_exists(Auth::user()->image))
                                                <img class="profile-user-img img-fluid img-circle imagepreviewarea"
                                                    src="{{ asset(Auth::user()->image) }}" alt="User profile picture">
                                                @else
                                                <img class="profile-user-img img-fluid img-circle imagepreviewarea"
                                                    src="{{ asset('assets/uploads/images/no-image.png') }}"
                                                    alt="User profile picture">
                                                @endif
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" id="update_profile_image_button" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="change_password">
                                <form action="{{ route('profile.update.password') }}" method="POST" id="update_profile_password_form" class="form-horizontal">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="current_password" class="col-sm-3 col-form-label">Current
                                            Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="current_password"
                                                id="current_password" placeholder="Current Password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="new_password" class="col-sm-3 col-form-label">New Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="new_password"
                                                id="new_password" placeholder="New Password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="confirm_password" class="col-sm-3 col-form-label">Confirm
                                            Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="confirm_password"
                                                id="confirm_password" placeholder="Confirm Password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-3 col-sm-10">
                                            <button type="submit" id="update_profile_password_button" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('custom-scripts')
   <script>
    //  preview image
    function loadFile(input) {
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.imagepreviewarea').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }else{
            $('.imagepreviewarea').attr('src', '/assets/uploads/images/no-image.png');
        }
    }
    $(document).ready(function() {
        //  update details
        $('#update_profile_detail_form').on('submit', function(e){
            e.preventDefault();            
            const href = $(this).attr('action');
            const fd = new FormData(this);
            $('#update_profile_detail_button').text('Updating...');
            $.ajax({
                url: href,
                method: 'POST',
                data: fd,
                catch: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(res){
                    if (res.status == 200) {
                        console.log(res);
                        $('#update_profile_detail_form')[0].reset();
                        $('#update_profile_detail_button').text('Submit');
                        $('#name').val(res.user.name);
                        $('#phone').val(res.user.phone);
                        $('.profile_name').text(res.user.name);
                        $('.profile_phone').text(res.user.phone);
                        toastr.success('Profile updated successfully!');
                    }                    
                },
                error: function(err){
                    console.log(err);
                    $('#update_profile_detail_button').text('Submit');
                    toastr.error('Something went wrong!');
                }
            });
        });

        //  update image
        $('#update_profile_image_form').on('submit', function(e){
            e.preventDefault();            
            const href = $(this).attr('action');
            const fd = new FormData(this);
            $('#update_profile_image_button').text('Updating...');
            $.ajax({
                url: href,
                method: 'POST',
                data: fd,
                catch: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(res){
                    if (res.status == 200) {
                        // console.log(res);
                        $('#update_profile_image_form')[0].reset();
                        $('#update_profile_image_button').text('Submit');
                        $('.imagepreviewarea').attr('src', '/'+res.user.image);
                        $('.admin_image').attr('src', '/'+res.user.image);
                        toastr.success('Profile image updated successfully!');
                    }                    
                },
                error: function(err){
                    console.log(err);
                    $('#update_profile_image_button').text('Submit');
                    toastr.error('Something went wrong!');
                }
            });
        });

        //  update password
        $('#update_profile_password_form').on('submit', function(e){
            e.preventDefault();            
            const href = $(this).attr('action');        
            const fd = new FormData(this);
            $('#update_profile_password_button').text('Updating...');
            $.ajax({
                url: href,
                method: 'POST',
                data: fd,
                catch: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(res){
                    if (res.status == 200) {
                        // console.log(res);
                        $('#update_profile_password_form')[0].reset();
                        $('#update_profile_password_button').text('Submit');
                        toastr.success('Your password updated successfully!');
                    } 
                    if (res.status == 501) {
                        $('#update_profile_password_form')[0].reset();
                        $('#update_profile_password_button').text('Submit');
                        toastr.error('Your current password is incorrect!');
                    }                  
                    if (res.status == 502) {
                        $('#update_profile_password_form')[0].reset();
                        $('#update_profile_password_button').text('Submit');
                        toastr.error('Your new password and confirm password does not match!');
                    }                  
                },
                error: function(err){
                    console.log(err);
                    $('#update_profile_password_form')[0].reset();
                    $('#update_profile_password_button').text('Submit');
                    toastr.error('Something went wrong!');
                }
            });
        });

    });
   </script>
@endsection