
@extends('farmer.dashboard_contents')
@section('content')   
<div id="main" class="col-lg-9 col-12">
    <div class="menu-icon">
        <i class="fas fa-bars"></i>
    </div>
     <form id="form1" method='POST' action='{{asset('farmer/farmer_info_post')}}' runat="server">
    <div class="col-12 fr-section">
        <h2>About</h2>
        <div class="col-12">
            <h3>Title</h3>
            <div class="">
                <input name='title' class='form-control' value='{{$farmer->name}}'>
                <input type='hidden' class='form-control' name='_token' value='{{csrf_token()}}'>
            </div>
            <div class="row">
                <div class="col-md-3 mx-auto">
                   <div class='form-group'>
                        <label><img src="{{asset('public/frontend_updated/img/ico-upload.png')}}
                                    " alt="Image Description">
                            <span>Upload</span>
                            <input name="profile_photo" type='file' id="imgInp" />
                        </label>
                   
                </div>
                </div>
                <div class="col-md-7 img-cont">
                    <img id="blah" src="{{asset(isset($farmer->profile_photo)?$farmer->profile_photo:'public/images/images.png')}}" alt="your image" />
                </div>
            </div>
            <h3>Social Links</h3>
            <div class="row m-0 wrap-rw">
                <div class="ico-wrap">
                    <img src="{{asset('public/frontend_updated/img/ico-in.png')}}
                         ">
                </div>
                <div class="col-8" contenteditable="true">
                 
                      <input class='form-control' name='linkedin' value='{{isset($farmer->getDetail)? $farmer->getDetail->linkedin:''}}'>
                </div>
            </div>
            <div class="row m-0 wrap-rw">
                <div class="ico-wrap">
                    <img src="{{asset('public/frontend_updated/img/ico-tw.png')}}">
                </div>
                <div class="col-8" contenteditable="true">  
                    <input class='form-control' name='twitter' value='{{isset($farmer->getDetail)? $farmer->getDetail->twitter:''}}'>
                </div>
                
            </div>
            <div class="row m-0 wrap-rw">
                <div class="ico-wrap">
                    <img src="{{asset('public/frontend_updated/img/ico-fb.png')}}
                         ">
                </div>
                <div class="col-8" contenteditable="true">  
                    <input class='form-control' name='facebook' value='{{isset($farmer->getDetail)? $farmer->getDetail->facebook:''}}'>
                </div>
            </div>
            <h3>Locations</h3>
            <div class="wrap-all col-md-6 col-12">
                <div class="row wrap-rw justify-content-between">
                    <div>
                        <img src="{{asset('public/frontend_updated/img/ico-marker.png')}}" alt="Image Marker"> <input name='location0' class='form-control'id="txt1" value='{{ isset($farmer->getLocation[0])? $farmer->getLocation[0]->address:''}}' >
                    </div>
                   @if(isset($farmer->getLocation[0]))
                    <div>
                        <!--<a href="javascript:void(0)" class="btn-edit"><img src="{{asset('public/frontend_updated/img/ico-pen.png')}}"></a>-->
                        <a href="#" class="btn-edit"><img src="{{asset('public/frontend_updated/img/ico-bin.png')}}"></a>
                    </div>
                    @endif
                </div>

                <div class="row wrap-rw justify-content-between">
                    <div>
                        <img src="{{asset('public/frontend_updated/img/ico-marker.png')}}" alt="Image Marker"><input name='location1' class='form-control'id="txt1" value='{{ isset($farmer->getLocation[1])? $farmer->getLocation[1]->address:''}}' >
                    </div>
                      @if(isset($farmer->getLocation[1]))
                    <div>
                        <!--<a href="javascript:void(0)" class="btn-edit"><img src="{{asset('public/frontend_updated/img/ico-pen.png')}}"></a>-->
                        <a href="#" class="btn-edit"><img src="{{asset('public/frontend_updated/img/ico-bin.png')}}"></a>
                    </div>
                    @endif
                </div>
                <div class="row wrap-rw justify-content-between">
                    <div>
                        <img src="{{asset('public/frontend_updated/img/ico-marker.png')}}" alt="Image Marker"><input name='location2' class='form-control'id="txt1" value='{{ isset($farmer->getLocation[2])? $farmer->getLocation[2]->address:''}}' >
                    </div>
                    @if(isset($farmer->getLocation[2]))
                    <div>
                        <!--<a href="javascript:void(0)" class="btn-edit"><img src="{{asset('public/frontend_updated/img/ico-pen.png')}}"></a>-->
                        <a href="#" class="btn-edit"><img src="{{asset('public/frontend_updated/img/ico-bin.png')}}"></a>
                    </div>
                    @endif
                </div>
            </div>
<!--            <button type="button" class="btn btn-more"><img src="{{asset('public/frontend_updated/img/plus-icon.png')}}" alt="Image Plus">
                Add
                New</button>-->
            <div class="clearfix">
                <h3>About Farm</h3>
                <textarea name='about' class="w-100" contenteditable="true">
                  {{$farmer->getDetail->about}}
                </textarea>
            </div>
            <h2>Delivery</h2>
            <div class="w-100">
                <h3>Write delivery info</h3>
                <textarea name='delievery' class="w-100" contenteditable="true">
                   {{$farmer->getDetail->delievery}}
                </textarea>
            </div>
            <h2>Returns &amp; Exchanges</h2>
            <div class="w-100">
                <h3>Write Returns &amp; exchanges policy</h3>
                <textarea name='return' class="w-100" contenteditable="true">
                    {{$farmer->getDetail->return}}
                </textarea>
            </div>
            <button type='submit' class='btn  btn-success'>Save</button>
        </div>
    </div>
         </form>
</div>
@endsection
@section('javascript')
<script>
     $("#imgInp").change(function () {
            readURL(this);
        });



            const menuIconEl = $('.menu-icon');
            const sidenavEl = $('.sidenav');
            const sidenavCloseEl = $('.sidenav__close-icon');

            // Add and remove provided class names
            function toggleClassName(el, className) {
                if (el.hasClass(className)) {
                    el.removeClass(className);
                } else {
                    el.addClass(className);
                }
            }

            // Open the side nav on click
            menuIconEl.on('click', function () {
                toggleClassName(sidenavEl, 'active');
            });

            // Close the side nav on click
            sidenavCloseEl.on('click', function () {
                toggleClassName(sidenavEl, 'active');
            });
     



        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        function myEditFunction() {
            $('#txt1').attr('contenteditable', true).focusin().css('border', '1px solid #1fb892');
        }
    </script>
@endsection