@extends('frontend.layout')
@section('content')
<section class="banner-cart pt-5 pb-5">
        <div class="container">
            <h2>Wishlist Products</h2>
            <p>Banjo tote bag bicycle rights, High Life sartorial cray craft beer whatever street art fap.</p>
        </div>
    </section>
    <main role="content" class="container container-custom pd-cont">
        <div class="row">
            <ul class="list-unstyled indexProd row m-0" id="ul_of_products">
                @php
                            $user_id = Auth::guard('user')->user()->id;
                        @endphp
                @if(count($products) > 0)
                @foreach($products as $product)
                <li class="col-lg-3 col-md-4 col-sm-6" id="product-{{ $product->id }}">
                    <div class="product-grid">
                        <div class="product-image w-100">
                            <a href="{{route('product.detail',['slug'=>$product->slug])}}" class="mb-3">
                            @if(isset($product->getFeaturedImage) && !empty($product->getFeaturedImage))
                            @if($product->getFeaturedImage->path != '')
                                <img class="pic-1" src="{{ asset($product->getFeaturedImage->path)}}" alt="Image Corn">

                            @endif
                            @else
                                <img class="pic-1" src="{{asset('public/frontend_updated/img/img-corn.png')}}"
                                     alt="Image Not Found">
                            @endif
                        </a>
                        @if(($product->getUser))
                            @if($product->getUser->profile_photo != '')
                                <span class="d-block img-capt p-2"><img class="float-left"
                                                                        src="{{ asset($product->getUser->profile_photo)}}"
                                                                        alt="{{$product->getUser->name}}">{{$product->getUser->name}}</span>
                            @endif
                        @else
                            <span class="d-block img-capt p-2"><img class="float-left"
                                                                    src="{{ asset('public/frontend_updated/img/img-hassayampa.png')}}"
                                                                    alt="Image Hassayampa"> By Admin</span>
                        @endif
                        </div>
                        <div class="product-content clearfix">
                            <div class="price">
                               <p>{{$product->name}}</p>
                            <p>${{number_format($product->price,2)}}/each</p>
                            </div>
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
                                                    <p class="text-center stats-rating">({{number_format($product->getRatings->avg('rating'),2)}}) <span>{{$product->getRatings->count()}}</span></p>
                        <button type="button" class="btn add-to-cart" onclick='addToCart("{{$product->id}}", "{{$product->name}}", "{{$product->price}}")'>Add To Cart</button>
                        <button type="button" class="btn btn-heart"><img src="{{ asset('public/frontend_updated/img/img-heart.png') }}" alt="Icon Heart"></button>
                        <button type="button" onclick='removeFromFavorite("{{ $product->id }}", "{{ $user_id }}")' class="btn btn-dislike"><img src="{{ asset('public/frontend_updated/img/ico-dislike.png') }}" alt="Icon Dislike"></button>

                        </div>
                    </div>
                </li>
                @endforeach
                @else 
                <li>No Product Found</li>
                @endif
               
            </ul>
        </div>
    </main>

@endsection
@section('download_app')
    @include('frontend.download_app')
@endsection
@section('javascript')
    

    <script>
        function addToCart(id, name, price, quantity=1)
        {
            var product_price = parseFloat(price);
            product_price = product_price.toFixed(2);
            $.ajax({
                url: "{{route('product.add_to_cart')}}",
                data:{
                    'id':id,
                    'name':name,
                    'price':product_price,
                    'quantity':quantity,
                },
                success:function (result) {
                    if (result.status) {
                        current_quantity =result.cart_total_item;
                        var total = result.cart_total;
                        $('#cart_count_and_total').empty();
                        $('#cart_count_and_total').html(`<span id="cart_count" data-count="` + current_quantity + `">` + current_quantity + `</span>  -  $<span id="cart_total" data-total="` + total + `">` + total + `</span> USD`);

                        //show notificatoin
                        showNotification(result.message);
                    }

                }
            });


        }
        function removeFromFavorite (product_id_str, user_id_str) {
            var product_id = parseInt(product_id_str);
            var user_id = parseInt(user_id_str);
            
            $.ajax({
                url:"{{ route('product.remove_form_favorite') }}",
                data:{
                    'product_id':product_id,
                    'user_id':user_id
                },
                success:function(result)
                {
                    //remove from list
                    
            $('#product-'+product_id).remove();
            if ($('#ul_of_products li').length == 0)
            {
            $("#ul_of_products").append('<li>No Product Found <a href="{{ route('user.home') }}">Home</a></li>');
            }
            showNotification(result.message);

                },
                error:function(error)
                {
                    showNotification(result.message);

                }
            });

          }
    </script>


@endsection
