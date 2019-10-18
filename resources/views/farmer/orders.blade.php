@extends('farmer.dashboard_contents')
@section('content')  
<div id="main" class="col-lg-9 col-12">
    <div class="menu-icon">
        <i class="fas fa-bars"></i>
    </div>
    <div class="col-12 row m-0 order-list">
        <h2>Orders</h2>
        <div class="col-md-8 col-12 row m-0 ml-md-auto justify-content-end p-0">
            <div class="row col-12">
                <form class="form ml-md-auto order-search add col-md-7 col-12 p-0 m-0">
                    <div class="form-group">
                        <input type="search" class="form-control" placeholder="Search Order">
                    </div>
                </form>
                <div class="btn-group dropDate col-md-4 mt-md-0 mb-md-0">
                    <button class="btn btn-white border border-default dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{asset('public/frontend_updated/img/ico-cal.png')}}" alt="Calendar Icon">{{(isset($days))?(($days=='10')?'Last 10 Days':(($days=='20')?'Last 20 Days':'Last 30 Days')):'Last 30 Days'}}</button>   
                    <div class="dropdown-menu dropdown-menu-right" id="dropCal">
                        <button class="dropdown-item" onclick="window.location.href = '{{asset('farmer/calendar/30')}}'"> Last 30 Days</button>
                        <button class="dropdown-item"  onclick="window.location.href = '{{asset('farmer/calendar/20')}}'"> Last 20 Days</button>
                        <button class="dropdown-item"  onclick="window.location.href = '{{asset('farmer/calendar/10')}}'"> Last 10 Days</button>
                    </div>
                </div>
            </div>
        </div>
        <?php include resource_path('views/includes/messages.php'); ?>
        <div class="w-100 mb-5 tabs-area order-tab add mt-4">
            <nav class="nav nav-tabs w-100" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-allOrders-tab" data-toggle="tab" href="#nav-allOrders" role="tab" aria-controls="nav-allOrders" aria-selected="true"> All <span>({{$orders_count}})</span></a>
                <a class="nav-item nav-link" id="nav-trashed-tab" data-toggle="tab" href="#nav-trashed" role="tab" aria-controls="nav-trashed" aria-selected="false">Trash <span>({{$trashed_orders_count}})</span></a>
                <a class="nav-item nav-link" id="nav-prsng-tab" data-toggle="tab" href="#nav-prsng" role="tab" aria-controls="nav-prsng" aria-selected="false">Processing ({{$processing_orders_count}})</a>
                <a class="nav-item nav-link" id="nav-hold-tab" data-toggle="tab" href="#nav-hold" role="tab" aria-controls="nav-hold" aria-selected="false">On Hold ({{$onhold_orders_count}})</a>
                <a class="nav-item nav-link" id="nav-cancelled-tab" data-toggle="tab" href="#nav-cancelled" role="tab" aria-controls="nav-cancelled" aria-selected="false">Cancelled ({{$cancelled_orders_count}})</a>
            </nav>
            <div class="tab-content">
                <div class="tab-pane active" id="nav-allOrders">
                    <div class="wrap-table">
                        <table id="example" class="table table-borderless table-orderlist">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <div class="custom-control custom-checkbox d-flex flex-row align-items-center">
                                            <input type="checkbox" class="custom-control-input" id="checkAll">
                                            <label class="custom-control-label" for="checkAll"></label>
                                        </div>
                                    </th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Metric/Unit</th>
                                    <th scope="col">Items</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($orders)
                                @foreach($orders as $order)
                                <tr>
                                    <th scope="row">
                                        <div class="custom-control custom-checkbox d-flex flex-row align-items-center">
                                            <input type="checkbox" class="custom-control-input" id="checko">
                                            <label class="custom-control-label" for="checko"></label>
                                        </div>
                                    </th>
                                    <td>
                                        @foreach($order->getOrderProducts as $products)
                                        <span class="d-block">{{$products->getProduct->name}}</span> 
                                        @endforeach
                                        <a href="{{asset('farmer/farmer_orders_detail/'.$order->id)}}">{{$order->id}}</a>
                                         @if($order->status=='onhold')
                            <span class="txt-orange" style="color: #ff7c00; margin-left: 10px; display: inline-block;">On Hold</span>
                            @elseif($order->status=='processing')
                            <span class="txt-success" style="color: #00ba2a; margin-left: 10px; display: inline-block;">Processing</span>
                            @elseif($order->status=='cancelled')
                            <span class="txt-danger" style="color: #ff0026; margin-left: 10px; display: inline-block;">Cancelled</span>
                             @elseif($order->status=='trash')
                            <span class="txt-danger" style="color: #ff0026; margin-left: 10px; display: inline-block;">Trashed</span>
                            @else($order->status=='completed')
                            <span class="txt-success" style="color: #00ba2a; margin-left: 10px; display: inline-block;">Completed</span></td>
                            @endif
                                    <td>{{isset($order->created_at)? date('d F, Y', strtotime($order->created_at)):''}}</td>
                                    <td>
                                        @foreach($order->getOrderProducts as $products)
                                        {{($products->getProduct->getUnit)?$products->getProduct->getUnit->name:''}}
                                        @endforeach
                                    </td>
                                    <td>{{$order->quantity}}</td>
                                    <td>${{$order->price}}</td>
                                    <td>
                                        <div class="row m-0">
                                            <button type="button" class="btn btn-light" onclick="window.location.href = '{{asset('farmer/farmer_orders_detail/'.$order->id)}}'"><img src="{{asset('public/frontend_updated/img/ico-view.png')}}" alt="View Icon"></button>
                                         @if($order->status !='completed')
                                            <button type="button" class="btn btn-light order_complete" data-id='{{$order->id}}'><img src="{{asset('public/frontend_updated/img/ico-tick.png')}}" alt="View Accepted"></button>
                                           @endif     <button type="button" class="btn btn-light" onclick="window.location.href = '{{asset('farmer/farmer_orders_delete/'.$order->id)}}'"><img src="{{asset('public/frontend_updated/img/ico-trash.png')}}" alt="View Delete"></button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="nav-trashed">
                    <div class="wrap-table">
                        <table class="table table-borderless table-orderlist">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <div class="custom-control custom-checkbox d-flex flex-row align-items-center">
                                            <input type="checkbox" class="custom-control-input" id="checkAll">
                                            <label class="custom-control-label" for="checkAll"></label>
                                        </div>
                                    </th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Metric/Unit</th>
                                    <th scope="col">Items</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($trashed_orders)
                                @foreach($trashed_orders as $order)
                                <tr>
                                    <th scope="row">
                                        <div class="custom-control custom-checkbox d-flex flex-row align-items-center">
                                            <input type="checkbox" class="custom-control-input" id="checko">
                                            <label class="custom-control-label" for="checko"></label>
                                        </div>
                                    </th>
                                    <td>
                                        @foreach($order->getOrderProducts as $products)
                                        <span class="d-block">{{$products->getProduct->name}}</span> 
                                        @endforeach
                                        <a href="{{asset('farmer/farmer_orders_detail/'.$order->id)}}">{{$order->id}}</a></td>
                                    <td>{{isset($order->created_at)? date('d F, Y', strtotime($order->created_at)):''}}</td>
                                    <td>
                                        @foreach($order->getOrderProducts as $products)
                                        {{($products->getProduct->getUnit)?$products->getProduct->getUnit->name:''}}
                                        @endforeach
                                    </td>
                                    <td>{{$order->quantity}}</td>
                                    <td>${{$order->price}}</td>
                                    <td>
                                        <div class="row m-0">
<!--                                            <button type="button" class="btn btn-light" onclick="window.location.href = '{{asset('farmer/farmer_orders_detail/'.$order->id)}}'"><img src="{{asset('public/frontend_updated/img/ico-view.png')}}" alt="View Icon"></button>
                                         
                                            <button type="button" class="btn btn-light"><img src="{{asset('public/frontend_updated/img/ico-trash.png')}}" alt="View Delete"></button>-->
                                        <td><span class="txt-danger" style="color: #ff0026; margin-left: 10px; display: inline-block;">Trashed</span></td>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="nav-prsng">
                    <div class="wrap-table">
                        <table class="table table-borderless table-orderlist">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <div class="custom-control custom-checkbox d-flex flex-row align-items-center">
                                            <input type="checkbox" class="custom-control-input" id="checkAll">
                                            <label class="custom-control-label" for="checkAll"></label>
                                        </div>
                                    </th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Metric/Unit</th>
                                    <th scope="col">Items</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($processing_orders)
                                @foreach($processing_orders as $order)
                                <tr>
                                    <th scope="row">
                                        <div class="custom-control custom-checkbox d-flex flex-row align-items-center">
                                            <input type="checkbox" class="custom-control-input" id="checko">
                                            <label class="custom-control-label" for="checko"></label>
                                        </div>
                                    </th>
                                    <td>
                                        @foreach($order->getOrderProducts as $products)
                                        <span class="d-block">{{$products->getProduct->name}}</span> 
                                        @endforeach
                                        <a href="{{asset('farmer/farmer_orders_detail/'.$order->id)}}">{{$order->id}}</a></td>
                                    <td>{{isset($order->created_at)? date('d F, Y', strtotime($order->created_at)):''}}</td>
                                    <td>
                                        @foreach($order->getOrderProducts as $products)
                                        {{($products->getProduct->getUnit)?$products->getProduct->getUnit->name:''}}
                                        @endforeach
                                    </td>
                                    <td>{{$order->quantity}}</td>
                                    <td>${{$order->price}}</td>
                                    <td>
                                        <div class="row m-0">
                                            <button type="button" class="btn btn-light" onclick="window.location.href = '{{asset('farmer/farmer_orders_detail/'.$order->id)}}'"><img src="{{asset('public/frontend_updated/img/ico-view.png')}}" alt="View Icon"></button>
                                        @if($order->status !='completed')
                                            <button type="button" class="btn btn-light order_complete" data-id='{{$order->id}}'><img src="{{asset('public/frontend_updated/img/ico-tick.png')}}" alt="View Accepted"></button>
                                           @endif     <button type="button" class="btn btn-light"><img src="{{asset('public/frontend_updated/img/ico-trash.png')}}" alt="View Delete"></button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="nav-hold">
                    <div class="wrap-table">
                        <table class="table table-borderless table-orderlist">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <div class="custom-control custom-checkbox d-flex flex-row align-items-center">
                                            <input type="checkbox" class="custom-control-input" id="checkAll">
                                            <label class="custom-control-label" for="checkAll"></label>
                                        </div>
                                    </th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Metric/Unit</th>
                                    <th scope="col">Items</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($onhold_orders)
                                @foreach($onhold_orders as $order)
                                <tr>
                                    <th scope="row">
                                        <div class="custom-control custom-checkbox d-flex flex-row align-items-center">
                                            <input type="checkbox" class="custom-control-input" id="checko">
                                            <label class="custom-control-label" for="checko"></label>
                                        </div>
                                    </th>
                                    <td>
                                        @foreach($order->getOrderProducts as $products)
                                        <span class="d-block">{{$products->getProduct->name}}</span> 
                                        @endforeach
                                        <a href="{{asset('farmer/farmer_orders_detail/'.$order->id)}}">{{$order->id}}</a></td>
                                    <td>{{isset($order->created_at)? date('d F, Y', strtotime($order->created_at)):''}}</td>
                                    <td>
                                        @foreach($order->getOrderProducts as $products)
                                        {{($products->getProduct->getUnit)?$products->getProduct->getUnit->name:''}}
                                        @endforeach
                                    </td>
                                    <td>{{$order->quantity}}</td>
                                    <td>${{$order->price}}</td>
                                    <td>
                                        <div class="row m-0">
                                            <button type="button" class="btn btn-light" onclick="window.location.href = '{{asset('farmer/farmer_orders_detail/'.$order->id)}}'"><img src="{{asset('public/frontend_updated/img/ico-view.png')}}" alt="View Icon"></button>
                                      @if($order->status !='completed')
                                            <button type="button" class="btn btn-light order_complete" data-id='{{$order->id}}'><img src="{{asset('public/frontend_updated/img/ico-tick.png')}}" alt="View Accepted"></button>
                                           @endif       <button type="button" class="btn btn-light"><img src="{{asset('public/frontend_updated/img/ico-trash.png')}}" alt="View Delete"></button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="nav-cancelled">
                    <div class="wrap-table">
                        <table class="table table-borderless table-orderlist">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <div class="custom-control custom-checkbox d-flex flex-row align-items-center">
                                            <input type="checkbox" class="custom-control-input" id="checkAll">
                                            <label class="custom-control-label" for="checkAll"></label>
                                        </div>
                                    </th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Metric/Unit</th>
                                    <th scope="col">Items</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($cancelled_orders)
                                @foreach($cancelled_orders as $order)
                                <tr>
                                    <th scope="row">
                                        <div class="custom-control custom-checkbox d-flex flex-row align-items-center">
                                            <input type="checkbox" class="custom-control-input" id="checko">
                                            <label class="custom-control-label" for="checko"></label>
                                        </div>
                                    </th>
                                    <td>
                                        @foreach($order->getOrderProducts as $products)
                                        <span class="d-block">{{$products->getProduct->name}}</span> 
                                        @endforeach
                                        <a href="{{asset('farmer/farmer_orders_detail/'.$order->id)}}">{{$order->id}}</a></td>
                                    <td>{{isset($order->created_at)? date('d F, Y', strtotime($order->created_at)):''}}</td>
                                    <td>
                                        @foreach($order->getOrderProducts as $products)
                                        {{($products->getProduct->getUnit)?$products->getProduct->getUnit->name:''}}
                                        @endforeach
                                    </td>
                                    <td>{{$order->quantity}}</td>
                                    <td>${{$order->price}}</td>
                                    <td>
                                        <div class="row m-0">
                                            <button type="button" class="btn btn-light" onclick="window.location.href = '{{asset('farmer/farmer_orders_detail/'.$order->id)}}'"><img src="{{asset('public/frontend_updated/img/ico-view.png')}}" alt="View Icon"></button>
                                        @if($order->status !='completed')
                                            <button type="button" class="btn btn-light order_complete" data-id='{{$order->id}}'><img src="{{asset('public/frontend_updated/img/ico-tick.png')}}" alt="View Accepted"></button>
                                           @endif    <button type="button" class="btn btn-light"><img src="{{asset('public/frontend_updated/img/ico-trash.png')}}" alt="View Delete"></button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-100 row m-0">
            <div class="pagination-wrapper w-100 row m-0">
                <div class="wrap-paging">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#"><img src="{{asset('public/frontend_updated/img/btn-prevPage.png')}}" alt="pagination-arrow-left"></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#"><img src="{{asset('public/frontend_updated/img/arrow-left.png')}}" alt="pagination-arrow-prev"></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#"><img src="{{asset('public/frontend_updated/img/arrow-right.png')}}" alt="pagination-arrow-right"></a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#"><img src="{{asset('public/frontend_updated/img/btn-nextPage.png')}}" alt="pagination-arrow-right"></a>
                        </li>
                    </ul>
                </div>
                <div class="select-page">
                    <form class="form-inline">
                        <label>Results per page</label>
                        <select class="custom-select input-lg">
                            <option selected>10</option>
                            <option value="1">15</option>
                            <option value="2">20</option>
                            <option value="3">25</option>
                        </select>
                        <i class="fa fa-chevron-down"></i>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('javascript')
<script>
    $(document).ready(function(){
           $('body').on('click', '.order_complete', function () {

            $this = $(this);
            swal.fire({
                title: 'Are you sure?',
                text: "Do you want to complete this order!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then(function (result) {
                var id = $this.attr('data-id');

                if (result.value) {
                   $.ajax({
                        type: "POST",
                        url: "<?= asset('/farmer/complete_order') ?>",
                        data: {id: id, '_token': '<?= csrf_token(); ?>'},
                        dataType: 'json',
                        success: function (data) {
                       
                            Swal.fire({title: "Order completed",  type: "success"}).then(
                                    function () {
                                        location.reload();
                                    });
                        },
                        error: function (data) {
                            
                        }
                    });

                }

                // result.value will containt the input value
            })

        });
    });
    </script>
@endsection


