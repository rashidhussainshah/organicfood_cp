@extends('frontend.layout')
@section('content')
        <!--- get current page if set-->
    @if ((isset($_GET['page'])) && (!empty($_GET['page'])))
    <input type="hidden" id="current_page_no" value="{{$_GET['page']}}">
    @else
    <input type="hidden" id="current_page_no" value="1">
    @endif

    @if(isset($shop_page) && ($shop_page=='yes'))
        <input type="hidden" id="isShopPage" value="yes">
    @else
        <input type="hidden" id="isShopPage" value="no">

    @endif
    @if(!empty($_GET['zip_code']) && isset($_GET['zip_code']) )
        <input type="hidden" id="is_zip_code" value="{{$_GET['zip_code']}}">
        <input type="hidden" id="isSearchPage" value="yes">
        @else
        <input type="hidden" id="is_zip_code" value="no">
        <input type="hidden" id="isSearchPage" value="no">


    @endif
    <!--- for already select category while search by category -->
    @if(isset($cat_id))
        <input type="hidden" id="cat_id" value="{{$cat_id}}">
        <input type="hidden" data-category_id="{{$cat_id}}" id="search_by_category" value="yes">
    @else
        <input type="hidden" id="search_by_category" value="no">
        @endif

    <!--- for already checked farms using jquery -->
    @isset($farmer_ids)
    @foreach($farmer_ids as $id)
        <input checked style="display: none" type="checkbox" name="farmer_ids" value="{{$id}}">
        @endforeach
    @endisset
        <!--- for already checked categories using jquery -->
    @isset($categories_id)
    @foreach($categories_id as $id)
        <input checked style="display: none" type="checkbox" name="categories_id" value="{{$id}}">
        @endforeach
    @endisset
    @if(Auth::guard('user')->check())
        <input type="hidden" id="isLoggedIn" value="yes">
    @else
        <input type="hidden" id="isLoggedIn" value="no">
    @endif
    <main role="content" class="container container-custom">
        <div class="promo-section w-100 row ml-0 mr-0">
            <div class="left-block">
                <a href="#" role="button" class="btn btn-dlv">Free Delivery</a>
                <h2>Our Promise to You: 100% Happiness Guarantee.</h2>
                <p>You’ll love the taste, freshness and quality of your money back.</p>
            </div>
            <div class="right-block">
                <img src="{{asset('public/frontend_updated/img/img-veg.png')}}" alt="Image Vegetables">
            </div>
        </div>
        <div class="row m-0">
            <button type="button" class="btn closebtn"><i class="fas fa-bars text-white"></i></button>
            <aside id="sidebar" class="col-lg-3 p-0 col-md-4 col-12">
                <nav class="sidebar">
                    <ul class="list-unstyled components">
                        <li>
                            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">SHOP BY <i class="fas fa-chevron-up float-right"></i></a>
                            <ul class="list-unstyled collapse show" id="homeSubmenu">
                                @if(Auth::guard('user')->check())
                                <li id="li_of_nearby_products" >
                                    <a href="{{route('product.show_shop_data')}}">Products Near You <span class="txt-count">{{$products->total()}}</span></a>
                                </li>
                                @else
                                <li id="li_of_nearby_products" >
                                    <a href="#"  data-toggle="modal" data-target="#loginModal">Products Near You <span class="txt-count">0</span></a>
                                </li>
                                @endif
                            
                                @if (isset($tags))
                                @foreach ($tags as $tag)
                                <li>
                                    <a href="{{ route('product.show_products_by_tag',['tag'=>$tag->id]) }}">{{ $tag->name }} <span class="txt-count">{{ $tag->name_count }}</span></a>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                        </li>
                        <li>
                            <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false">Categories <i class="fas fa-chevron-up float-right"></i></a>
                            <form class="form-horizontal collapse show scrollbar p-0" id="homeSubmenu2">
                                <fieldset class="force-overflow">
                                    @if($categories)
                                        @foreach($categories as $key=>$category)
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="categories" class="custom-control-input categories" id="categories-{{$category->id}}" value="{{$category->id}}" >
                                        <label class="custom-control-label" for="categories-{{$category->id}}">{{$category->name}}</label>
                                    </div>
                                        @endforeach
                                    @endif

                                </fieldset>
                            </form>
                        </li>
                        <li>
                            <a href="#homeSubmenu3" data-toggle="collapse" aria-expanded="false">Farms <i class="fas fa-chevron-up float-right"></i></a>
                            <form class="form-horizontal collapse show scrollbar p-0" id="homeSubmenu3">
                                <fieldset class="force-overflow">
                                    @if($farms)
                                        @foreach($farms as $key=>$farm)
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="farmers" class="custom-control-input farmers" id="{{$farm->id}}" value="{{$farm->id}}">
                                        <label class="custom-control-label" for="{{$farm->id}}">{{$farm->name}}</label>
                                    </div>
                                        @endforeach
                                    @endif
                                </fieldset>
                            </form>
                        </li>
                    </ul>
                </nav>

            </aside>
            <div class="col-lg-9 col-md-8 col-12 content-section">
                <!-- Farm Fresh Deals Starts.. -->
                <section class="pt-md-3 pt-3 sec-deals product-deals pb-md-5 pb-3" id="product_listing">
                    @if (isset($category_name) && !empty($category_name))
                    <h2 id="product_heading" class="mb-4">Products in '{{ $category_name }}'</h2> 
                    @else
                       <h2 id="product_heading" class="mb-4">Products Near You</h2> 
                    @endif
                    
                    <ul class="list-inline">
                        @if(count($products) > 0)
                            @foreach($products as $product)

                        <li class="list-inline-item">
                            <div class="product-grid">
                                <div class="product-image w-100">
                                    <a href="{{route('product.detail',['slug'=>$product->slug])}}" class="mb-3">
                                        @if(!empty($product->getFeaturedImage) && (isset($product->getFeaturedImage)))
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
                                            <span class="d-block img-capt p-2">
                                                <img class="float-left" src="{{asset($product->getUser->profile_photo)}}" alt="{{$product->getUser->name}}">{{$product->getUser->name}}</span>
                                        @endif
                                    @else
                                        <span class="d-block img-capt p-2"><img class="float-left"
                                                                                src="{{asset('public/frontend_updated/img/img-hassayampa.png')}}"
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
                            @else
                            <p>PRODUCT'S NOT FOUND</p>
                            @endif


                    </ul>
                    <div class="pagination-wrapper w-100 row m-0">
                        <div class="wrap-paging">
                            @if (isset($pagination_search) && ($pagination_search))
                                {{ $products->links() }}
                            @else
                              {{ $products->appends($_GET)->links() }}  
                            @endif
{{--                            <ul class="pagination">--}}
{{--                                --}}
{{--                                <li class="page-item">--}}
{{--                                    <a class="page-link" href="{{$products->lastPage()}}"><img src="{{asset('public/frontend_updated/img/btn-prevPage.png')}}" alt="pagination-arrow-left"></a>--}}
{{--                                </li>--}}
{{--                                <li class="page-item"><a class="page-link" href="#"><img src="{{asset('public/frontend_updated/img/arrow-left.png')}}" alt="pagination-arrow-prev"></a>--}}
{{--                                </li>--}}
{{--                                <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
{{--                                <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--                                <li class="page-item"><a class="page-link" href="#">...</a></li>--}}
{{--                                <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                                <li class="page-item"><a class="page-link" href="#"><img src="{{asset('public/frontend_updated/img/arrow-right.png')}}" alt="pagination-arrow-right"></a>--}}
{{--                                </li>--}}
{{--                                <li class="page-item">--}}
{{--                                    <a class="page-link" href="#"><img src="{{asset('public/frontend_updated/img/btn-nextPage.png')}}" alt="pagination-arrow-right"></a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
                        </div>

                            <input type="hidden" id="products_count" value="{{count($products)}}">
                        <div class="select-page" id="result_per_page">
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
                </section>
            </div>
        </div>
    </main>
    @endsection
@section('javascript')
    <script>
        function changeResultPerPage() {
            var per_page =$('#per_page').val();
            var isSearchByCategory = $('#search_by_category').val();
            var isSearchPage = $('#isSearchPage').val();
            var isShopSearch = $('#isShopPage').val();
            var current_page_no =parseInt($('#current_page_no').val());
            
            //get selected categories and farmers
                var selected_farmers = [];
                var selected_categories =[];
                $.each($("input[name='categories']:checked"), function () {
                    selected_categories.push($(this).val());
                });

                $.each($("input[name='farmers']:checked"), function () {
                    selected_farmers.push($(this).val());
                });
                
                 //if no category or farmer selected then get latest project with per page
                 if (selected_categories.length === 0 && selected_farmers.length === 0)
                {
                    getLatestProducts();
                    return false;
                }
                if (history.pushState) {
                                var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?page='+current_page_no+'&per_page='+per_page;
                        window.history.pushState({path:newurl},'',newurl);
                    }
                              //get searched category id
                var cat_id = $('#search_by_category').data('category_id');
                $.ajax({
                    url:"{{route('ajax.get_per_page_prodcuts_by_category')}}",
                    type:'post',
                    data:{
                        '_token': '<?= csrf_token()?>',
                        'per_page':per_page,
                        'cat_id':cat_id,
                        'selected_farmers':selected_farmers,
                        'selected_categories':selected_categories,
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
    <script>
        $(document).ready(function () {
            // change query string 
            var per_page =$('#per_page').val();
             var current_page_no =parseInt($('#current_page_no').val());
                if (history.pushState) {
            var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?page='+current_page_no+'&per_page='+per_page;
              window.history.pushState({path:newurl},'',newurl);
        }
             //get selected category id
            var cat_id = $('#cat_id').val();
            $("input[name^='categories'][value^='" +  cat_id + "']").prop("checked", true);
            //checked farmers
            $.each($("input[name='farmer_ids']:checked"), function () {
                $("input[name^='farmers'][value^='" +  $(this).val() + "']").prop("checked", true);
            });
            //checked search categories after pagination
            $.each($("input[name='categories_id']:checked"), function () {
                $("input[name^='categories'][value^='" +  $(this).val() + "']").prop("checked", true);
            });
            var zip_code = $('#is_zip_code').val();
            if (zip_code == 'no')
            {
                zip_code='';
            }
            else
            {
                zip_code=zip_code;
            }

            //hide nearby link if user not logged in
            var isLoggedIn = $('#isLoggedIn').val();
        
            //hide per page select if no product found
            var total_products = parseInt($('#products_count').val());
            if(total_products == 0)
            {
               $('#result_per_page').hide();
            }
            //get per page value
            var per_page =$('#per_page').val();
            $('.categories').on('change', function () {
                var selected_farmers = [];
                var selected_categories =[];
                $.each($("input[name='categories']:checked"), function () {
                    selected_categories.push($(this).val());
                });

                $.each($("input[name='farmers']:checked"), function () {
                    selected_farmers.push($(this).val());
                });
                if (selected_categories.length === 0 && selected_farmers.length === 0)
                {
                    getLatestProducts();
                    return false;
                }
                    $.ajax({
                       url:"{{route('ajax.search_by_category')}}",
                        data: {
                           '_token':'<?= csrf_token();?>',
                           selected_categories:selected_categories,
                            selected_farmers:selected_farmers,
                            per_page:per_page,
                            cat_id:cat_id,
                        },
                        type:'POST',
                        success:function (result) {
                           $('#product_listing').empty();
                           $('#product_listing').append(result);

                        },
                        error:function (error) {

                        }

                    });

            });

            $('.farmers').on('change', function () {
                var selected_farmers = [];
                var selected_categories =[];
                $.each($("input[name='categories']:checked"), function () {
                    selected_categories.push($(this).val());
                });

                $.each($("input[name='farmers']:checked"), function () {
                    selected_farmers.push($(this).val());
                });
                if (selected_categories.length === 0 && selected_farmers.length === 0)
                {
                    getLatestProducts();
                    return false;
                }

                    $.ajax({
                       url:"{{route('ajax.search_by_category')}}",
                        data: {
                            '_token':'<?= csrf_token();?>',
                            selected_categories:selected_categories,
                            selected_farmers:selected_farmers,
                            per_page:per_page,
                            cat_id:cat_id,
                        },
                        type:'POST',
                        success:function (result) {
                           $('#product_listing').empty();
                           $('#product_listing').append(result);

                        },
                        error:function (error) {

                        }

                    });

            });
        });
        function  getLatestProducts() {
            var per_page =$('#per_page').val();
            var isSearchPage = $('#isSearchPage').val();
            var isShopPage = $('#isShopPage').val();
            var isSearchByCategoryPage = $('#search_by_category').val();
            var cat_id = parseInt($('#cat_id').val());
           
                $.ajax({
                    url:"{{route('ajax.get_latest_products')}}",
                    data: {
                        'per_page':per_page,
                        'isShopPage':false,
                        'isSearchPage':false,
                        'isSearchByCategoryPage':true,
                        'cat_id':cat_id,
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
