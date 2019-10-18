        <aside class="sidenav col-lg-3 col-12">
                <div class="sidenav__close-icon">
                    <i class="fas fa-times"></i>
                </div>
                <ul class="sidenav__list">
                    <li class="nav-item head">My Account</li>
                    <li class="seperator"></li>
                    <li class="nav-item sub-head">Main Menu</li>
                    <li class="sidenav__list-item {{($tab=='orders')?'active':''}}"><a href="{{asset('user')}}"><img src="{{asset('public/frontend_updated/img/ico-order.png')}}" alt="icon order"><span>My Orders</span></a></li>
                    <li class="sidenav__list-item {{($tab=='account')?'active':''}}"><a href="{{asset('user/account')}}"><img src="{{asset('public/frontend_updated/img/ico-farm.png')}}" alt="icon order"><span>Settings</span></a></li>
                </ul>
            </aside>