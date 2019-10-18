@extends('frontend.layout')
@section('banner')
    <!-- include banner for index page -->
    @include('frontend.banner')
    @endsection
@section('content')
    <!-- Explore Category Section Starts.. -->
    <section class="container container-custom pt-5">
        <div class="row">
            <div class="container container-custom sec-category pb-5">
                <h2 class="mt-3 mb-5 text-center">Explore Categories</h2>
                <div class="w-100">
                    <div class="row">
                        <ul class="list-inline text-center list-categories w-100">
                            @if($explore_categories != '')
                                @foreach($explore_categories as $category)
                                    <li class="list-inline-item">
                                        <div class="clearfix mb-3">
                                            @if($category->image_path != '')
                                                <a href="{{route('category.show', ['slug'=>$category->slug])}}">
                                                    <img src="{{  asset($category->image_path)}}" alt="{{$category->name}}">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="w-100 text-center">
                                            <h3>{{$category->name}}</h3>
                                            <p><i class="fas fa-plus"></i> {{$category->countCategoryProducts->count()}}
                                                Products</p>
                                        </div>
                                    </li>

                                @endforeach
                            @endif
                        </ul>
                                <div class="w-100 clearfix pt-5">
                                             <form class="form-inline col-xl-8 col-lg-9 col-12 m-auto search-form" action="{{route('search_product_by_name')}}" method="get">
                                           <div class="input-group col-lg-8 col-sm-12 col-12 p-0 mb-lg-0 mb-3">
                                    <input type="search" class="form-control searchBox" name="product" aria-label="Text input with dropdown button" placeholder="Search items..">
                                    {{-- <input type="hidden" class="form-control searchBox" name="_token" value="{{csrf_token()}}" aria-label="Text input with dropdown button" placeholder="Search items.."> --}}
<!--                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select Location</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Pakistan</a>
                                            <a class="dropdown-item" href="#">Afghanistan</a>
                                            <a class="dropdown-item" href="#">China</a>
                                            <div role="separator" class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Separated link</a>
                                        </div>
                                    </div>-->
                                </div>
                                <button type="submit" class="btn btn-primary text-uppercase pl-5 pr-5 ml-lg-2">search now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Farm Fresh Deals Starts.. -->
    <section class="container container-custom pt-md-5 pt-3 sec-deals pb-md-5 pb-3">
        <h2 class="text-center">Top Recent Listings</h2>
        <p class="text-center mb-5 txt-info">Big savings on expertly curated seasonal items and favorite brands.</p>
        <ul class="list-inline indexProd" id="product_row">
            @if(count($products) > 0)
                @foreach($products as $product)
            <li class="list-inline-item">
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
                    </div>
                </div>
            </li>
                @endforeach
                    <button type="button" class="btn btn-primary m-auto d-flex flex-row btn-loadMore" data-next="{{$products->currentPage() +1}}"><i class="fas fa-spinner text-white mt-1 mr-2"></i> Load more</button>
            @endif

        </ul>
    </section>
    <!-- Top Rated Farm Starts.. -->
    <section class="w-100 sec-rated pt-5 pb-5">
        <div class="container">
            <div class="row">
                <h2 class="w-100 mb-3 text-center mt-3">Top Rated Farms</h2>
                <p class="pb-2 text-center txt-info m-auto">Big savings on expertly curated seasonal items and favorite brands.</p>
                <div class="your-class w-100 row m-0 pt-5">
                    @foreach($farmers as $farmer)
                    <div class="bg-white rounded shadow ml-3 slide-slick"><img class="align-middle d-inline-block" src="{{asset($farmer->profile_photo)}}" alt="{{$farmer->name}}"></div>

                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
@section('download_app')
    @include('frontend.download_app')
@endsection
@section('javascript')

    <script>
        $(document).on('click', '.btn-loadMore', function(){
            var btnMoreLoad = $('.btn-loadMore');
            var btnMoreLoadPageNo = parseInt($(btnMoreLoad).data('next'));

            $.ajax({
                url: "{{ route('ajax.load_more_products') }}",
                data: {'page': btnMoreLoadPageNo},
                success: function(result){
                    btnMoreLoad.remove();
                    $('#product_row').append(result);
                    //console.log('res:' +result);
                }
            });
        });
    </script>
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
    </script>


@endsection
