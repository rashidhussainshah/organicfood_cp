<div class="row">
                                <ul class="list-inline indexProd">
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
                                    @endif
                               
                                </ul>
                            </div>
                            <div class="pagination-wrapper w-100 row m-0">
                                    <div class="wrap-paging">
                                         {{ $products->links() }}
                                        {{--  <ul class="pagination">
                                            <li class="page-item">
                                                <a class="page-link" href="#"><img src="{{asset('public/frontend_updated/img/btn-prevPage.png')}}" alt="pagination-arrow-left"></a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#"><img src="{{asset('public/frontend_updated/img/arrow-left.png')}}" alt="pagination-arrow-prev"></a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#"><img src="{{asset('public/frontend_updated/img/arrow-right.png')}}" alt="pagination-arrow-right"></a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="#"><img src="{{asset('public/frontend_updated/img/btn-nextPage.png')}}" alt="pagination-arrow-right"></a>
                                            </li>
                                        </ul>  --}}
                                    </div>
                                    <div class="select-page">
                                          <form class="form-inline">
                                <label>Results per page</label>
                                <select onchange="changeResultPerPage();" id="per_page" class="custom-select input-lg">
                                    @if (isset($per_page))
                                     
                                    <option id="{{$per_page}}" value="10" @if($per_page == 10) selected @endif>10</option>
                                    <option value="15" @if($per_page == 15) selected @endif>15</option>
                                    <option value="20" @if($per_page == 20) selected @endif>20</option>
                                    <option value="25" @if($per_page == 25) selected @endif >25</option>   
                                    @else
                               
                                    <option value="10" selected>10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    @endif
                                </select>
                                <i class="fa fa-chevron-down"></i>
                            </form>
                                    </div>
                            </div>