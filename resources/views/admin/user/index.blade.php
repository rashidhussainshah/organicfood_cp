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
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= $title;?></h3>
                    </div>
                    <div class="col-md-12">
                        <a href="{{route('user.create')}}" type="button" class="btn btn-primary pull-right identity">Add User</a>
{{--                        <input type="button" class="btn btn-primary pull-right identity" data-toggle="modal"--}}
{{--                               data-target="#add-tag-modal" value="Add User">--}}
                    </div>
                    <div class="box-body">
                        <table id="full_feature_datatable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Sr#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Join Date</th>

                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $sr_num = 1
                            @endphp

                            @foreach ($users as $data)
                                <tr>
                                    <td>
                                        {{ $sr_num }}
                                        @php
                                            $sr_num++;
                                        @endphp
                                    </td>
                                    <td>
                                    @if($data->profile_photo != '')
                                        <img src="{{asset($data->profile_photo)}}">
                                    @else
                                        <span>N/A</span>
                                    @endif
                                    </td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->address }}</td>
                                    <td>

                                     <span class="label label-<?= ($data->is_active == 1) ? 'success':'danger'?>"> <?= ($data->is_active==1) ? 'Active': 'Block'?></span>

                                    </td>
                                    <td>{{date('jS M Y', strtotime($data->created_at))}}</td>


                                    <td>
                                            <a href="javascript:void(0)" data-toggle="modal"
                                                 data-target="#user_detail{{ $data->id }}" class="text-primary"><i
                                                 class="fa fa-eye"></i></a>

                                        {{-- <a href="javascript:void(0)" onclick="showUserDetail({{$data->id}})" class="text-danger delete"><i
                                                class="fa fa-eye"></i></a> --}}
                                        <a href="javascript:void(0)" data-toggle="modal"
                                           data-target="#confirm-delete{{ $data->id }}" class="text-danger delete"><i
                                                class="fa fa-trash-o"></i></a>
{{--                                        <a href="javascript:void(0)" data-toggle="modal"--}}
{{--                                           data-target="#edit-modal{{ $data->id }}" class="text-primary"><i--}}
{{--                                                class="fa fa-pencil-square-o"></i></a>--}}
{{--                                        --}}
                                        <a href="{{route('user.edit', ['user'=>$data->id])}}"  class="text-primary"><i
                                                class="fa fa-pencil-square-o"></i></a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="confirm-delete<?=$data->id?>" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3>Confirm</h3>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Are you sure you want to delete this user?</h5>
                                            </div>
                                            <div class="modal-footer">

                                                <form action="{{route('user.destroy', ['user'=>$data->id])}}" method="post">
                                                    @csrf
                                                <button type="button" class="btn btn-default close_modal"
                                                        data-dismiss="modal">Cancel
                                                </button>

                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger">Delete</button>


                                                </form>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="modal fade view_details" id="user_detail{{ $data->id }}">
                                    <form class="update_cat{{$data->id}}" action="{{ route('attribute.update')}}"
                                          method="Post">
                                        {{ csrf_field() }}
                                        <div class="modal-dialog">


                                            <div class="modal-content" id="test">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">User Detail</h4>
                                                </div>
                                                <div class="modal-body show_details">
                                                   
                                                            <label for="name">Name</label>
                                                            <input  id="name" name="name" type="text" class="form-control"
                                                                   value="{{ $data->name }}" readonly>
                                                    

                                                  
                                                            <label for="value">Email</label>
                                                            <input id="value" name="value" type="text" class="form-control"
                                                                   value="{{ $data->email }}" readonly >
                                                                   
                                                            <label for="value">Phone</label>
                                                            <input id="value" name="value" type="text" class="form-control"
                                                                   value="{{ $data->phone }}" readonly >
                                                                   
                                                            <label for="value">Language</label>
                                                            <input id="value" name="value" type="text" class="form-control"
                                                                          value="{{ $data->language }}" readonly >

                                                            <label for="value">Description</label>
                                                <textarea readonly name="" id="" class="form-control">{{$data->description}}</textarea>
                                                            
                                                           
                                                   
                                                    
                                                    

                                                </div>

                                                <div class="col-md-12">
                                                    <!--<span class="error_title" style="color:red; display:none;">This field is required.</span>-->
                                                </div>
                                                <div class="modal-footer">
                                                    {{-- <input type="submit" class="btn btn-success pull-left cat"
                                                           data-id="{{  $data->id }}" value="Save"> --}}
                                                    <button type="button" class="btn btn-default pull-right close_modal"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->

                                        </div>
                                        <!-- /.modal-dialog -->
                                    </form>
                                </div>





                            @endforeach
                            </tbody>
                        </table>

                        <div class="pull-right">
                            <?php // echo $HashTag->render(); ?>
                            {{--                            {{ $attributes->render() }}--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
    <div class="modal fade" id="add-tag-modal">
        <form id="add_attribute" action="{{ route('attribute.store') }}" method="post">
            {{ csrf_field() }}
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Attribute</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('user.register')}}" method="post">
                            @csrf
                            <?php
                            if ($errors->any()) {
                            foreach ($errors->all() as $error) {
                            ?>
                            <h6 class="alert alert-danger"> <?php echo $error ?></h6>
                            <?php
                            }
                            }
                            if (Session::has('error')) {
                            ?>
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times</a>
                                <?php echo Session::get('error') ?>
                            </div>
                            <?php } ?>
                            <input type="hidden" id="lat" name="lat">
                            <input type="hidden" id="long" name="long">
                            <div class="form-group has-feedback">
                                <input id="name" placeholder="Name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group has-feedback">
                                <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group has-feedback">
                                <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group has-feedback">
                                <input id="password-confirm" placeholder="Retype Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                            </div>
                            <div class="row">
{{--                                <div class="col-xs-8">--}}
{{--                                    <div class="checkbox icheck">--}}
{{--                                        <label>--}}
{{--                                            <input type="checkbox"> I agree to the <a href="#">terms</a>--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <!-- /.col -->
                                <div class="col-xs-4">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success pull-left" value="Save">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- /.modal-dialog -->
    </div>
    <!-- /Interest modal End-->

    <!--Edit Interest Modal start-->
    
    <div class="modal fade" style="display:none" id="user_detail">
        <form id="add_attribute" action="{{ route('attribute.store') }}" method="post">
            {{ csrf_field() }}
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Attribute</h4>
                    </div>
                    <div class="modal-body" id="user_detail_bod">
                        
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success pull-left" value="Save">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- /.modal-dialog -->
    </div>


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
        $('body').on('click', '.cat', function () {
            var a = $(this).data('id');

// alert(a);
            $('.update_cat' + a).validate({

                rules: {

                    name: {
                        required: true,
                        normalizer: function (value) {
                            return $.trim(value);
                        },
                        value: {
                            required: true,
                            // normalizer: function (value) {
                            //     return $.trim(value);
                        }

                    },

                }


            });
        });
    </script>
    <script>
        function  showUserDetail(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            jQuery(document).ready(function(){

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    jQuery.ajax({
                        url: '<?php echo asset('admin/user') ?>/'+id,
                        method: 'get',
                        success: function(result){
                            $("#myModal").modal();
                        }});

            });



        }
    </script>
@endsection
