<<<<<<< HEAD
@extends('frontend.layout')
@section('content')
@endsection
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId=968927866783971&autoLogAppEvents=1"></script>

<input type="hidden" id="farmer_id" value="{{ $farmer_id }}">
<input type="hidden" id="farmer_profie_address" value="{{ $former_profile_link }}">
<main role="content" class="w-100">
        <div class="w-100">
            <img src="{{asset('public/frontend_updated/img/img-farm.jpg')}}" alt="Image Farm">
        </div>
        <div class="container container-custom">
            <div class="row clearfix farm-fav pt-4 pb-3">
                <div class="col-lg-2 col-12 left-align">
                    @if ($form->profile_photo != '')
                        <img src="{{asset($form->profile_photo)}}" alt="Image Hassayampa">
                    @else
                        <img src="{{asset('public/frontend_updated/img/img-hassayampa.png')}}" alt="Image Hassayampa">
                    @endif
                    
                </div>
                <div class="col-lg-10 col-12 right-align">
                    <div class="row">
                        <div class="col-md-7 col-12 farm-block">
                            <h2 class="w-100 mb-2">{{ $form->name }}</h2>
                            <p>
                                <span class="w-50 d-inline-block"><img src="{{asset('public/frontend_updated/img/ico-marker.png')}}" alt="image marker"> {{ $farmer_main_loc }}</span>
                                {{--  <span class="w-25 d-inline-block"><img src="{{asset('public/frontend_updated/img/icons8-bug.png')}}" alt="Image Description"> Report</span>  --}}
                            </p>
                        </div>
                        <div class="col-md-5 col-12 row wrap-social">
                            <ul class="social-networks list-inline">
                                <li class="list-inline-item"><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ $former_profile_link }}" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                                <li class="list-inline-item"><a href="http://twitter.com/share?text=text&url={{ $former_profile_link  }}"><i class="fab fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="javascript:fbshareCurrentPage()" ><i class="fab fa-facebook-f"></i></a></li>
                                {{-- <li class="list-inline-item"><div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div></li> --}}
                            </ul>
                             @if(Auth::guard('user')->check())
                                @if ($already_favorite)
                                     <button onclick='return addFormToFavorite("{{$user_id}}", "{{$form->id}}")' type="button" class="btn btn-light btn-fav"><img src="{{asset('public/frontend_updated/img/img-heart.png')}}" alt="Image Heart"> Favorite</button>
                                @else
                                    @php $user_id = Auth::guard('user')->user()->id; @endphp
                        <button  onclick='return addFormToFavorite("{{$user_id}}", "{{$form->id}}")' type="button" class="btn btn-light btn-fav"><img src="{{asset('public/frontend_updated/img/img-heart.png')}}" alt="Image Heart"> Favorite this farm</button>
                                @endif
                        
                    @else
                        {{-- <a href="#"  data-toggle="modal" data-target="#loginModal" class="btn btn-heart" role="button"><img
                                src="{{asset('public/frontend_updated/img/img-heart.png')}}" alt="img-heart"></a> --}}
                                <button data-toggle="modal" data-target="#loginModal"  type="button" class="btn btn-light btn-fav"><img src="{{asset('public/frontend_updated/img/img-heart.png')}}" alt="Image Heart"> Favorite this farm</button>
                    @endif
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix tabs-area">
                <nav class="nav nav-tabs w-100" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-products-tab" data-toggle="tab" href="#nav-products" role="tab" aria-controls="nav-products" aria-selected="true">
                        <img class="plain-img" src="{{asset('public/frontend_updated/img/ico-product.png')}}" alt="Icon Product">
                        <img class="hover-img" src="{{asset('public/frontend_updated/img/hover-product.png')}}" alt="Icon Product"> Products <span id="total_products">({{ $products->total() }})</span>
                    </a>
                    <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">
                        <img class="plain-img" src="{{asset('public/frontend_updated/img/ico-info.png')}}" alt="Icon info">
                        <img class="hover-img" src="{{asset('public/frontend_updated/img/hover-about.png')}}" alt="Icon info"> About Farm
                    </a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">
                        <img class="plain-img" src="{{asset('public/frontend_updated/img/ico-contact.png')}}" alt="Icon contact"><img class="hover-img" src="{{asset('public/frontend_updated/img/hover-contact.png')}}" alt="Icon contact">
                        Contact Form
                    </a>
                </nav>
                <div class="tab-content w-100 pt-3" id="nav-tabProducts">
                    <div class="tab-pane active" id="nav-products">
                        <!-- Farm Fresh Deals Starts.. -->
                        <section class="w-100 pt-md-3 pt-3 sec-deals pb-md-5 pb-3">
                            <div class="row m-0">
                                <div class="w-100 clearfix pb-3">
                                    <form class="form-inline search-form add" action="#">
                                        <div class="col-xl-8 col-lg-9 col-md-9 col-12 mb-2 pl-md-0">
                                            <div class="row m-0">
                                                <input type="search" class="form-control searchBox col-lg-9 col-md-8 col-12" id="inputsearch" placeholder="Search items..">
                                                <button type="submit" class="btn btn-primary mb-2 search-btn ml-3">Search</button>
                                            </div>
                                        </div>
                                        {{--  <div class="col-md-3 col-12 ml-md-auto text-right pr-md-0">
                                            <select class="custom-select">
                                                <option selected="">Shop By</option>
                                                <option value="products">Products</option>
                                                <option value="products">Products</option>
                                            </select>
                                        </div>  --}}
                                    </form>
                                </div>
                            </div>
                            {{--  product listing start div  --}}
                           <div id="product_listing">
                            <div class="row" id="product_listing">
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
                           </div>
                           {{--  end product listing div  --}}
                        </section>
                    </div>
                    <div class="tab-pane" id="nav-about">
                        <div class="row pt-4">
                            <aside class="aside col-md-2 col-12 aside-block tabs-about">
                                <ul class="list-unstyled">
                                    <li><a href="#">About</a></li>
                                    <li><a href="#">Delivery</a></li>
                                    <li><a href="#">Returns &amp; exchanges</a></li>
                                </ul>
                            </aside>
                            <article class="col-md-9 col-12 tab-block">
                                <h2 class="mb-3">Locations</h2>
                            <p><i class="fas fa-map-marker-alt text-primary mr-2"></i>{{$farmer_main_loc}}</p>

                                @if(isset($farmer_locations))
                                @foreach($farmer_locations as $loc)
                            <p><i class="fas fa-map-marker-alt text-primary mr-2"></i>{{$loc->address}}</p>
                                @endforeach
                                @endif
                               
                                {{-- <p><i class="fas fa-map-marker-alt text-primary mr-2"></i>788 Kaylin Street</p> --}}
                                <h2 class="mt-5 mb-3">About Farm</h2>
                                {{-- <p class="mb-4">We all have those moments in our lives when we feel as if everything needs to be exactly right. It is these moments that we often refer to as special occasions. When it comes to cooking for special occasions, many of us find that we drop the ball in our anticipation and feel as though we have ruined the moment. While this is often far from the truth, it does serve to diminish the moment in many of our minds. For this reason, you need to work up a repertoire, if you will, of simple to make special occasion cooking recipes. You will be shocked and amazed at all the sinfully rich and delicious meals and side dishes that are out there, that are amazingly quick and easy to prepare. This means that you will not run the all too common disaster scenarios that you hear about and will still manage to have a wonderful meal that is enjoyed by all. The trick is in choosing a rather simple meat dish and dressing it up with the more decadent side dishes.</p>
                                <p class="mb-4">Incredibly rich side dishes that are simple to prepare are greater in number than meat dishes that require little culinary effort. You should also keep in mind the audience for your special occasion. Sometimes a family favorite makes the occasion seem much more special than an all out effort for chicken cordon bleu or veal Marsala. There is no point in going to an extreme effort to create a culinary masterpiece if it is going to be riddled with picky children proclaiming that they do not like this or that about your meal.</p>
                                <p class="txt-greet">Enjoy eating fresh food! :)</p>
                                <p>Thank you!</p> --}}
                                <p class="mb-4">
                                    {!! $farmer_about  !!}
                                </p>
                                
                            </article>
                        </div>
                    </div>
                    <div class="tab-pane w-100" id="nav-contact">
                        <form class="form w-100 pt-4 form-contact pl-1 pr-1 pb-5">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="inputName">Name<sup>*</sup></label>
                                    <input type="text" class="form-control form-control-lg" id="inputName" placeholder="" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail">Email<sup>*</sup></label>
                                    <input type="email" class="form-control form-control-lg" id="inputEmail" placeholder="" required="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="inputPhone">Phone</label>
                                    <input type="tel" class="form-control form-control-lg" id="inputPhone" placeholder="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputWeb">Website</label>
                                    <input type="text" class="form-control form-control-lg" id="inputWeb" placeholder="">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="inputWeb">Text input</label>
                                <textarea class="form-control form-control-lg" id="exampleFormControlTextarea1" rows="3" placeholder="Text"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-send">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@section('download_app')
    @include('frontend.download_app')
@endsection
@section('javascript')
<script>
    function addFormToFavorite(user_id, form_id)
        {
            $.ajax({
               url:"{{route('form.add_form_to_fav')}}",
                data: {
                   'user_id':user_id,
                    'form_id':form_id,
                    'type': 'form',
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
        function changeResultPerPage() {
            var per_page =$('#per_page').val();
            var farmer_id =parseInt($('#farmer_id').val());
                $.ajax({
                    url:"{{route('ajax.get_per_page_prodcuts_for_farmer_page')}}",
                   type:"post",
                    data:{
                        '_token': '<?= csrf_token()?>',
                        'per_page':per_page,
                        'farmer_id':farmer_id,
                    },
                    success:function (result) {
                        $('#product_listing').empty();
                        $('#product_listing').append(result);
                    },
                    error:function (error) {

                    }
                });
                   }
        </script>
    <script language="javascript">
    function fbshareCurrentPage()
    {
        var farmer_profie_address = $('#farmer_profie_address').val();
        var win = window.open("https://www.facebook.com/sharer/sharer.php?u="+encodeURIComponent(farmer_profie_address)+"&t="+document.title, '_blank');
        if (win) {
            //Browser has allowed it to be opened
            win.focus();
        } else {
            //Browser has blocked it
            alert('Please allow popups for this website');
        }
    
    }
</script>

=======
@extends('frontend.layout')
@section('content')
@endsection
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId=968927866783971&autoLogAppEvents=1"></script>

<input type="hidden" id="farmer_id" value="{{ $farmer_id }}">
<input type="hidden" id="farmer_profie_address" value="{{ $former_profile_link }}">
<main role="content" class="w-100">
  @if(session()->has('contact_message'))
<!--    <div id="successMessage" class="alert alert-success">
        {{ session()->get('success') }}
    </div>-->
<input type="hidden" id="message" value="{{session('contact_message')}}">
@endif
  
    <div class="w-100">
            <img src="{{asset('public/frontend_updated/img/img-farm.jpg')}}" alt="Image Farm">
        </div>
        <div class="container container-custom">
            <div class="row clearfix farm-fav pt-4 pb-3">
                <div class="col-lg-2 col-12 left-align">
                    @if ($form->profile_photo != '')
                        <img src="{{asset($form->profile_photo)}}" alt="Image Hassayampa">
                    @else
                        <img src="{{asset('public/frontend_updated/img/img-hassayampa.png')}}" alt="Image Hassayampa">
                    @endif
                    
                </div>
                <div class="col-lg-10 col-12 right-align">
                    <div class="row">
                        <div class="col-md-7 col-12 farm-block">
                            <h2 class="w-100 mb-2">{{ $form->name }}</h2>
                            <p>
                                <span class="w-50 d-inline-block"><img src="{{asset('public/frontend_updated/img/ico-marker.png')}}" alt="image marker"> {{ $farmer_main_loc }}</span>
                                {{--  <span class="w-25 d-inline-block"><img src="{{asset('public/frontend_updated/img/icons8-bug.png')}}" alt="Image Description"> Report</span>  --}}
                            </p>
                        </div>
                        <div class="col-md-5 col-12 row wrap-social">
                            <ul class="social-networks list-inline">
                                <li class="list-inline-item"><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ $former_profile_link }}" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                                <li class="list-inline-item"><a href="http://twitter.com/share?text=text&url={{ $former_profile_link  }}"><i class="fab fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="javascript:fbshareCurrentPage()" ><i class="fab fa-facebook-f"></i></a></li>
                                {{-- <li class="list-inline-item"><div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div></li> --}}
                            </ul>
                            <button type="button" class="btn btn-light btn-fav"><img src="{{asset('public/frontend_updated/img/img-heart.png')}}" alt="Image Heart"> Favorite this farm</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix tabs-area">
                <nav class="nav nav-tabs w-100" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-products-tab" data-toggle="tab" href="#nav-products" role="tab" aria-controls="nav-products" aria-selected="true">
                        <img class="plain-img" src="{{asset('public/frontend_updated/img/ico-product.png')}}" alt="Icon Product">
                        <img class="hover-img" src="{{asset('public/frontend_updated/img/hover-product.png')}}" alt="Icon Product"> Products <span id="total_products">({{ $products->total() }})</span>
                    </a>
                    <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">
                        <img class="plain-img" src="{{asset('public/frontend_updated/img/ico-info.png')}}" alt="Icon info">
                        <img class="hover-img" src="{{asset('public/frontend_updated/img/hover-about.png')}}" alt="Icon info"> About Farm
                    </a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">
                        <img class="plain-img" src="{{asset('public/frontend_updated/img/ico-contact.png')}}" alt="Icon contact"><img class="hover-img" src="{{asset('public/frontend_updated/img/hover-contact.png')}}" alt="Icon contact">
                        Contact Form
                    </a>
                </nav>
                <div class="tab-content w-100 pt-3" id="nav-tabProducts">
                    <div class="tab-pane active" id="nav-products">
                        <!-- Farm Fresh Deals Starts.. -->
                        <section class="w-100 pt-md-3 pt-3 sec-deals pb-md-5 pb-3">
                            <div class="row m-0">
                                <div class="w-100 clearfix pb-3">
                                    <form class="form-inline search-form add" action="#">
                                        <div class="col-xl-8 col-lg-9 col-md-9 col-12 mb-2 pl-md-0">
                                            <div class="row m-0">
                                                <input type="search" class="form-control searchBox col-lg-9 col-md-8 col-12" id="inputsearch" placeholder="Search items..">
                                                <button type="submit" class="btn btn-primary mb-2 search-btn ml-3">Search</button>
                                            </div>
                                        </div>
                                        {{--  <div class="col-md-3 col-12 ml-md-auto text-right pr-md-0">
                                            <select class="custom-select">
                                                <option selected="">Shop By</option>
                                                <option value="products">Products</option>
                                                <option value="products">Products</option>
                                            </select>
                                        </div>  --}}
                                    </form>
                                </div>
                            </div>
                            {{--  product listing start div  --}}
                           <div id="product_listing">
                            <div class="row" id="product_listing">
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
                           </div>
                           {{--  end product listing div  --}}
                        </section>
                    </div>
                    <div class="tab-pane" id="nav-about">
                        <div class="row pt-4">
                            <aside class="aside col-md-2 col-12 aside-block tabs-about">
                                <ul class="list-unstyled">
                                    <li><a href="#">About</a></li>
                                    <li><a href="#">Delivery</a></li>
                                    <li><a href="#">Returns &amp; exchanges</a></li>
                                </ul>
                            </aside>
                            <article class="col-md-9 col-12 tab-block">
                                <h2 class="mb-3">Locations</h2>
                            <p><i class="fas fa-map-marker-alt text-primary mr-2"></i>{{$farmer_main_loc}}</p>

                                @if(isset($farmer_locations))
                                @foreach($farmer_locations as $loc)
                            <p><i class="fas fa-map-marker-alt text-primary mr-2"></i>{{$loc->address}}</p>
                                @endforeach
                                @endif
                               
                                {{-- <p><i class="fas fa-map-marker-alt text-primary mr-2"></i>788 Kaylin Street</p> --}}
                                <h2 class="mt-5 mb-3">About Farm</h2>
                                {{-- <p class="mb-4">We all have those moments in our lives when we feel as if everything needs to be exactly right. It is these moments that we often refer to as special occasions. When it comes to cooking for special occasions, many of us find that we drop the ball in our anticipation and feel as though we have ruined the moment. While this is often far from the truth, it does serve to diminish the moment in many of our minds. For this reason, you need to work up a repertoire, if you will, of simple to make special occasion cooking recipes. You will be shocked and amazed at all the sinfully rich and delicious meals and side dishes that are out there, that are amazingly quick and easy to prepare. This means that you will not run the all too common disaster scenarios that you hear about and will still manage to have a wonderful meal that is enjoyed by all. The trick is in choosing a rather simple meat dish and dressing it up with the more decadent side dishes.</p>
                                <p class="mb-4">Incredibly rich side dishes that are simple to prepare are greater in number than meat dishes that require little culinary effort. You should also keep in mind the audience for your special occasion. Sometimes a family favorite makes the occasion seem much more special than an all out effort for chicken cordon bleu or veal Marsala. There is no point in going to an extreme effort to create a culinary masterpiece if it is going to be riddled with picky children proclaiming that they do not like this or that about your meal.</p>
                                <p class="txt-greet">Enjoy eating fresh food! :)</p>
                                <p>Thank you!</p> --}}
                                <p class="mb-4">
                                    {!! $farmer_about  !!}
                                </p>
                                
                            </article>
                        </div>
                    </div>
                    <div class="tab-pane w-100" id="nav-contact">
                        <form id="contact_form" action="{{asset('user/contact')}}" method="post" class="form w-100 pt-4 form-contact pl-1 pr-1 pb-5">
                             {{csrf_field()}}
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="inputName">Name<sup>*</sup></label>
                                    <input name="name" type="text" class="form-control form-control-lg" id="inputName" placeholder="" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail">Email<sup>*</sup></label>
                                    <input name="email" type="email" class="form-control form-control-lg" id="inputEmail" placeholder="" required="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="inputPhone">Phone</label>
                                    <input name="phone" type="tel" class="form-control form-control-lg" id="inputPhone" placeholder="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputWeb">Website</label>
                                    <input name="website" type="text" class="form-control form-control-lg" id="inputWeb" placeholder="">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="inputWeb">Message<sup>*</sup></label>
                                <textarea name="message" class="form-control form-control-lg" id="exampleFormControlTextarea1" rows="3" placeholder="Text" required=""></textarea>
                            </div>
                             <input type="hidden" name="farmer_id" value="{{$form->id}}">
                            <button type="submit" class="btn btn-primary btn-send">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@section('download_app')
    @include('frontend.download_app')
@endsection
@section('javascript')
<script>
         var message =$('#message').val();
        
         if(message !== '' && typeof  message !== 'undefined')
         {
           showNotification(message);   
         }
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
        function changeResultPerPage() {
            var per_page =$('#per_page').val();
            var farmer_id =parseInt($('#farmer_id').val());
                $.ajax({
                    url:"{{route('ajax.get_per_page_prodcuts_for_farmer_page')}}",
                   type:"post",
                    data:{
                        '_token': '<?= csrf_token()?>',
                        'per_page':per_page,
                        'farmer_id':farmer_id,
                    },
                    success:function (result) {
                        $('#product_listing').empty();
                        $('#product_listing').append(result);
                    },
                    error:function (error) {

                    }
                });
                   }
        </script>
    <script language="javascript">
    function fbshareCurrentPage()
    {
        var farmer_profie_address = $('#farmer_profie_address').val();
        var win = window.open("https://www.facebook.com/sharer/sharer.php?u="+encodeURIComponent(farmer_profie_address)+"&t="+document.title, '_blank');
        if (win) {
            //Browser has allowed it to be opened
            win.focus();
        } else {
            //Browser has blocked it
            alert('Please allow popups for this website');
        }
    
    }
    $('#contact_form').validate({ // initialize the plugin
        rules: {
            name: {
                required: true
            },
            email: {
                email: true,
                required: true
            }
            message: {
            required: true
        }
    });
</script>

>>>>>>> 91f8e7c98d028b52a2f0d8fe5a887a1503bc8d5b
@endsection