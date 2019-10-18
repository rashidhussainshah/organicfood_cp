@extends('frontend.layout')
@section('content')
    @if(Auth::guard('user')->check())
        <input type="hidden" id="isLoggedIn" value="yes">
    @else
        <input type="hidden" id="isLoggedIn" value="no">
    @endif
    <section class="banner-cart pt-5 pb-5">
        <div class="container">
            <h2>My Cart</h2>
            <p>Banjo tote bag bicycle rights, High Life sartorial cray craft beer whatever street art fap.</p>
        </div>
    </section>
    <main role="content" class="container container-custom pd-cont">
        <div id="demo">
            <div class="step-app">
                <ul class="step-steps" id="tab_links">
                    <li id="cart_tab"><a href="#tab1">Cart</a></li>
                    <li id="delivery_tab"><a href="#tab2">Delivery</a></li>
                    <li id="payment_tab"><a href="#tab3">Payment</a></li>
                    <li id="confirmation_tab"><a href="#tab4">Confirmation</a></li>
                </ul>
                <div class="step-content" id="tab_contents">
                    <div class="step-tab-panel" id="tab1">
                        <ul class="list-unstyled col-12 mb-5">
                            @foreach(Cart::content() as $row)
                                @php
                                    $product = getProductDetail($row->id);
                                @endphp
                                <li id="remove_main-{{$row->rowId}}" class="row d-flex flex-row justify-content-between">
                                    @if(isset($product->getFeaturedImage) && !empty($product->getFeaturedImage))
                                        @if($product->getFeaturedImage->path != '')
                                            <img class="img-list col-lg-2 col-12"
                                                 src="{{asset($product->getFeaturedImage->path)}}"
                                                 alt="Image Avocados">
                                        @endif
                                    @else
                                        <img class="img-list col-lg-2 col-12"
                                             src="{{asset('public/frontend_updated/img/img-avo.png')}}"
                                             alt="Image Avocados">

                                    @endif


                                    <div class="txt-list col-lg-3 col-12">
                                        <p>{{$row->name}}</p>
                                        @if($product->getUser)
                                            @if($product->getUser->profile_photo != '')
                                                <span class="d-block img-capt p-2"><img class="float-left"
                                                                                        src="{{asset($product->getUser->profile_photo)}}"
                                                                                        alt="{{$product->getUser->name}}"> {{$product->getUser->name}}<span>

                                        @else
                                                            <span class="d-block img-capt p-2"><img class="float-left"
                                                                                                    src="{{asset('public/frontend_updated/img/img-hassayampa.png')}}"
                                                                                                    alt="Image Hassayampa"> Hassayampa Vineyard &amp; Farm</span>
                                            @endif
                                        @endif
                                    </div>
                                        <div id="update_qty_main{{$row->rowId}}" class="txt-ref col-lg-2 col-12">
                                            Qty: {{$row->qty}}</div>

                                        @if($product->getUnit)
                                        @if($product->getUnit->name != '')
                                            <div class="txt-appr col-lg-2 col-12">{{$product->getUnit->name}}</div>
                                        @endif
                                    @else
                                        <div class="txt-appr col-lg-2 col-12">N/A</div>
                                    @endif

                                    <div class="input-holder col-lg-2 col-12">
                                        <div class="def-number-input number-input safari_only">
                                            <button id="{{$row->rowId}}"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                                class="minus descreaseQuantity"></button>
                                            <input class="quantity" id="update-row-count-{{$row->rowId}}" min="0"
                                                   name="quantity" value="{{$row->qty}}" type="number">
                                            <button id="{{$row->rowId}}"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                                class="plus increaseQuantity"></button>
                                        </div>
                                        <!-- adjust product quantity -->
                                        <input type="hidden" id="current_qty_of_product{{$row->rowId}}"
                                               value="{{$row->qty}}">

                                        <input type="hidden" id="product_id{{$row->rowId}}"
                                               value="{{$row->id}}">
                                    </div>
                                    <div class="col-1 btn-action">
                                        <button  type="button" class="btn btn-link"><i id="{{$row->rowId}}"
                                                class="fas fa-times txt-times removeItemFromCart"></i></button>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @if(!Auth::guard('user')->check())
                    <div class="step-tab-panel" id="tab2">
                        <form id="user_register_from_cart" class="form-horizontal mb-5 pb-5 form-cart pt-1 col-12">
                            <!--Error Message-->
                            <div class="alert alert-danger  alert-dismissible ajax-msg-danger" style="display: none;">
                                <span class="ajax-body-danger"></span>
                            </div>
                            <!--Success Message-->
                            <div class="alert alert-success  alert-dismissible ajax-msg-success" style="display: none;">
                                <span class="ajax-body-success"></span>
                            </div>

                            <input type="hidden" id="lat" name="lat">
                            <input type="hidden" id="long" name="long">
                            <div class="row mb-3">
                                <div class="col-lg-6 col-12 mb-3">
                                    <div class="row">
                                        <div class="col-lg-6 col-12 mb-3">
                                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                                        </div>
                                        <div class="col-lg-6 col-12 mb-3">
                                            <input type="text" class="form-control" id="last_name" name="last_name"  placeholder="Last Name">
                                        </div>
                                        <div class="col-lg-6 col-12 mb-3">
                                            <input type="text" id="cell_num" name="phone" class="form-control" placeholder="Phone Number">
                                        </div>
                                        <div class="col-lg-6 col-12 mb-3">
                                            <input type="text" id="user_email" name="email" class="form-control" placeholder="Email">
                                        </div>
{{--                                        <div class="col-lg-6 col-12 mb-3">--}}
{{--                                            <select class="custom-select">--}}
{{--                                                <option selected>Country</option>--}}
{{--                                                <option value="Pk">Pakistan</option>--}}
{{--                                                <option value="UK">United Kingdom</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-6 col-12 mb-3">--}}
{{--                                            <select class="custom-select">--}}
{{--                                                <option selected>Country</option>--}}
{{--                                                <option value="Pk">Pakistan</option>--}}
{{--                                                <option value="UK">United Kingdom</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}

                                        <div class="col-lg-6 col-12 mb-3">
                                            <input id="user_password" name="password" type="password" class="form-control"
                                                   placeholder="&#9679&#9679&#9679&#9679&#9679&#9679&#9679&#9679">
                                        </div>
                                        <div class="col-lg-6 col-12 mb-3">
                                            <input id="user_password-confirm" name="confirm_password" type="password" class="form-control"
                                                   placeholder="&#9679&#9679&#9679&#9679&#9679&#9679&#9679&#9679&#9679&#9679">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="w-100 mb-3" >
                                        <input type="text" id="zip_code" name="zip_code" class="form-control" placeholder="Zip Code">
                                    </div>
                                    <textarea class="form-control" id="address" name="address" row="10" cols="10" placeholder="Address"></textarea>
                                </div>
                                <button type="submit" id="user_registration_btn" class="btn btn-block mb-4 btn-primary">Sign Up</button>
                            </div>
                        </form>
                    </div>
                    @endif
                    <div  class="step-tab-panel" id="tab3">
                        <div role="tabpanel" class="row">
                            <div class="col-2">
                                <ul class="nav nav-tabs flex-column" role="tablist">
                                    <li role="tab" class="active">
                                        <label data-target="#scheduleDaily">
                                            <input id="optDaily" value="visa" name="intervaltype" type="radio" checked/>
                                            <img src="{{asset('public/frontend_updated/img/ico-visa.png')}}"
                                                 alt="Image Description">
                                        </label>
                                    </li>
{{--                                    <li role="tab">--}}
{{--                                        <label data-target="#scheduleWeekly">--}}
{{--                                            <input id="optWeekly" name="intervaltype" type="radio"/>--}}
{{--                                            <img src="{{asset('public/frontend_updated/img/ico-master.png')}}"--}}
{{--                                                 alt="Image Description">--}}
{{--                                        </label>--}}
{{--                                    </li>--}}
                                    <li role="tab">
                                        <label data-target="#scheduleMonthly">
                                            <input id="optMontly" value="onhold" name="intervaltype" type="radio"/>
                                            <span class="txt-hold">On-Hold</span>
                                            {{-- <img src="{{asset('public/frontend_updated/img/ico-payoneer.png')}}"
                                                 alt="Image Description"> --}}
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-10">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="scheduleDaily">
                                        <form class="form" action="/charge" method="post" id="payment-form">
                                            <div class="form-row">
                                                <label for="card-element">
                                                </label>
                                                <div id="card-element">
                                                    <!-- A Stripe Element will be inserted here. -->
                                                </div>

                                                <!-- Used to display form errors. -->
                                                <div id="card-errors" role="alert"></div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-lg-3 col-12 mb-3">
                                                    <input type="text" maxlength="16" class="form-control"id="card-number" placeholder="Enter 16-Digit Card number" required>
                                                </div>
                                                <div class="col-lg-3 col-12 mb-3">
                                                    <input type="text" class="form-control"  maxlength="3" id="card-cvc" placeholder="Enter Card CVC i.e 123" required>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-row">
                                                        <div class="col-md-4 col-12 form-select mb-3">
                                                            <select id="card-expiry-month" class="form-control">
                                                                <option selected="">Select Month</option>
                                                                <option value="1" title="January">1</option>
                                                                <option value="2" title="February">2</option>
                                                                <option value="3" title="March">3</option>
                                                                <option value="4" title="April">4</option>
                                                                <option value="5" title="May">5</option>
                                                                <option value="6" title="June">6</option>
                                                                <option value="7" title="July">7</option>
                                                                <option value="8" title="August">8</option>
                                                                <option value="9" title="September">9</option>
                                                                <option value="10" title="October">10</option>
                                                                <option value="11" title="November">11</option>
                                                                <option value="12" title="December">12</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 col-12 mb-3">
                                                            <input class="form-control" id="card-expiry-year" type="number" maxlength="4" placeholder="i.e 2020">
                                                        </div>
                                                        <button  id="stripe_cart_verification_btn" class="btn-verify btn btn-dark">Verify Cart</button>
                                                    </div>
                                                </div>
                                                
                                                <input type="hidden" id="stripe_token" value="">
                                            </div>



                                        </form>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="scheduleWeekly">
                                        <form class="form" action="#">
                                            <div class="form-row">
                                                <div class="col-lg-3 col-12 mb-3">
                                                    <input type="text" class="form-control"id="card-number" placeholder="Card Name">
                                                </div>
                                                <div class="col-lg-3 col-12 mb-3">
                                                    <input type="text" class="form-control" id="card-cvc" placeholder="Card Number">
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-row">
                                                        <label for="EndDate"
                                                               class="col-md-2 col-12 col-form-label align-self-center">End
                                                            Date</label>
                                                        <div class="col-md-5 col-12 form-select mb-3">
                                                            <select id="card-expiry-month" class="form-control">
                                                                <option selected="">mm</option>
                                                                <option value="10">10</option>
                                                                <option value="oct">October</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-5 col-12 mb-3">
                                                            <select id="card-expiry-year" class="form-control">
                                                                <option selected="">yy</option>
                                                                <option value="2020">2020</option>
                                                                <option value="2018">2018</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
{{--                                            <div class="form-row">--}}
{{--                                                <div class="col-lg-3 col-12 mb-3">--}}
{{--                                                    <input type="text" class="form-control form-control-lg"--}}
{{--                                                           placeholder="CVV">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                        </form>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="scheduleMonthly">
                                        <form class="form" action="#">
                                            <div class="form-row">
                                                <div class="col-lg-3 col-12 mb-3">
                                                    <input type="text" class="form-control"id="card-number" placeholder="Card Name">
                                                </div>
                                                <div class="col-lg-3 col-12 mb-3">
                                                    <input type="text" class="form-control" id="card-cvc" placeholder="Card Number">
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-row">
                                                        <label for="EndDate"
                                                               class="col-md-2 col-12 col-form-label align-self-center">End
                                                            Date</label>
                                                        <div class="col-md-5 col-12 form-select mb-3">
                                                            <select id="card-expiry-month" class="form-control">
                                                                <option selected="">mm</option>
                                                                <option value="10">10</option>
                                                                <option value="oct">October</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-5 col-12 mb-3">
                                                            <select id="card-expiry-year" class="form-control">
                                                                <option selected="">yy</option>
                                                                <option value="2020">2020</option>
                                                                <option value="2018">2018</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
{{--                                            <div class="form-row">--}}
{{--                                                <div class="col-lg-3 col-12 mb-3">--}}
{{--                                                    <input type="text" class="form-control form-control-lg"--}}
{{--                                                           placeholder="CVV">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="step-tab-panel" id="tab4">
                        <div class="row ml-0 mr-0 mb-5 card-holder">

                            <div id="editable_payment_address" class="col-md-6 col-12 justify-content-stretch mb-3">
                                <div class="card bg-lightG rounded-0 border-0 h-100">
                                    <div class="card-body">
                                        <div class="float-left pt-2">
                                            <img src="{{asset('public/frontend_updated/img/ico-payment.png')}}"
                                                 alt="Image Delivery">
                                        </div>
                                        <div class="wrap-desc">
                                            <a onclick="editCard()" class="float-right btn-edit"><img
                                                    src="{{asset('public/frontend_updated/img/ico-edit.png')}}"
                                                    alt="Icon Edit">Edit</a>
                                            <h2 class="card-title">Payment</h2>
                                            <strong class="d-block text-uppercase"><img
                                                    src="{{asset('public/frontend_updated/img/ico-visa.png')}}"
                                                    alt="Image Visa Card"> Visa Card</strong>
                                            <p class="card-text">&#42;&#42;&#42;&#42;&nbsp;&#42;&#42;&#42;&#42;&nbsp;&#42;&#42;&#42;&#42;&nbsp;<span id="card_last_four_digit">2661</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="editable_delivery_address" style="display: none" class="col-md-6 col-12 justify-content-stretch mb-3">
                                <div class="card bg-lightG rounded-0 border-0 h-100">
                                    <div class="card-body">
{{--                                        <a class="float-right btn-edit"><img--}}
{{--                                                src="{{asset('public/frontend_updated/img/ico-edit.png')}}"--}}
{{--                                                alt="Icon Edit"> Edit</a>--}}
{{--                                        <div class="float-left pt-2">--}}
{{--                                            <img src="{{asset('public/frontend_updated/img/ico-delivery.png')}}"--}}
{{--                                                 alt="Image Delivery">--}}
{{--                                        </div>--}}
                                        <div class="wrap-desc">
                                            <h2 class="card-title" id="show_error_title"> Error</h2>
{{--                                            <strong class="d-block">Free Delivery</strong>--}}
                                            <p class="card-text" id="show_eror_text">Something Went Wrong</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100" id="cart_list_products">
                                <h2 class="col-12 mb-3">Cart Items</h2>
                                <ul class="list-unstyled col-12 mb-5">
                                    @foreach(Cart::content() as $row)
                                        @php
                                            $product = getProductDetail($row->id);
                                        @endphp
                                        <li id="remove_confirm-{{$row->rowId}}" class="row d-flex flex-row justify-content-between">
                                            @if($product->getFeaturedImage)
                                                @if($product->getFeaturedImage->path != '')
                                                    <img class="img-list col-lg-2 col-12"
                                                         src="{{asset($product->getFeaturedImage->path)}}"
                                                         alt="Image Avocados">
                                                @endif
                                            @else
                                                <img class="img-list col-lg-2 col-12"
                                                     src="{{asset('public/frontend_updated/img/img-avo.png')}}"
                                                     alt="Image Avocados">

                                            @endif

                                            <div class="txt-list col-lg-3 col-12">
                                                <p>{{$row->name}}</p>

                                                @if($product->getUser)
                                                    @if($product->getUser->profile_photo != '')
                                                        <span class="d-block img-capt p-2"><img class="float-left"
                                                                                                src="{{asset($product->getUser->profile_photo)}}"
                                                                                                alt="{{$product->getUser->name}}"> {{$product->getUser->name}}<span>

                                        @else
                                                                    <span class="d-block img-capt p-2"><img
                                                                            class="float-left"
                                                                            src="{{asset('public/frontend_updated/img/img-hassayampa.png')}}"
                                                                            alt="Image Hassayampa"> Hassayampa Vineyard &amp; Farm</span>
                                                    @endif
                                                @endif
                                            </div>

                                            @if($product->getUnit)
                                                @if($product->getUnit->name != '')
                                                    <div
                                                        class="txt-appr col-lg-2 col-12">{{$product->getUnit->name}}</div>
                                                @endif
                                            @else
                                                <div class="txt-appr col-lg-2 col-12">N/A</div>
                                            @endif
                                            <div id="update_qty{{$row->rowId}}" class="txt-qty col-lg-2 col-12">
                                                Qty: {{$row->qty}}</div>
                                           <span id="product_price_span">
                                               <div data-current_quantity="1"
                                                    data-product_price="{{number_format($row->price,2)}}"
                                                    class="col-lg-1 txt-amnt col-12">$ {{number_format($row->price,2)}}
                                               </div>
                                           </span>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="step-footer col-12 row m-0 justify-content-between">
                        <button  onclick="window.location='{{ url("/") }}'" class="btn-shop btn">Conitnue Shopping</button>
                        <button data-direction="prev" class="stp-bck btn step-btn"><img
                                src="{{asset('public/frontend_updated/img/left-ico.png')}}" alt="left icon"> Back
                        </button>
                        <div class="row m-0">
                            <div class="block-checkOut">
                                <dl class="row mx-0">
                                    <dt class="t-total">Total</dt>
                                    <span id="cart_detail">
                                        <dd data-cart_detail_total="{{Cart::total()}}"
                                            class="t-amount">$ {{Cart::total()}}</dd>
                                    </span>

                                </dl>
                            </div>
                            <button data-direction="next" class="stp-nxt btn step-btn">Next Step</button>
                            <button data-direction="finish" class="btn  place_order" id="">Place Order</button>
                        </div>

                    </div>
                </div>
                <div class="d-none" id="track_order">
                    <div class="row ml-0 mr-0">
                        <div class="stat-block">
                            <img src="{{asset('public/frontend_updated/img/img-cart.png')}}" alt="Stat Image">
                            <h2>Congratulations. <br/>Your order is received.</h2>
                            <p>Let me be clear. Not even close. <br/>We did not go by choice, we went because of
                                necessity.</p>
                            <button type="button" class="btn btn-primary place_order">Track Order</button>
                        </div>
                    </div>
                </div>
            </div>
    </main>
@endsection
@section('download_app')
    @include('frontend.download_app')
@endsection
@section('javascript')
    <script src="{{asset('public/frontend_updated/js/jquerysteps.js')}}"></script>
    <script src="https://js.stripe.com/v2/"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        function editCard()
        {
            $('#stripe_cart_verification_btn').attr('disabled',false);
            $('#payment_tab').trigger('click');
        }
        // Create a Stripe client.
        Stripe.setPublishableKey('pk_test_EbSWPS8eAbEXdAq34Dj65NEa00cYn94Vo7');
        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            Stripe.card.createToken({
                number: $('#card-number').val(),
                cvc: $('#card-cvc').val(),
                exp_month: $('#card-expiry-month').val(),
                exp_year: parseInt($('#card-expiry-year').val()),
                // address_zip: $('.address_zip').val()
            }, stripeResponseHandler);
        });

        function stripeResponseHandler(status, response) {

            // Grab the form:
            var $form = $('#payment-form');
            var displayError = document.getElementById('card-errors');

            if (response.error) { // Problem!
                displayError.textContent = response.error.message
                $('#card-errors').css('color', 'red');

            } else { // Token was created!
                displayError.textContent = '';
                // Get the token ID:
                var token = response.id;

                // Insert the token into the form so it gets submitted to the server:
                // $form.append($('<input type="hidden" name="stripeToken" />').val(token));
                $('#stripe_token').val(token);
                // displayError.textContent= 'Your Card Is Verified, Go Next Setup For Payment';
                // Submit the form:

                $('#stripe_cart_verification_btn').attr('disabled',true);
                var card_num = $('#card-number').val();
                var card_num = $('#card-number').val();
                var last_four_digit = card_num.slice(-4);
                $('#card_last_four_digit').text(last_four_digit);
                //replace cart last four digit

                $('#editable_delivery_address').show();
                $('#show_error_title').text('Card Verified');
                $('#show_error_title').css('color', 'green');
                $('#show_eror_text').text('Your Card Verified Successfully');
                $('#show_eror_text').css('color', 'green');

                $('#confirmation_tab').trigger('click');
                // $form.get(0).submit();

            }
        }

    </script>

    <script>
        $('.place_order').on('click', function () {
            var cart_count = parseInt($('#cart_count').data('count'));
            var payment_method = $('input[name=intervaltype]:checked').val();
            var isLoggedIn = $('#isLoggedIn').val();
            if (isLoggedIn == 'no')
            {
               alert('Please Login or Register Your Self');
                $('#delivery_tab').trigger('click');
                return false;
            }
            //for visa
            if(payment_method == 'visa')
            {
                var stripe_token = $('#stripe_token').val();
                if(stripe_token == '')
                {
                    alert('please verify your card');
                    $('#payment_tab').trigger('click');
                    return false;

                }
                else if(cart_count == 0)
                {
                    alert('Please Select Products in Cart');

                    return false;

                }
                else
                {
                    //get card da
                    var card_number= parseInt($('#card_last_four_digit').text());
                    var card_cvc = $('#card-cvc').val();
                    var card_expiry_month = $('#card-expiry-month').val();
                    var card_expire_year = $('#card-expiry-year').val();
                    $.ajax({
                       url: "{{route('product.place_visa_order')}}",
                        data: {
                            '_token': '<?= csrf_token(); ?>',
                            card_number: card_number,
                            card_cvc: card_cvc,
                            stripe_token: stripe_token,

                        },
                       type:'POST',
                       success:function(res)
                       {
                           var total_cart_price = res.cart_total;
                           $('#cart_count_and_total').empty();
                           $('#cart_count_and_total').html(`<span id="cart_count" data-count="` + res.cart_total_item + `">` + res.cart_total_item + `</span>  -  $<span id="cart_total" data-total="` + total_cart_price + `">` + total_cart_price + `</span> USD`);
                           //update total on cart detail

                           $('#cart_detail').html(`<span id="cart_detail">
                                <dd data-cart_detail_total ="` + total_cart_price + `" class="t-amount">$ ` + total_cart_price + `</dd>
                                </span>`);
                           //hide tab links and content and show ordre confirmation section
                           $('#tab_links').hide();
                           $('#tab_contents').hide();
                           $('#track_order').removeClass('d-none');

                           showNotification(res.message);
                       },
                        error:function(error)
                        {
                            $('#editable_delivery_address').show();
                            $('#show_eror_text').text(error.responseJSON.message);
                            $('#show_eror_text').css('color', 'red');
                            $('#show_error_title').text(error.responseJSON.error_title);
                            $('#show_error_title').css('color', 'red');


                        }
                    });

                }
            }
            // for on hold
            else
            {
                $.ajax({
                    url:"{{route('products.place_onhold_order')}}",
                    success:function (result) {
                        showNotification(result.message);

                    },
                    error:function (error) {
                        $('#editable_delivery_address').show();
                    }
                });

            }

        });
    </script>

    <script>
        $('#optMontly').on('click', function () {
            $('#confirmation_tab').trigger('click');
            $('#editable_payment_address').hide();
            $('#editable_delivery_address').hide();
        });
    </script>

    <script>
        // user registration from cart
        $("#user_register_from_cart").submit(function (event) {
            event.preventDefault();

            //registration form validation
        }).validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                confirm_password: {
                    required: true,
                    equalTo: "#user_password"
                },

                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                phone: {
                    required: true,
                }
            },

            submitHandler: function (form) {
                //get values from input fields
                var name, email, password, password_confirmation, lat, long, cell_num, zip_code, address;
                name = $('#first_name').val();
                name = name + ' ' + $('#last_name').val();
                email = $('#user_email').val();
                password = $('#user_password').val();
                password_confirmation = $('#user_password-confirm').val();
                cell_num = $('#cell_num').val();
                lat = $('#lat').val();
                long = $('#long').val();
                zip_code = $('#zip_code').val();
                address = $('#address').val();

                $.ajax({
                    url: "<?= asset('/user/register');?>",
                    data: {
                        '_token': '<?= csrf_token(); ?>',
                        name: name,
                        email: email,
                        password: password,
                        password_confirmation: password_confirmation,
                        lat: lat,
                        long: long,
                        phone: cell_num,
                        zip_code: zip_code,
                        address: address,
                    },
                    type: "POST",
                    success: function (result) {
                        $('#isLoggedIn').val('yes');
                        $('#delivery_tab').hide();
                        $('#tab2').hide();
                        $('#payment_tab').trigger('click');
                        $('.ajax-msg-success').show();
                        $('.ajax-body-success').append(result.message);
                        showNotification(result.message);

                    }, error: function (err) {
                        // hide success messages
                        $('.ajax-msg-success').hide();
                        // show error message div
                        $('.ajax-msg-danger').show();
                        //empty if had already any value
                        $("#registration_form").trigger('reset');

                        //Check error message from default validator
                        if (err.responseJSON.from == 'validator') {
                            //Seprate into single val
                            $.each(err.responseJSON.message, function (key, value) {
                                //if array have consists of more arrays
                                if (value.length > 1) {
                                    //Seprate into single arrays
                                    $.each(value, function (key, val) {
                                        //Appendnig the values to targeted class
                                        $('.ajax-body-danger').append(val + '<br>');
                                    });
                                } else {
                                    //Appendnig the values to targeted class
                                    $('.ajax-body-danger').append(value + '<br>');
                                }

                            });
                        }
                        //Check error message is due to invalid password
                        else if (err.responseJSON.from == 'invalid') {
                            //Appendnig the values to targeted class
                            $('.ajax-body-danger').append(err.responseJSON.message);
                        }

                    }
                })

            }
        });
    </script>
    <script>
        $(document).ready(function () {
            var isLoggedIn = $('#isLoggedIn').val();
            if (isLoggedIn == 'yes')
            {
                $('#delivery_tab').hide();
            }
            var current_quantity = parseInt($('#product_price').data('current_quantity'));
            var product_original_price = parseFloat($('#product_price').data('product_price'));
            $(".descreaseQuantity").click(function () {
                var product_qty = parseInt($('#current_qty_of_product' + this.id).val()); //GET
                if (product_qty === 1) {

                    showNotification('Atleast 1 Product is compulsory');
                    return false;
                }
                product_qty--;
                $('#current_qty_of_product' + this.id).val(product_qty); //SET
                var product_id = parseInt($('#product_id' + this.id).val()); //GET
                var rowId = this.id;
                $.ajax({
                    url:'{{route('cart.decrease_cart')}}',
                    data:{
                        'id':product_id,
                        'rowId':this.id,
                        'quantity': product_qty,
                    },
                    success:function (res) {
                        var total_cart_price = res.cart_total;
                        $('#cart_count_and_total').empty();
                        $('#cart_count_and_total').html(`<span id="cart_count" data-count="` + res.cart_total_item + `">` + res.cart_total_item + `</span>  -  $<span id="cart_total" data-total="` + total_cart_price + `">` + total_cart_price + `</span> USD`);
                        //update total on cart detail
                        $('#cart_detail').empty();
                        $('#cart_detail').html(`<span id="cart_detail">
                                <dd data-cart_detail_total ="` + total_cart_price + `" class="t-amount">$ ` + total_cart_price + `</dd>
                                </span>`);
                        $('#update_qty_main' + rowId).text('Qty: ' + product_qty);
                        $('#update_qty' + rowId).text('Qty: ' + product_qty);


                        //show notificatoin
                        showNotification(res.message);
                    },
                    error:function (erro) {

                    }
                });
            });

            $(".increaseQuantity").on('click', function () {

                var product_qty = parseInt($('#current_qty_of_product' + this.id).val()); //GET
                var product_id = parseInt($('#product_id' + this.id).val()); //GET
                product_qty++;
                $('#current_qty_of_product' + this.id).val(product_qty); //SET
                var rowId = this.id;
                $.ajax({
                    url:'{{route('cart.increase_cart')}}',
                    data:{
                        'id':product_id,
                        'rowId':this.id,
                        'quantity': product_qty,
                    },
                    success:function (res) {
                        var total_cart_price =res.cart_total;
                        $('#cart_count_and_total').empty();
                        $('#cart_count_and_total').html(`<span id="cart_count" data-count="` + res.cart_total_item + `">` + res.cart_total_item + `</span>  -  $<span id="cart_total" data-total="` + total_cart_price + `">` + total_cart_price + `</span> USD`);
                        //update total on cart detail
                        $('#cart_detail').empty();
                        $('#cart_detail').html(`<span id="cart_detail">
                                <dd data-cart_detail_total ="` + total_cart_price + `" class="t-amount">$ ` + total_cart_price + `</dd>
                                </span>`);
                        $('#update_qty_main' + rowId).text('Qty: ' + product_qty);
                        $('#update_qty' + rowId).text('Qty: ' + product_qty);
                        //show notificatoin
                        showNotification(res.message);
                    },
                    error:function (erro) {

                    }
                });

                  });

            $(".removeItemFromCart").click(function () {
                var rowId = this.id;
                $.ajax({
                    url:'{{route('cart.remove_item_from_cart')}}',
                    data:{
                        'rowId':this.id,
                    },
                    success: function (result) {
                        if (result.status) {
                            current_quantity =result.cart_total_item;
                            var total = result.cart_total;
                            $('#cart_count_and_total').empty();
                            $('#cart_count_and_total').html(`<span id="cart_count" data-count="` + current_quantity + `">` + current_quantity + `</span>  -  $<span id="cart_total" data-total="` + total + `">` + total + `</span> USD`);

                            //remove li from ul using Cart rowId
                            $('#remove_main-' + rowId).remove();
                            $('#remove_confirm-' + rowId).remove();

                            //update total on cart detail
                            $('#cart_detail').empty();
                            $('#cart_detail').html(`<span id="cart_detail">
                                <dd data-cart_detail_total ="` + total + `" class="t-amount">$ ` + total + `</dd>
                                </span>`);
                            //show notificatoin
                            showNotification(result.message);

                        }
                    },
                    error:function (erro) {

                    }
                });

                  });
        });
    </script>
    <script>
        $('.dropdown-menu a').click(function () {
            $('a.dropdown-toggle').text($(this).text());
            $('a.dropdown-toggle').val($(this).text()).addClass('add')
                .append('<i class="fas fa-chevron-down"></i>');
        });

        //slick slider initiator
        $(document).ready(function () {
            $('#slider').slick({
                centerMode: true,
                centerPadding: '5px',
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
                        breakpoint: 991,
                        settings: {
                            centerPadding: '20px',
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ],
                prevArrow: "<button type='button' class='slick-prev pull-left'><img src='img/Shape.png' alt='angle-previous'></button>",
                nextArrow: "<button type='button' class='slick-next pull-right'><img src='img/stre-right.png' alt='angle-right'></button>",


            });
        });


        $(document).ready(function () {
            $('#demo').steps();
        });

        $('.stp-nxt').on('click', function () {
            $('.btn-shop').css('display', 'none');
        });

        $('.btn-order').on('click', function () {
            $(this).parent().parent().parent().parent().find('.d-none').removeClass('d-none');
            $('.step-content, .step-footer').hide();
            $('#demo ul li:last-child a').css('color', '#0ab21b');


            $(".checkBox").change(function () {
                $(".checkBox").prop('checked', false);
                $(this).prop('checked', true);
            });


        });


        $(function () {
                $("#tabs").tabs();
                $("#tabs").tabs("option", {
                    "selected": 2,
                    "disabled": [1, 2, 3]
                });

                $("input[type=radio]").click(function () {
                    $('#tabs').tabs("enable", $(this).val());
                    $('#tabs').tabs("select", $(this).val());
                });

            }
        );


        $('input[name="intervaltype"]').click(function () {
            //jQuery handles UI toggling correctly when we apply "data-target" attributes and call .tab('show')
            //on the <li> elements' immediate children, e.g the <label> elements:
            $(this).closest('label').tab('show');
        });

    </script>



@endsection
