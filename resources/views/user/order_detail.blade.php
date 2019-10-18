

@include("user.includes.head")
<main role="content" class="container-main container container-custom">
    @include("farmer.includes.header")

 <?php include resource_path('views/includes/messages.php'); ?>
    <div class="row">
        <h1>Order Detail</h1>
        <p>
            <span>ID:{{$order->id}} </span>
            <span><img class="mr-1" src="{{asset('public/frontend_updated/img/ico-cal.png')}}" alt="Icon calendar">{{isset($order->created_at)? date('d F, Y', strtotime($order->created_at)):''}}</span>
            <span><img class="mr-1" src="{{asset('public/frontend_updated/img/ico-user.png')}}" alt="Icon User"> {{$order->getOrder->getUser->name}}</span>
        </p>
        <div class="w-100 wrap-list">
            <ul class="order-listing list-unstyled w-100 mb-3">
                <li class="header-list">
                    <span>Order Item</span>
                    <span>Metric/Unit</span>
                    <span>Items</span>
                    <span>Price</span>
                </li>
                @if($order->getOrderProducts)
                @foreach($order->getOrderProducts as $product)
                <li>
                    <span>{{$product->getProduct->name}}</span>
                    <span>{{($product->getProduct->getUnit)? $product->getProduct->getUnit->name:''}}</span>
                    <span>{{$product->quantity}}</span>
                    <span>${{$product->price}} 
<!--                        <a href="#">
                            <img src="{{asset('public/frontend_updated/img/ico-times.png')}}" alt="Image Delete"></a>-->
                    </span>
                </li>
                @endforeach
                @endif
        
            </ul>
            <div class="row m-0 d-flex flex-row justify-content-end sec-total">
                <div class="w-25">
<!--                    <dl class="row m-0 w-100 mb-3">
                        <dt class="col-6">Shipping:</dt>
                        <dd class="col-6">$ 10.00</dd>

                    </dl>-->
                    <dl class="row m-0 w-100 mb-3">
                        <dt class="col-6">Total:</dt>
                        <dd class="col-6">$ {{$order->price}}</dd>
                    </dl>
                </div>
            </div>
        </div>
<!--        <div class="w-100 sec-delivery">
            <h2><img src="{{asset('public/frontend_updated/img/icon-delivery.png')}}" alt="Van Icon"> Delivery</h2>
            <ul class="list-inline">
                <li class="list-inline-item">
                    <div class="row mx-0">
                        <h3>Billing Details</h3>
                        <a href="#" class="btn-edit"><img src="{{asset('public/frontend_updated/img/ico-edit.png')}}" alt="Edit Info Icon"> Edit</a>
                    </div>
                    <p class="w-100 clearfix">Address: <br />1020 Foothil Blvd<br />La Crescenta<br />CA 46214,<br />United States</p>
                </li>
                <li class="list-inline-item">
                    <div class="row mx-0">
                        <h3>Shipping Details</h3>
                        <a href="#" class="btn-edit"><img src="{{asset('public/frontend_updated/img/ico-edit.png')}}" alt="Edit Info Icon"> Edit</a>
                    </div>
                    <p class="w-100 clearfix">Address:<br />1020 Foothil Blvd<br />La Crescenta<br />CA 46214,<br />United States</p>
                </li>
                <li class="list-inline-item">
                    <div class="row mx-0">
                        <h3>Contact Detail</h3>
                        <a href="#" class="btn-edit"><img src="{{asset('public/frontend_updated/img/ico-edit.png')}}" alt="Edit Info Icon"> Edit</a>
                    </div>
                    <p class="w-100 clearfix">Phone: +987 654 322<br />Email:  <a href="mailto:bruce.dixon@email.com">bruce.dixon@email.com</a></p>
                </li>
            </ul>
        </div>-->
<!--        <div class="w-100 form-area d-flex flex-row justify-content-end">
            <form class="form-inline" action="{{asset('farmer/farmer_order_status')}}" method="POST">
                <input type="hidden" name="id" value="{{$order->id}}"/>
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <div class="form-row">
                      @if($order->status!='trash')
                    <select name="status" class="form-control">
                      
                        <option value="processing" <?=($order->status=='processing')? 'selected':''?>>Processing</option>
                        <option value="onhold" <?=($order->status=='onhold')? 'selected':''?>>On hold</option>
                       <option value="completed" <?=($order->status=='completed')? 'selected':''?>>Completed</option>
                        <option value="cancelled" <?=($order->status=='cancelled')? 'selected':''?>>Cancelled</option>
                        <option value="trash" <?=($order->status=='trash')? 'selected':''?>>Trashed</option>
                    </select>
                  
                    <button type="submit" class="btn btn-dark">Save Order</button>
                    @endif
                </div>
            </form>
        </div>-->

    </div>
</main>


@include("user.includes.footer")
</body>
</html>