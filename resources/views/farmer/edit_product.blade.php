
@include("farmer.includes.head")
<main role="content" class="container prod-container container-custom">
    @include("farmer.includes.header")
    <div class="row m-0">
        <h2>Edit Product</h2>
    </div>
    <div class="row">
        <aside class="sidebar side-nav col-md-3">
            <nav id="list--example">
                <div id="list-example" class="list-group components">
                    <div id="list-example" class="list-group components nav-tabs">
                        <a class="list-group-item list-group-item-action nav-item active" href="#newproduct" data-toggle="tab" aria-expanded="false">Product Detail</a>
                        <a class="list-group-item list-group-item-action nav-item" href="#location" data-toggle="tab" aria-expanded="false">Location</a>
                        <a class="list-group-item list-group-item-action nav-item" href="#productgallery" data-toggle="tab" aria-expanded="false">Product Gallery</a>
                        <a class="list-group-item list-group-item-action nav-item" href="#review" data-toggle="tab" aria-expanded="false">Review</a>
                    </div>
                </div>
            </nav>
        </aside>
        <form class="col-lg-9 col-md-8" id='edit_product' action="{{asset('farmer/edit_post_products')}}" method="POST" enctype='multipart/form-data'> 
            <div class="tab-content">
                <!-- Farm Fresh Deals Starts.. -->

                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <div class="tab-pane active" id="newproduct">
                    <section class="container container-custom sec-deals pb-md-5 pb-3 loc-form">
                        <h1 class="mb-4" id="list-item-1">Product Detail</h1>
                        <?php include resource_path('views/includes/messages.php'); ?>
                        <div class="row m-0">
                            <div class=" w-100 pt-3 form-contact cr-prod pl-1 pr-1 pb-5">
                                <div class="form-group mb-3">
                                    <label for="productName">Product Name<sup>*</sup></label>
                                    <input type="text" name="product_name" value="{{$product->name}}" class="form-control form-control-lg" id="productName" placeholder="Avocados from Mexico Hass Avocados, Ready-to-Eat">
                                           <input type="hidden" id='is_draft' name="is_draft" value='0' class="form-control form-control-lg" id="productName" placeholder="Avocados from Mexico Hass Avocados, Ready-to-Eat">
                                           <input type="hidden" id='id' name="id" value='{{$product->id}}' class="form-control form-control-lg" id="productName" placeholder="Avocados from Mexico Hass Avocados, Ready-to-Eat">
                          
                                </div>
                                <div class="form-group mb-3">

                                    <label for="productName">Tags<sup>*</sup></label>
                                    <select class="form-control js-example-tags" name='product_tags[]' multiple="multiple">
                                        @foreach($product->getTagProducts as $tags)
                                        <option selected="selected">{{$tags->name}}</option>

                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group mb-3 col-md-8 col-12 p-0">
                                    <label for="category">Category<sup>*</sup></label>
                                    <select name="category" id="product_category" class="custom-select custom-select-lg">
                                        @foreach($categories as $category)

                                        <option id="cat{{$category->id}}" value="{{$category->id}}" {{($product->cat_id==$category->id)?'selected':''}}>{{$category->name}}</option>

                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="inputDesc">Description</label>
                                    <textarea class="form-control form-control-lg"  name="product_description" id="inputDesc" rows="3" placeholder="Enter product Description">{{$product->description}}</textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3 col-12">
                                        <div class="w-100 mb-3">
                                            <label for="inputWeight">Quantity<sup>*</sup></label>
                                            <input type="number" class="form-control form-control-lg"  value="{{$product->quantity}}" name="product_quantity" id="inputWeight" placeholder="12">
                                        </div>
                                        <div class="w-100 mb-3">
                                            <label for="inputPrice">Price<sup>*</sup></label>
                                            <input type="number" name="product_price"  value="{{$product->price}}" class="form-control form-control-lg" id="inputPrice" placeholder="29.99">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 col-12 mb-3">
                                        <label for="sel-cat">Metric/Unit<sup>*</sup></label>
                                        <select name="unit" class="custom-select custom-select-lg" id="sel-cat">
                                            @foreach($units as $unit)

                                            <option value="{{$unit->id}}"  {{($product->unit_id==$unit->id)?'selected':''}}>{{$unit->name}}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="tab-pane" id="location">
                    <section class="container sec-deals static-container pb-md-5 pb-3 loc-form loc-form">
                        <h1 class="mb-4" id="list-item-1">Location</h1>
                        <div class="row m-0">
                            <div class="w-100 pt-3 form-contact cr-prod pl-1 pr-1 pb-5">
                                <!--                            <div class="form-row">
                                                                <div class="form-group col-md-3 col-12">
                                                                    <label for="cntryName">Country<sup>*</sup></label>
                                                                   
                                                                    <select class="custom-select">
                                                                         @foreach($user->getLocation as $location)
                                                                        <option>{{$location->address}}</option>
                                                                       @endforeach
                                                                    </select>
                                                                    
                                                                </div>
                                                                <div class="form-group col-md-3 col-12">
                                                                    <label for="stateName">State<sup>*</sup></label>
                                                                    <select class="custom-select">
                                                                        <option selected>New York</option>
                                                                        <option value="wdc">Washington DC</option>
                                                                        <option value="cl">Colombia</option>
                                                                    </select>
                                                                </div>
                                                            </div>-->
                                <div class="form-row">
                                    <div class="form-group col-md-6 col-12">
                                        <label for="cntryName">Location<sup>*</sup></label>
                                        <select class="custom-select" id="productLocation" name="product_location">
                                            @foreach($user->getLocation as $location)
                                            <option id="loc{{$location->id}}" value="{{$location->id}}"  {{($product->location_id==$location->id)?'selected':''}} >{{$location->address}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>
                </div>
                <div class="tab-pane" id="productgallery">
                    <section class="container container-custom sec-deals static-container pb-md-5 pb-3 loc-form">
                        <h1 class="mb-4" id="list-item-1">Product Gallery</h1>
                        <div class="row m-0">
                            <div class="col-lg-6 preview-block add">
                                <label class="labelimg1" for="imgUp" style='<?= isset($product->getFeaturedImage) ? 'visibility:hidden' : 'visibility:visible'; ?>'><span><img src="{{asset('public/frontend_updated/img/ico-cloud.png')}}" alt="Download Icon"> Upload Photo</span></label>
                                <input id="imgUp" name="featured_image" type='file' class="img input1" set-to="div1" />
                                <div>
                                    <a onclick="removeImg(this, '1')" data-id='{{isset($product->getFeaturedImage)? $product->getFeaturedImage->id:''}}'  href="javascript:void(0)" class="close-icon close1" style='<?= isset($product->getFeaturedImage) ? '' : 'display:none'; ?>'><img src="{{asset('public/frontend_updated/img/ico-close.png')}}" alt="Close Icon" ></a>
                                    <img class="image" id="div1" src="{{isset($product->getFeaturedImage) ? asset($product->getFeaturedImage->original_path):''}}" alt="image 1" /> 
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <ul class="gallery-list add">
                                    <li>
                                        <label class="labelimg2"  for="imgUp1" style='<?= isset($product->getProductImages[0]) ? 'visibility:hidden' : 'visibility:visible'; ?>'>
                                            <span><img src="{{asset('public/frontend_updated/img/ico-cloud.png')}}
                                                       " alt="Download Icon"> Upload Photo</span>
                                        </label>
                                        <input class="img input2" name="image_1" id="imgUp1" type='file' set-to="div2" />
                                        <div>
                                            <a onclick="removeImg(this, '2')"  data-id='{{isset($product->getProductImages[0])?$product->getProductImages[0]->id:''}}' href="javascript:void(0)" class="close-icon close2" style='<?= isset($product->getProductImages[0]) ? '' : 'display:none'; ?>'><img src="{{asset('public/frontend_updated/img/ico-close.png')}} " alt="Close Icon"></a>
                                            <img class="image" id="div2" src="{{isset($product->getProductImages[0]) ? asset($product->getProductImages[0]->original_path):''}}" alt="image 1"  /> 
                                        </div>
                                    </li>
                                    <li>
                                        <label class="labelimg3"  for="imgUp2" style='<?= isset($product->getProductImages[1]) ? 'visibility:hidden' : 'visibility:visible'; ?>'>
                                            <span><img src="{{asset('public/frontend_updated/img/ico-cloud.png')}}
                                                       " alt="Download Icon"> Upload Photo</span>
                                        </label><input class="img input3" name="image_2" type='file' id="imgUp2" set-to="div3" />
                                        <div>
                                            <a onclick="removeImg(this, '3')" data-id='{{isset($product->getProductImages[1])?$product->getProductImages[1]->id:''}}' href="javascript:void(0)" class="close-icon close3" style='<?= isset($product->getProductImages[1]) ? '' : 'display:none'; ?>'><img src="{{asset('public/frontend_updated/img/ico-close.png')}} " alt="Close Icon"></a>
                                            <img class="image" id="div3" src="{{isset($product->getProductImages[1]) ? asset($product->getProductImages[1]->original_path):''}}" alt="image 1" /> 
                                        </div>
                                    </li>
                                    <li>
                                        <label class="labelimg4"  for="imgUp3" style='<?= isset($product->getProductImages[2]) ? 'visibility:hidden' : 'visibility:visible'; ?>'>
                                            <span><img src="{{asset('public/frontend_updated/img/ico-cloud.png')}}
                                                       " alt="Download Icon"> Upload Photo</span>
                                        </label><input class="img input4" name="image_3" type='file' id="imgUp3" set-to="div4" />
                                        <div>
                                            <a onclick="removeImg(this, '4')" data-id='{{isset($product->getProductImages[2])?$product->getProductImages[2]->id:''}}' href="javascript:void(0)" class="close-icon close4" style='<?= isset($product->getProductImages[2]) ? '' : 'display:none'; ?>'><img src="{{asset('public/frontend_updated/img/ico-close.png')}}
                                                                                                                                                                                                        " alt="Close Icon" ></a>
                                            <img class="image" id="div4" src="{{isset($product->getProductImages[2]) ? asset($product->getProductImages[2]->original_path):''}}" alt="image 1" /> 
                                        </div>
                                    </li>
                                    <li>
                                        <label class="labelimg5" for="imgUp4" style='<?= isset($product->getProductImages[3]) ? 'visibility:hidden' : 'visibility:visible'; ?>'>
                                            <span><img src="{{asset('public/frontend_updated/img/ico-cloud.png')}}
                                                       " alt="Download Icon"> Upload Photo</span>
                                        </label><input class="img input5" name="image_4" type='file' id="imgUp4" set-to="div5" />
                                        <div>
                                            <a onclick="removeImg(this, '5')" data-id='{{isset($product->getProductImages[3])?$product->getProductImages[3]->id:''}}' href="javascript:void(0)" class="close-icon close5" style='<?= isset($product->getProductImages[3]) ? '' : 'display:none'; ?>'><img src="{{asset('public/frontend_updated/img/ico-close.png')}} " alt="Close Icon" ></a>
                                            <img class="image" id="div5" src="{{isset($product->getProductImages[3]) ? asset($product->getProductImages[3]->original_path):''}}" alt="image 1" /> 
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="tab-pane" id="review">
                    <section class="container container-custom sec-deals pb-md-4 pb-3 loc-form">
                        <h1 class="mb-4">Product Preview</h1>
                        <div class="row m-0">
                            <div class="preview col-12 row ml-0 mr-0 mb-5">
                                <h3>Product Gallery</h3>
                                <ul class="preview-thumbnail thumb-tabs nav nav-tabs mb-5">
                                    @if($product->getFeaturedImage)
                                    <li class="nav-item active" id='review_image{{$product->getFeaturedImage->id}}'><a data-target="#pic-1" data-toggle="tab"><img src="{{asset(isset($product->getFeaturedImage)?$product->getFeaturedImage->original_path:'')}}" /></a></li>
                                    @endif
                                    @foreach($product->getProductImages as $image)
                                    <li class="nav-item" id='review_image{{$image->id}}'><a data-target="#pic-4" data-toggle="tab"><img src="{{asset($image->original_path)}}" alt="Thumbnail" /></a></li>     @endforeach
                                </ul>
                                <div class="preview-pic tab-content">
                                    <div class="tab-pane active" id="pic-1">
                                        <dl class="row m-0">
                                            <dt >Product Name</dt>
                                            <dd id="preview_name">{{$product->name}}</dd>
                                            <dt >Category</dt>
                                            <dd id="preview_category">{{$product->getCategory->name}}</dd>
                                            <dt>Location</dt>
                                            <dd id="preview_location">{{$product->getLocation->address}}</dd>
                                            <dt >Quantity</dt>
                                            <dd id="preview_weight">{{$product->quantity}}</dd>
                                            <dt>Description</dt>
                                            <dd id="preview_description"> {{$product->description}}<br /><a href="#">see more</a></dd>
                                        </dl>
                                    </div>


                                </div>
                            </div>
                            <div class="btn-holder pt-3 pb-3">
                                <button type="submit" class="btn btn-draft draft_submit">Save Draft</button>
                                <button type="submit" class="btn btn-primary btn-send">Publish Product</button>
                            </div>
                        </div>
                    </section>
                </div>

            </div>
        </form>
    </div>
</main>






@include("farmer.includes.footer")
<script>
    $(document).ready(function () {
            $('body').on('click', '.draft_submit', function (event) {
            event.preventDefault();
            $('#is_draft').val(1);
            var id=$('#id').val();
            $.ajax({
                    type: "POST",
                    url: "<?= asset('farmer/delete_tags') ?>",
                    data: {id: id, '_token': '<?= csrf_token(); ?>'},
                    dataType: 'json',
                    success: function (data) {

                        if (data.success)
                        {
                            $('.ajax-label').show();
                            $(".ajax-label").removeClass("alert-danger");
                            $(".ajax-label").addClass("alert-success");
                            $(".ajax-label-body").html(data.message);
                        } else
                        {
                            $('.ajax-label').show();
                            $(".ajax-label").addClass("alert-danger");
                            $(".ajax-label").removeClass("alert-success");
                            $(".ajax-label-body").html(data.message);
                        }
                    },
                    error: function (data) {
                        $('#preloader').hide();
                    }
                });
            $("#edit_product").submit();
        });
         $('body').on('click', '.btn-send', function (event) {
            event.preventDefault();
   
            var id=$('#id').val();
            $.ajax({
                    type: "POST",
                    url: "<?= asset('farmer/delete_tags') ?>",
                    data: {id: id, '_token': '<?= csrf_token(); ?>'},
                    dataType: 'json',
                    success: function (data) {

                        if (data.success)
                        {
                            $('.ajax-label').show();
                            $(".ajax-label").removeClass("alert-danger");
                            $(".ajax-label").addClass("alert-success");
                            $(".ajax-label-body").html(data.message);
                        } else
                        {
                            $('.ajax-label').show();
                            $(".ajax-label").addClass("alert-danger");
                            $(".ajax-label").removeClass("alert-success");
                            $(".ajax-label-body").html(data.message);
                        }
                    },
                    error: function (data) {
                        $('#preloader').hide();
                    }
                });
            $("#edit_product").submit();
        });
        $('#productName').on('change', function () {
            var name = $('#productName').val();
            $('#preview_name').empty();
            $('#preview_name').append(name);
        });
        $('#product_category').on('change', function () {
            var id = $('#product_category').val();
//           alert($('#cat'+id).html());
            $('#preview_category').empty();
            $('#preview_category').append($('#cat' + id).html());
        });
        $('#inputDesc').on('change', function () {
            var name = $('#inputDesc').val();
            $('#preview_description').empty();
            $('#preview_description').append(name);
        });
        $('#inputWeight').on('change', function () {
            var name = $('#inputWeight').val();
            $('#preview_weight').empty();
            $('#preview_weight').append(name);
        });

        $('#productLocation').on('change', function () {
            var id = $('#productLocation').val();
//           alert($('#cat'+id).html());
            $('#preview_location').empty();
            $('#preview_location').append($('#loc' + id).html());
        });
        $(".js-example-tags").select2({
            tags: true
        });
        function newreadURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var div_id = $(input).attr('set-to');
                reader.onload = function (e) {
                    $('#' + div_id).attr('src', e.target.result);
                    $('.preview-thumbnail').append('<li class="nav-item active" id="review_image1"><a data-target="#pic-1" data-toggle="tab"><img src=' + e.target.result + ' /></a></li>');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgUp").on('change', function () {
            $(this).parent().find('label').css('visibility', 'hidden');
            $(this).parent().find('.close-icon').css('display', 'inline-block');
            newreadURL(this);


//            $('.close-icon').on('click', function(){
//                $(this).parent().parent().find('label').css('visibility', 'visible');
//                $(this).parent('div img').remove();
//                $('.close-icon').hide();
//            });
        });

        //Function for file upload for gallery list
        function newURL(input, id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var div_id = $(input).attr('set-to');
                reader.onload = function (e) {
                    $('#' + div_id).attr('src', e.target.result);
                    $('.preview-thumbnail').append('<li class="nav-item active" id="review_image' + id + '"><a data-target="#pic-1" data-toggle="tab"><img src=' + e.target.result + ' /></a></li>');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#imgUp1').on('change', function () {
            $(this).parent().find('label').css('visibility', 'hidden');
            $(this).parent().find('.close-icon').css('display', 'inline-block');
            newURL(this, 2);
//            $('.close-icon').on('click', function(){
//                $(this).parents().find('label').css('visibility', 'visible');
//                $(this).parent('.test img').remove();
//                $('.close-icon').hide();
//            });
        });
        $(document).on('change', '#imgUp2', function () {
            $(this).parent().find('label').css('visibility', 'hidden');
            $(this).parent().find('.close-icon').css('display', 'inline-block');
            newURL(this, 3);
//            $('.close-icon').on('click', function(){
//                $(this).parents().find('label').css('visibility', 'visible');
//                $(this).parent('.test img').remove();
//                $('.close-icon').hide();
//            });
        });
        $(document).on('change', '#imgUp3', function () {
            $(this).parent().find('label').css('visibility', 'hidden');
            $(this).parent().find('.close-icon').css('display', 'inline-block');
            newURL(this, 4);

//            $('.close-icon').on('click', function(){
//                $(this).parents().find('label').css('visibility', 'visible');
//                $(this).parent('.test img').remove();
//                $('.close-icon').hide();
//            });
        });

        $(document).on('change', '#imgUp4', function () {
            $(this).parent().find('label').css('visibility', 'hidden');
            $(this).parent().find('.close-icon').css('display', 'inline-block');
            newURL(this, 5);
//            $('.close-icon').on('click', function(){
//                $(this).parents().find('label').css('visibility', 'visible');
//                $(this).parent('.test img').remove();
//                $('.close-icon').hide();
//            });   
        });
        $('body').on('click', '.close-icon', function () {

            $this = $(this);
            var id = $this.data('id');
            $('#review_image'+id).remove();
            if (id) {

                $.ajax({
                    type: "POST",
                    url: "<?= asset('farmer/delete_image') ?>",
                    data: {id: id, '_token': '<?= csrf_token(); ?>'},
                    dataType: 'json',
                    success: function (data) {

                        if (data.success)
                        {
                            $('.ajax-label').show();
                            $(".ajax-label").removeClass("alert-danger");
                            $(".ajax-label").addClass("alert-success");
                            $(".ajax-label-body").html(data.message);
                        } else
                        {
                            $('.ajax-label').show();
                            $(".ajax-label").addClass("alert-danger");
                            $(".ajax-label").removeClass("alert-success");
                            $(".ajax-label-body").html(data.message);
                        }
                    },
                    error: function (data) {
                        $('#preloader').hide();
                    }
                });
            }

        });

    });
    function removeImg(ele, id) {

        $('.labelimg' + id).css('visibility', 'visible');
        $(ele).next().attr('src', '');

        $('#review_image' + id).remove();
        $('.close' + id).hide();
        $('.input' + id).val(null);
//                $('labelimg4').css('visibility', 'visible');
    }
//    var placeSearch, autocomplete;
//    var componentForm = {
////                                                        street_number: 'short_name',
////                                                        route: 'long_name',
//        locality: 'long_name',
//        administrative_area_level_1: 'short_name',
//        country: 'long_name',
////                                                        postal_code: 'short_name'
//    };
//    function initAutocomplete() {
//        // Create the autocomplete object, restricting the search to geographical
//        // location types.
//        autocomplete = new google.maps.places.Autocomplete(
//                /** @type {!HTMLInputElement} */(document.getElementById('cntryName')),
//                {types: ['geocode']});
//
//
//        autocomplete = new google.maps.places.Autocomplete(
//                /** @type {!HTMLInputElement} */(document.getElementById('stateName')),
//                {types: ['geocode']});
//
//        // When the user selects an address from the dropdown, populate the address
//        // fields in the form.
//
//
//        autocomplete.addListener('place_changed', fillInAddress);
////                                                         autocomplete2.addListener('place_changed', fillInAddress2);
//
//
//    }
//    function fillInAddress() {
//
//        // Get the place details from the autocomplete object.
//        var place = autocomplete.getPlace();
//        var lat = place.geometry.location.lat();
//        var lng = place.geometry.location.lng();
//
//        $('#lat').val(lat);
//        $('#long').val(lng);
//
////                                                        for (var component in componentForm) {
////                                                            document.getElementById(component).value = '';
////                                                            //          document.getElementById(component).disabled = false;
////                                                        } 
//// 
//        // Get each component of the address from the place details
//        // and fill the corresponding field on the form.
//        for (var i = 0; i < place.address_components.length; i++) {
//            var addressType = place.address_components[i].types[0];
//
//            if (componentForm[addressType]) {
//                var val = place.address_components[i][componentForm[addressType]];
//                document.getElementById(addressType).value = val;
//            }
//        }
//    }
//
//    function geolocate() {
//        if (navigator.geolocation) {
//            navigator.geolocation.getCurrentPosition(function (position) {
//                var geolocation = {
//                    lat: position.coords.latitude,
//                    lng: position.coords.longitude
//                };
//                var circle = new google.maps.Circle({
//                    center: geolocation,
//                    radius: position.coords.accuracy
//                });
//                autocomplete.setBounds(circle.getBounds());
//            });
//        }
//    }

</script>
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApyIRH_zIWZT32AXvIU2A2Y-A0fvPSv50&libraries=places&callback=initAutocomplete" async defer></script>--> 
</body>
</html>