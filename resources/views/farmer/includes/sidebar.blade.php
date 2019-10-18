        <aside class="sidenav col-lg-3 col-12">
                <div class="sidenav__close-icon">
                    <i class="fas fa-times"></i>
                </div>
                <ul class="sidenav__list">
                    <li class="nav-item head">My Business Page</li>
                    <li class="seperator"></li>
                    <li class="nav-item sub-head">Main Menu</li>
                    <li class="sidenav__list-item {{($tab=='dashboard')?'active':''}}"><a href="{{route('farmer.dashboard')}}"><img src="{{asset('public/frontend_updated/img/ico-dashboard.png')}}" alt="icon Dashboard"><span>Dashboard</span></a></li>
                    <li class="sidenav__list-item {{($tab=='orders')?'active':''}}"><a href="{{route('farmer.orders')}}"><img src="{{asset('public/frontend_updated/img/ico-order.png')}}" alt="icon order"><span>Orders</span></a></li>
                    <li class="sidenav__list-item {{($tab=='product')?'active':''}}" ><a href="{{route('farmer.products')}}"><img src="{{asset('public/frontend_updated/img/ico-products.png')}}" alt="icon products"><span>Products</span></a></li>
                    <li class="sidenav__list-item  {{($tab=='info')?'active':''}}" ><a href="{{route('farmer.info')}}"><img src="{{asset('public/frontend_updated/img/ico-farm.png')}}" alt="icon farm"><span>Farm Info</span></a></li>
                </ul>
            </aside>