@extends('frontend.layout')
@section('content')
    <main role="content" class="container container-custom">
        <div class="wrapper row">
            <div class="preview col-md-6">
                <div class="slider-for">
                    @if($product->getProductImages)
                        @foreach($product->getProductImages as $mainImage)
                            @if($mainImage->path != '')
                                <div><img src="{{asset($mainImage->path)}}" alt="Image Tomatoes"/></div>
                            @endif
                        @endforeach
                    @endif
                </div>
                <div class='slider-nav'>
                    @if($product->getProductImages)
                        @foreach($product->getProductImages as $thumbImage)
                            @if($thumbImage->path != '')
                                <div><img src="{{asset($thumbImage->path)}}" alt="Image Tomatoes"/></div>
                            @endif
                        @endforeach
                    @endif
                </div>
                <!-- <div class="preview-pic tab-content">
                  <div class="tab-pane active" id="pic-1"><img src="img/img-tom.png" alt="Cherry Tomatoes" /></div>
                  <div class="tab-pane" id="pic-2"><img src="img/img-tom.png" alt="Image Tomatoes" /></div>
                  <div class="tab-pane" id="pic-3"><img src="img/img-tom.png" alt="Thumbnail Two" /></div>
                  <div class="tab-pane" id="pic-4"><img src="img/img-tom.png" alt="Thumbnail Two"></div>
                  <div class="tab-pane" id="pic-5"><img src="img/img-tom.png" alt="Thumbnail Two"></div>
                </div>
                <ul class="preview-thumbnail nav nav-tabs">
                   <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="img/img-thumb.png" /></a></li>
                   <li><a data-target="#pic-2" data-toggle="tab"><img src="img/img-thumb.png" alt="Tomatoes" /></a></li>
                   <li><a data-target="#pic-3" data-toggle="tab"><img src="img/img-thumb1.png" alt="thumbnail" /></a></li>
                   <li><a data-target="#pic-4" data-toggle="tab"><img src="img/img-thumb2.png" alt="Thumbnail" /></a></li>
                   <li><a data-target="#pic-5" data-toggle="tab"><img src="img/img-tom.png" alt="Thumbnail" /></a></li>
                </ul> -->
            </div>
            <div class="details col-md-6">
                <div class="w-100 clearfix img-area mb-3">
                    @if(($product->getUser))
                        @if($product->getUser->profile_photo != '')
                            <img class="float-left " src="{{asset($product->getUser->profile_photo)}}"
                                 alt="{{$product->getUser->name}}">
                            <span class="float-left">{{$product->getUser->name}} </span>
                        @endif
                    @else
                        <img class="float-left " src="{{asset('public/frontend_updated/img/img-hassayampa.png')}}"
                             alt="Added By Admin">
                        <span class="float-left">By Admin</span>
                    @endif

                    @php
                        $name = strlen($product->name);
                        if ($name > 44)
                        {
                        $product_name =substr($product->name, 0,40);
                        $product_name = $product_name.'....';
                        }
                        else
                        {
                        $product_name= $product->name;
                        }
                    @endphp
                </div>
                <h2 class="product-title">{{$product_name}}</h2>
                <div class="rating row ml-0 mr-0 mb-3">
                    {{-- <div id="rateYo"></div> --}}
                 <ul class="rating">
                            @if(count($product->getRatings) > 0)
                                @include('frontend.layouts.ratings', ['ratings' => $product->getRatings->avg('rating')])
                            @else
                                <li class="fa fa-star disable"></li>
                                <li class="fa fa-star disable"></li>
                                <li class="fa fa-star disable"></li>
                                <li class="fa fa-star disable"></li>
                                <li class="fa fa-star disable"></li>
                            @endif
                        </ul>
                    @if($product->getRatings)
                        <span class="review-no">{{$product->getRatings->count()}} reviews</span>
                    @else
                        <span class="review-no">0 reviews</span>
                    @endif
                    <button type="button" class="btn btn-link btn-rate" data-toggle="modal" data-target="#ratingModal">Rate
            Now!</button>

                </div>
                <dl class="row">
{{--                    <dt class="col-3 mb-3">Shipping</dt>--}}
{{--                    <dd class="col-9 mb-3">Free Shipping to Unated Stades</dd>--}}
                    <dt class="col-3 mb-3">Weight</dt>
                    @if($product->getUnitDetail)
                    <dd class="col-9 mb-3">{{$product->getUnitDetail->name}}</dd>
                    @else
                        <dd class="col-9 mb-3">N/A</dd>
                    @endif
                    <dt class="col-3 mb-3 txt-dt">Quantity</dt>
                    <dd class="col-9 mb-3">
                        <div class="def-number-input number-input safari_only">
                            <button id="descreaseQuantity"
                                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                    class="minus"></button>
                            <input class="quantity" min="1" name="quantity" value="1" id="quantity" type="number">
                            <button id="increaseQuantity"
                                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                    class="plus"></button>
                        </div>
                    </dd>

                    <dt class="col-3 mb-3">Total</dt>
                    <input type="hidden" id="product_original_price" value="{{number_format(Cart::total(),2)}}">
                    <span id="product_price_span">
                                            <dd class="col-9 mb-3 txt-amount" id="product_price"
                                                data-current_quantity="1"
                                                data-product_price="{{number_format(Cart::total(),2)}}">${{number_format(Cart::total(),2)}}</dd>

                    </span>
                </dl>
                <input type="hidden" id="current_cart_total" value="{{Cart::total()}}">
                <input type="hidden" id="current_product_price" value="{{number_format($product->price,2)}}">
                <div class="w-100 mb-4 btn-holder">
                    <button onclick='return addToCart("{{$product->id}}", "{{$product->name}}", "{{$product->price}}")'
                            class="btn btn-dark btn-cart" role="button"><img
                            src="{{asset('public/frontend_updated/img/ico-cart.png')}}" alt="Cart Icon">
                        Add To Cart
                    </button>
                    @if(Auth::guard('user')->check())
                        @php $user_id = Auth::guard('user')->user()->id; @endphp
                    <button href="" onclick='return addToFavourite("{{$product->id}}", "{{$user_id}}")' class="btn btn-heart" role="button"><img
                            src="{{asset('public/frontend_updated/img/img-heart.png')}}" alt="img-heart"></button>
                    @else
                        <a href="#"  data-toggle="modal" data-target="#loginModal" class="btn btn-heart" role="button"><img
                                src="{{asset('public/frontend_updated/img/img-heart.png')}}" alt="img-heart"></a>
                    @endif
                </div>
                <ul class="nav nav-pills mb-3 text-dark tabs-wrap" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link text-dark active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                           role="tab" aria-controls="pills-home" aria-selected="true">Product Discription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                           role="tab" aria-controls="pills-profile" aria-selected="false">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" id="pills-contact-tab" data-toggle="pill" href="#pills-contact"
                           role="tab" aria-controls="pills-contact" aria-selected="false">Total Quantity</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                         aria-labelledby="pills-home-tab">
                        <p>{!! $product->description !!}</p>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        @if (isset($product->getCategory))
                         <p>{{ $product->getCategory->name }}</p>
                            
                        @endif
                       
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <p>{{ $product->quantity }}</p>
                     
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Fresh Deals Section Starts..  -->
    <div class="w-100 bg-lightGrey pt-5 pb-5 sec-freshDeals">
        <div class="container container-custom pt-3">
            <h2 class="w-100 text-center">Fresh Deals</h2>
            <p class="txt-info">Big savings on expertly curated seasonal items and favorite brands.</p>
            <div class="col-12" id="slider">

                @if(count($fresh_products) > 0)
                    @foreach($fresh_products as $fresh_product)
                <div class="col-lg-3 col-md-6 col-12 px-1 px-sm-3 d-flex justify-content-stretch mb-5">
                    <div class="product-grid">
                        <div class="product-image w-100">
                            <a href="{{route('product.detail',['slug'=>$fresh_product->slug])}}" class="mb-3">
                                @if(isset($fresh_product->getFeaturedImage) && !empty($fresh_product->getFeaturedImage))
                                @if($fresh_product->getFeaturedImage->path != '')
                                    <img class="pic-1" src="{{asset($fresh_product->getFeaturedImage->path)}}" alt="Image Corn">
                                    @endif
                                @else
                                    <img class="pic-1" src="{{asset('public/frontend_updated/img/img-corn.png')}}"
                                         alt="Image Not Found">
                                @endif



                            </a>
                            @if(($fresh_product->getUser))
                                @if($fresh_product->getUser->profile_photo != '')
                                    <span class="d-block img-capt p-2"><img class="float-left"
                                                                            src="{{asset($fresh_product->getUser->profile_photo)}}"
                                                                            alt="{{$fresh_product->getUser->name}}">{{$fresh_product->getUser->name}}</span>
                                @endif
                            @else
                                <span class="d-block img-capt p-2"><img class="float-left"
                                                                        src="{{asset('public/frontend_updated/img/img-hassayampa.png')}}"
                                                                        alt="Image Hassayampa"> By Admin</span>
                            @endif
                        </div>
                        <div class="product-content clearfix">
                            <div class="price">
                                <p>{{$fresh_product->name}}</p>
                                <p>${{number_format($fresh_product->price,2)}}/each</p>
                            </div>
                            <ul class="rating">
                                @if(count($fresh_product->getRatings) > 0)
                                    @include('frontend.layouts.ratings', ['ratings' => $fresh_product->getRatings->avg('rating')])
                                @else
                                    <li class="fa fa-star disable"></li>
                                    <li class="fa fa-star disable"></li>
                                    <li class="fa fa-star disable"></li>
                                    <li class="fa fa-star disable"></li>
                                    <li class="fa fa-star disable"></li>
                                @endif
                            </ul>
                            <p class="text-center stats-rating">({{number_format($fresh_product->getRatings->avg('rating'),2)}}) <span>{{$fresh_product->getRatings->count()}}</span></p>
                            <button type="button" class="btn add-to-cart" onclick='addToCart("{{$fresh_product->id}}", "{{$fresh_product->name}}", "{{$fresh_product->price}}")'>Add To Cart</button>
                        </div>
                    </div>
                </div>
                    @endforeach
                    @endif

            </div>
        </div>
    </div>
    {{-- prooduct reviews modal --}}
      <div class="modal fade" id="ratingModal" role="dialog" tab-index="-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h3 class="modal-title">How much you like this product?</h3>
          <button type="button" class="close" data-dismiss="modal"><img src="{{ asset('public/frontend_updated/img/close-icon.png') }}"></button>
        </div>
        <div class="modal-body">

          <p>Select Rating: <span id="rateYo"></span></p>
          <form>
            <div class="form-group">
              <label>Write Review</label>
              <textarea class="form-control textarea" rows="10" cols="10"></textarea>
            </div>
            <button type="submit" class="btn btn-primary ml-auto">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('download_app')
    @include('frontend.download_app')
@endsection
@section('javascript')
    <script>
        function addToFavourite(p_id, user_id)
        {
            $.ajax({
               url:"{{route('product.add_to_favourite')}}",
                data: {
                   'user_id':user_id,
                    'p_id':p_id,
                    'type': 'product',
                },
                success:function(result)
                {
                    showNotification(result.message);

                },
                error:function(err)
                {

                }
            });

        }
    </script>

    <script>
        function addToCart(id, name, price) {

            var current_quantity_of_product = parseInt($('#product_price').data('current_quantity'));
            var product_price = parseFloat(price);
            var product_original_price = parseFloat($('#product_original_price').val());
            product_price = product_price.toFixed(2);
            $.ajax({
                url: "{{route('product.add_to_cart')}}",
                data: {
                    'id': id,
                    'name': name,
                    'price': product_price,
                    'quantity': current_quantity_of_product,
                },
                success: function (result) {
                    if (result.status) {

                        // var cart_total = parseFloat($('#cart_total').data('total'));
                        // var count = parseFloat($('#cart_count').data('count'));
                        // current_quantity += count;
                        // var total = parseFloat(product_original_price * current_quantity);
                        current_quantity =result.cart_total_item;
                        var total = result.cart_total;
                        $('#cart_count_and_total').empty();
                        $('#cart_count_and_total').html(`<span id="cart_count" data-count="` + current_quantity + `">` + current_quantity + `</span>  -  $<span id="cart_total" data-total="` + total + `">` + total + `</span> USD`);
                        $('#product_price_span').html(`<dd class="col-9 mb-3 txt-amount" id="product_price" data-current_quantity= "` + current_quantity_of_product + `"  data-product_price="` + total + `">$` + total + `</dd>`);
                        //show notificatoin
                        showNotification(result.message);
                    }

                }
            });


        }
    </script>

    <script>
        $('.dropdown-menu a').click(function () {
            $('a.dropdown-toggle').text($(this).text());
            $('a.dropdown-toggle').val($(this).text()).addClass('add')
                .append('<i class="fas fa-chevron-down"></i>');
        });

        //slick slider initiator
        $(document).ready(function () {
            var current_quantity = parseInt($('#product_price').data('current_quantity'));
            var current_product_price = parseFloat($('#current_product_price').val());
            $("#descreaseQuantity").click(function () {
                var current_product_price = parseFloat($('#current_product_price').val());
                var current_cart_total = parseFloat($('#current_cart_total').val());
                if (current_cart_total > current_product_price) {

                    current_quantity--;
                    var current_total  = current_cart_total -  current_product_price;
                    ($('#current_cart_total').val(current_total));
                    $('#product_price_span').html(`<dd class="col-9 mb-3 txt-amount" data-current_quantity= "` + current_quantity + `" id="product_price" data-product_price="` + current_total.toFixed(2) + `">$` + current_total.toFixed(2) + `</dd>`);
                }
            });

            $("#increaseQuantity").click(function () {

                var current_cart_total = parseFloat($('#current_cart_total').val());
                current_quantity++;
                var current_total  = current_cart_total +  current_product_price;
                $('#product_price_span').html(`<dd class="col-9 mb-3 txt-amount" id="product_price" data-current_quantity= "` + current_quantity + `"  data-product_price="` + current_total.toFixed(2) + `">$` + current_total.toFixed(2) + `</dd>`);
                ($('#current_cart_total').val(current_total));
            });

            $('#slider').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: false,
                autoplaySpeed: 2000,
                arrows: true,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 990,
                        settings: {
                            centerPadding: '20px',
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            centerPadding: '10px',
                            mobileFirst: true,
                            centerMode: true,
                            slidesToShow: 1
                        }
                    }
                ],
                prevArrow: "<button type='button' class='slick-prev pull-left'><img src={{asset('public/frontend_updated/img/shape-left.png')}} alt='angle-previous'></button>",
                nextArrow: "<button type='button' class='slick-next pull-right'><img src={{asset('public/frontend_updated/img/stre-right.png')}} alt='angle-right'></button>",

            });

            $('.slider-for').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: true,
                centerPadding: '20px',
                arrows: false,
                fade: true,
                asNavFor: '.slider-nav'
            });
            $('.slider-nav').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                asNavFor: '.slider-for',
                dots: true,
                centerMode: true,
                focusOnSelect: true
            });


            $(function () {
                $("#rateYo").rateYo({
                    starWidth: "21px",
                    rating: 4.5,
                    spacing: "5px",
                    maxValue: 5,
                    numStars: 5,
                    multiColor: {

                        "startColor": "#ffa34d"
                    }
                });
            });
        });
    </script>


@endsection
