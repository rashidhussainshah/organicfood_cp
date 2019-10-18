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
                                                                    src="{{asset($product->getUser->profile_photo)}}"
                                                                    alt="{{$product->getUser->name}}">{{$product->getUser->name}}</span>
                        @endif
                    @else
                        <span class="d-block img-capt p-2"><img class="float-left"
                                                                src="{{asset('public/frontend/img/img-hassayampa.png')}}"
                                                                alt="Image Hassayampa"> By Admin</span>
                    @endif
                </div>
                <div class="product-content clearfix">
                    <div class="price">
                        <p>{{$product->name}}</p>
                        <p>${{$product->price}}/each</p>
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

@else
    <button type="button" class="btn btn-primary m-auto d-flex flex-row btn-loadMore" disabled><i class="fas fa-spinner text-white mt-1 mr-2"></i> No Product</button>

@endif
