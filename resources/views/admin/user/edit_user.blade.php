@extends('dashboard.layout')

@section('content')

    <section class="content-header">
        <h1>
            Organic
            <small>{{ $title }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="<?= asset('hash_tags') ?>">{{ $title }}</a></li>
        </ol>
        <div class="box-header">
            <div class="alert alert-success  in alert-dismissible ajax-label" style="display: none;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                <span class="ajax-label-body"></span>
            </div>
            <div id="successMessage">
                @include('includes.messages')
            </div>

        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit User</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('user.update',['user'=>$user->id])}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="lat" name="lat">
                        <input type="hidden" id="long" name="long">
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$user->name}}" id="exampleInputEmail1" placeholder="Name" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}"  autocomplete="email" id="exampleInputPassword1" placeholder="Email"required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="Password"required autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <label for="exampleInputPassword1">Confirm Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Retype Password" required name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <img id="edit_user_profile" src="{{asset($user->profile_photo)}}" alt=""><br>
                                        <label for="exampleInputFile">Upload Image</label>
                                        <input type="file" id="edit_user_input" name="user_image">

                                        {{--                                        <p class="help-block">Example block-level help text here.</p>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="status" id="optionsRadios1" value="1" checked="">
                                            Active
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="status" id="optionsRadios2" value="0">
                                            Block
                                        </label>
                                    </div>
                                </div>
                            </div>

{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="exampleInputFile">File input</label>--}}
{{--                                    <input type="file" id="exampleInputFile">--}}

{{--                                    <p class="help-block">Example block-level help text here.</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}



                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->



            </div>
        </div>
    </section>
    </div>

    <!-- /Interest modal End-->

    <!--Edit Interest Modal start-->


@endsection
@section('js')
    <script>
        $("#add_attribute").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                },
                value: {
                    required: true,
                    // minlength: 3,
                },

            },
        });
    </script>
    <!-- get lat long and append to hidden fields -->
    <script>

        function getLatLongOfUser() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }

        }

        function showPosition(position) {
            var lat = position.coords.latitude;
            var long = position.coords.longitude;
            if(lat != null)
            {
                $('#lat').val(lat);
            }
            if(lat != null)
            {
                $('#long').val(long);
            }



        }
        window.onload = getLatLongOfUser;

        function readImageURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#edit_user_profile').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#edit_user_input").change(function () {
            readImageURL(this);
        });
    </script>

@endsection
