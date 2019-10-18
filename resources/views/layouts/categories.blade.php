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
                          <input type="button" class="btn btn-primary pull-right identity"  data-toggle="modal" data-target="#add-tag-modal" value="Add Category" >
                        </div>
                                <div class="box-body">
                                    <table id="full_feature_datatable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sr#</th>
                                                <th>Name</th>
                                                <th>Picture</th>

                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $sr_num = 1
                                            @endphp

                                             @foreach ($categories as $data)
                                                <tr>
                                                    <td>
                                                        {{ $sr_num }}
                                                       @php
                                                        $sr_num++;
                                                      @endphp
                                                    </td>

                                                    <td>{{ $data->name }}</td>
                                                    <td>
                                                    @if($data->image_path != null)
                                                        <img src="{{asset($data->image_path)}}"
                                                                 alt="No Image Found">
                                                    @else
                                                                    <span>N/A</span>
                                                    @endif
                                                    </td>

                                                    <td>
                                                        <a href="javascript:void(0)"  data-toggle="modal" data-target="#confirm-delete{{ $data->id }}" class="text-danger delete"><i class="fa fa-trash-o"></i></a>
                                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#edit-modal{{ $data->id }}" class="text-primary"><i class="fa fa-pencil-square-o"></i></a>
                                                    </td>
                                                </tr>

                                                    <div class="modal fade" id="confirm-delete<?=$data->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3>Confirm</h3>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5>Are you sure you want to delete this category?</h5>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default close_modal" data-dismiss="modal">Cancel</button>
                                                                <a href="{{ asset('admin/delete_category/'.$data->id)}}"  class="btn btn-danger btn-ok" >Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

               <div class="modal fade view_details" id="edit-modal{{ $data->id }}" >
                   <form class="update_cat{{$data->id}}" action="{{ route('update_category')}}" method="Post"
                         enctype="multipart/form-data">
                        {{ csrf_field() }}
                       <div class="modal-dialog">


                    <div class="modal-content" id="test">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Update Category</h4>
                        </div>
                        <div class="modal-body show_details">
                            <input type="hidden" name="cat_id" value="{{ $data->id }}">
                            <div class="form-group">
                                <label for="category">Name</label>
                                <input name="category" type="text" class="form-control" value="{{ $data->name }}">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputFile">Category Image</label>
                                <input required type="file" name="category_image" id="dynamic_category_image"
                                       class="form-group">
                                <!-- accept="image/x-png,image/gif,image/jpeg, image/jpg" -->
                                @if($data->image_path != '')
                                    <img id="category_image_show" class="change_category_image"
                                         src="{{ asset($data->image_path)}}" width="250px"
                                         alt="your image"/>
                                @endif

                            </div>


                        </div>

                        <div class="col-md-12">
                            <!--<span class="error_title" style="color:red; display:none;">This field is required.</span>-->
                        </div>
                        <div class="modal-footer">
                            <input type="submit"  class="btn btn-success pull-left cat" data-id="{{  $data->id }}" value="Save">
                            <button type="button" class="btn btn-default pull-right close_modal" data-dismiss="modal">Exit</button>
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
                                        {{ $categories->render() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
 <div class="modal fade" id="add-tag-modal">
     <form id="add_category" action="{{ route('add_category') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-dialog">
                        <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Category</h4>
                      </div>
                      <div class="modal-body">
                          <div class="form-group">
                              <label>Add Category Here: </label>
                              <input name="category" class="form-control" type="text">
                          </div>

                          <div class="form-group">
                              <label for="exampleInputFile">Category Image</label>
                              <input required type="file" name="category_image" id="dynamic_add_category_input"
                                     class="form-group">
                              <!-- accept="image/x-png,image/gif,image/jpeg, image/jpg" -->
                              <img style="display:none;" id="change_add_category_image" class="change_category_image"
                                   src="" width="250px"
                                   alt="your image"/>

                          </div>
                      </div>
                      <div class="modal-footer">
                        <input type="submit"  class="btn btn-success pull-left" value="Save">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                 </div>
            </form>
           <!-- /.modal-dialog -->
           </div>
        <!-- /Interest modal End-->

        <!--Edit Interest Modal start-->


@endsection
@section('js')
<script>
$("#add_category").validate({
    rules: {
        category: {
            required: true,
            minlength: 3,
        }

      },
 });
 $('body').on('click','.cat',function(){
     var a = $(this).data('id');

// alert(a);
           $('.update_cat'+a).validate({

                                            rules: {

                                                category: {
                                                    required: true,
                                                     normalizer: function (value) {
                                                     return $.trim(value);
                                                }

                                                }
                                            }


                                        });
                                        });

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.change_category_image').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#dynamic_category_image").change(function () {
    readURL(this);
});

function readURLAddCategory(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#change_add_category_image').show();
            $('#change_add_category_image').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#dynamic_add_category_input").change(function () {
    readURLAddCategory(this);
});


</script>
@endsection
