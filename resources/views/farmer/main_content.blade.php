
@extends('farmer.dashboard_contents')
@section('content')   
<div id="main" class="col-lg-9 col-12">
    <div class="menu-icon">
        <i class="fas fa-bars"></i>
    </div>
    <div class="col-12 row m-0">
        <h2>Business Overview</h2>
        <div class="btn-group dropDate ml-auto">
            <button class="btn btn-white border border-default dropdown-toggle" href="{{asset('farmer/calendar_orders')}}" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><img src="{{asset('public/frontend_updated/img/ico-cal.png')}}" alt="Calendar Icon"> {{(isset($days))?(($days=='10')?'Last 10 Days':(($days=='20')?'Last 20 Days':'Last 30 Days')):'Last 30 Days'}}</button>   
            <div class="dropdown-menu dropdown-menu-right" id="dropCal">
                <button class="dropdown-item" onclick="window.location.href = '{{asset('farmer/calendar_orders/30')}}'"> Last 30 Days</button>
                <button class="dropdown-item" onclick="window.location.href = '{{asset('farmer/calendar_orders/20')}}'"> Last 20 Days</button>
                <button class="dropdown-item" onclick="window.location.href = '{{asset('farmer/calendar_orders/10')}}'"> Last 10 Days</button>
            </div>
        </div>
        <div class="row ml-0 mr-0 mb-5 panel-wrapper">
            <div class="panel post">
                <a href="javascript:void();">Total Original Inventory<span>271</span></a>
            </div>
            <div class="panel comment">
                <a href="javascript:void();">Total Sold<span>86 </span></a>
            </div>
            <div class="panel page">
                <a href="javascript:void();">Total Available<span>143</span></a>
            </div>
        </div>
        <?php include resource_path('views/includes/messages.php'); ?>
        <div class="w-100 row m-0">
            <h3>New Orders</h3>
            <form class="form ml-md-auto order-search">
                <div class="form-group">
                    <input type="search" class="form-control" placeholder="Search Order">
                </div>
            </form>
        </div>
        <div class="wrap-table">
            <table id='dashboard' class="table table-borderless table-orderlist">
                <thead>
                    <tr>
<!--                        <th scope="col">
                            <div class="custom-control custom-checkbox d-flex flex-row align-items-center">
                                <input type="checkbox" class="custom-control-input" id="checkAll">
                                <label class="custom-control-label" for="checkAll"></label>
                            </div>
                        </th>-->
                        <th scope="col">Product</th>
                        <th scope="col">Date</th>
                        <th scope="col">Metric/Unit</th>
                        <th scope="col">Items</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($orders))
                    @foreach($orders as $order)
                    <tr>
<!--                        <th scope="row">
                            <div class="custom-control custom-checkbox d-flex flex-row align-items-center">
                                <input type="checkbox" class="custom-control-input" id="checko">
                                <label class="custom-control-label" for="checko"></label>
                            </div>
                        </th>-->
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
                            @else($order->status=='completed)
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
                                <button type="button" class="btn btn-light"><img src="{{asset('public/frontend_updated/img/ico-tick.png')}}" alt="View Accepted"></button>
                                <button type="button" class="btn btn-light" onclick="window.location.href = '{{asset('farmer/farmer_orders_delete/'.$order->id)}}'"><img src="{{asset('public/frontend_updated/img/ico-trash.png')}}" alt="View Delete"></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="row m-0 w-100">
           
            <div class="pagination-wrapper w-100 row m-0">
                <!--                <div class="wrap-paging">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <a class="page-link" href="#"><img src="{{asset('public/frontend_updated/img/btn-prevPage.png')}}" alt="pagination-arrow-left"></a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#"><img src="{{asset('public/frontend_updated/img/arrow-left.png')}}" alt="pagination-arrow-prev"></a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">...</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                       
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><img src="{{asset('public/frontend_updated/img/btn-nextPage.png')}}" alt="pagination-arrow-right"></a>
                                        </li>
                                    </ul>
                                </div>-->

                
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

        @endsection
        @section('javascript')
        <script>
                $(document).ready(function() {
    $('#dashboard').DataTable();
//    $('#published').DataTable();
//    $('#draft').DataTable();
//    $('#trash').DataTable();
} );
            </script>
        @endsection