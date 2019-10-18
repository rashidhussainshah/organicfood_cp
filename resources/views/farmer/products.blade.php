
<!-- Header of the page starts.. -->


@extends('farmer.dashboard_contents')
@section('content')        
<div class="container-main col-md-9 col-12">
    <div class="row ml-0 mr-0 mb-2 pt-4 panel-wrapper">
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
    <div class="row m-0 product-wrapper">
        <h3>Products</h3>

        <a href="{{url('farmer/add_products')}}" role="button" class="btn btn-crProduct">Add New Product</a>
    </div>
    <?php include resource_path('views/includes/messages.php'); ?>
    <div class="W-100 tabs-area add wrap-tabs">
        <nav class="nav nav-tabs w-100" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-allOrders-tab" data-toggle="tab" href="#nav-allOrders" role="tab" aria-controls="nav-allOrders" aria-selected="true"> All <span>({{$products_count}})</span></a>
            <a class="nav-item nav-link" id="nav-pbl-tab" data-toggle="tab" href="#nav-pbl" role="tab" aria-controls="nav-pbl" aria-selected="false">Published ({{$published_products_count}})</a>
            <a class="nav-item nav-link" id="nav-draft-tab" data-toggle="tab" href="#nav-draft" role="tab" aria-controls="nav-draft" aria-selected="false">Draft ({{$draft_products_count}})</a>
            <a class="nav-item nav-link" id="nav-trashed-tab" data-toggle="tab" href="#nav-trashed" role="tab" aria-controls="nav-trashed" aria-selected="false">Trash <span>({{$trash_products_count}})</span></a>
        </nav>
        <div class="tab-content">
            <div class="tab-pane active" id="nav-allOrders">
                <div class="wrap-table table-responsive">
                    <table id='products' class="table table-borderless table-orderlist add-table">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div class="custom-control custom-checkbox d-flex flex-row align-items-center">
                                        <input type="checkbox" class="custom-control-input" id="checkAll">
                                        <label class="custom-control-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th scope="col">
                                    Image
                                </th>
                                <th scope="col">Name</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Metric/Unit</th>
                                <th scope="col">Items</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($products)
                            @foreach($products as $product)
                            <tr>
                                <th scope="row">
                                    <div class="custom-control custom-checkbox d-flex flex-row align-items-center">
                                        <input type="checkbox" class="custom-control-input" id="checko">
                                        <label class="custom-control-label" for="checko"></label>
                                    </div>
                                </th>
                                <td>
                                    <div class="img-block">
                                        <img src="{{ asset(isset($product->getFeaturedImage)? $product->getFeaturedImage->path:'public\images\images.png')}}" alt="image avocados">
                                    </div>
                                </td>
                                <td><span class="d-block">{{$product->name}}</span></td>
                                <td>{{isset($product->created_at)? date('d F, Y', strtotime($product->created_at)):''}}</td>
                                <td>{{$product->getUnit->name}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>${{$product->price}}</td>
                                @if(empty($product->deleted_at))
                                <td>
                                    <div class="row m-0">
                                        <button type="button" class="btn btn-light" onclick="window.location.href = '{{asset('farmer/edit_products/'.$product->id)}}'"><img src="{{asset('public/frontend_updated/img/ico-view.png')}}" alt="View Icon"></button>
<!--                                        <button type="button" class="btn btn-light"><img src="{{asset('public/frontend_updated/img/ico-tick.png')}}" alt="View Accepted"></button>-->
                                        @if($product->orderProduct->isEmpty())
                                        <button type="button" class="btn btn-light" onclick="window.location.href = '{{asset('farmer/products_delete/'.$product->id)}}'"><img src="{{asset('public/frontend_updated/img/ico-trash.png')}}" alt="View Delete"></button>
                                        @else
                                        <button type="button" class="btn btn-light swal" ><img src="{{asset('public/frontend_updated/img/ico-trash.png')}}" alt="View Delete"></button>
                                        @endif
                                    </div>
                                </td>
                                @else
                                <td><span class="txt-danger" style="color: #ff0026; margin-left: 10px; display: inline-block;">Trashed</span></td>
                                @endif
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="nav-pbl">
                <div class="wrap-table">
                    <table id='published' class="table table-borderless table-orderlist add-table">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div class="custom-control custom-checkbox d-flex flex-row align-items-center">
                                        <input type="checkbox" class="custom-control-input" id="checkAll">
                                        <label class="custom-control-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th scope="col">
                                    Image
                                </th>
                                <th scope="col">Name</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Metric/Unit</th>
                                <th scope="col">Items</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if($published_products)
                            @foreach($published_products as $product)
                            <tr>
                                <th scope="row">
                                    <div class="custom-control custom-checkbox d-flex flex-row align-items-center">
                                        <input type="checkbox" class="custom-control-input" id="checko">
                                        <label class="custom-control-label" for="checko"></label>
                                    </div>
                                </th>
                                <td>
                                    <div class="img-block">
                                        <img src="{{ asset(isset($product->getFeaturedImage)? $product->getFeaturedImage->path:'public\images\images.png')}}" alt="image avocados">
                                    </div>
                                </td>
                                <td><span class="d-block">{{$product->name}}</span></td>
                                <td>{{isset($product->created_at)? date('d F, Y', strtotime($product->created_at)):''}}</td>
                                <td>{{$product->getUnit->name}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>${{$product->price}}</td>
                                <td>
                                    <div class="row m-0">
                                        <button type="button" class="btn btn-light" onclick="window.location.href = '{{asset('farmer/edit_products/'.$product->id)}}'"><img src="{{asset('public/frontend_updated/img/ico-view.png')}}" alt="View Icon"></button>
                                        <!--<button type="button" class="btn btn-light"><img src="{{asset('public/frontend_updated/img/ico-tick.png')}}" alt="View Accepted"></button>-->
                                     @if($product->orderProduct->isEmpty())
                                        <button type="button" class="btn btn-light" onclick="window.location.href = '{{asset('farmer/products_delete/'.$product->id)}}'"><img src="{{asset('public/frontend_updated/img/ico-trash.png')}}" alt="View Delete"></button>
                                        @else
                                        <button type="button" class="btn btn-light swal" ><img src="{{asset('public/frontend_updated/img/ico-trash.png')}}" alt="View Delete"></button>
                                        @endif   </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="nav-draft">
                <div class="wrap-table">
                    <table id='draft' class="table table-borderless table-orderlist add-table">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div class="custom-control custom-checkbox d-flex flex-row align-items-center">
                                        <input type="checkbox" class="custom-control-input" id="checkAll">
                                        <label class="custom-control-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th scope="col">
                                    Image
                                </th>
                                <th scope="col">Name</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Metric/Unit</th>
                                <th scope="col">Items</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($draft_products)
                            @foreach($draft_products as $product)
                            <tr>
                                <th scope="row">
                                    <div class="custom-control custom-checkbox d-flex flex-row align-items-center">
                                        <input type="checkbox" class="custom-control-input" id="checko">
                                        <label class="custom-control-label" for="checko"></label>
                                    </div>
                                </th>
                                <td>
                                    <div class="img-block">
                                        <img src="{{ asset(isset($product->getFeaturedImage)? $product->getFeaturedImage->path:'public\images\images.png')}}" alt="image avocados">
                                    </div>
                                </td>
                                <td><span class="d-block">{{$product->name}}</span></td>
                                <td>{{isset($product->created_at)? date('d F, Y', strtotime($product->created_at)):''}}</td>
                                <td>{{$product->getUnit->name}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>${{$product->price}}</td>
                                <td>
                                    <div class="row m-0">
                                        <button type="button" class="btn btn-light" onclick="window.location.href = '{{asset('farmer/edit_products/'.$product->id)}}'"><img src="{{asset('public/frontend_updated/img/ico-view.png')}}" alt="View Icon"></button>
                                        <!--<button type="button" class="btn btn-light"><img src="{{asset('public/frontend_updated/img/ico-tick.png')}}" alt="View Accepted"></button>-->
                                       @if($product->orderProduct->isEmpty())
                                        <button type="button" class="btn btn-light" onclick="window.location.href = '{{asset('farmer/products_delete/'.$product->id)}}'"><img src="{{asset('public/frontend_updated/img/ico-trash.png')}}" alt="View Delete"></button>
                                        @else
                                        <button type="button" class="btn btn-light swal" ><img src="{{asset('public/frontend_updated/img/ico-trash.png')}}" alt="View Delete"></button>
                                        @endif </div>
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
                    <table id='trash' class="table table-borderless table-orderlist add-table">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div class="custom-control custom-checkbox d-flex flex-row align-items-center">
                                        <input type="checkbox" class="custom-control-input" id="checkAll">
                                        <label class="custom-control-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th scope="col">
                                    Image
                                </th>
                                <th scope="col">Name</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Metric/Unit</th>
                                <th scope="col">Items</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($trash_products)
                            @foreach($trash_products as $product)
                            <tr>
                                <th scope="row">
                                    <div class="custom-control custom-checkbox d-flex flex-row align-items-center">
                                        <input type="checkbox" class="custom-control-input" id="checko">
                                        <label class="custom-control-label" for="checko"></label>
                                    </div>
                                </th>
                                <td>
                                    <div class="img-block">
                                        <img src="{{ asset(isset($product->getFeaturedImage)? $product->getFeaturedImage->path:'public\images\images.png')}}" alt="image avocados">
                                    </div>
                                </td>
                                <td><span class="d-block">{{$product->name}}</span></td>
                                <td>{{isset($product->created_at)? date('d F, Y', strtotime($product->created_at)):''}}</td>
                                <td>{{$product->getUnit->name}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>${{$product->price}}</td>
<!--                                <td>
                                    <div class="row m-0">
                                        <button type="button" class="btn btn-light" onclick="window.location.href = 'order-detail.html'"><img src="{{asset('public/frontend_updated/img/ico-view.png')}}" alt="View Icon"></button>
                                        <button type="button" class="btn btn-light"><img src="{{asset('public/frontend_updated/img/ico-tick.png')}}" alt="View Accepted"></button>
                                        <button type="button" class="btn btn-light"><img src="{{asset('public/frontend_updated/img/ico-trash.png')}}" alt="View Delete"></button>
                                    </div>
                                </td>-->
                                <td><span class="txt-danger" style="color: #ff0026; margin-left: 10px; display: inline-block;">Trashed</span></td>
                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--    <div class="pagination-wrapper w-100 row m-0">
            <div class="wrap-paging">
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
        </div>-->
</div>

@endsection
@section('javascript')
<script>
    $(document).ready(function() {
    $('.swal').on('click', function(){
       
    Swal.fire({
    type: 'error',
            title: 'Oops...',
            text: 'Order against this product you cannot delete this product!',
//            footer: '<a href>Why do I have this issue?</a>'
            })
    });
    $('#products').DataTable();
    $('#published').DataTable();
    $('#draft').DataTable();
    $('#trash').DataTable();
    });
</script>
@endsection