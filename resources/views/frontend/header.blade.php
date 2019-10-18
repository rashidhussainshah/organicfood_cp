<!-- Header of the page starts.. -->
<header class="w-100 fixed-top">
   <div class="w-100 bg-light-g">
      <div class="container container-header">
         <ul class="top-nav">
            <li><a href="#">Blog</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Help</a></li>
            {{--                
            <li class="dropdown">
               --}}
               {{--                    <a href="#" data-toggle="dropdown" class="dropdown-toggle drop-lang" aria-haspopup="true" aria-expanded="false">En <i class="fas fa-chevron-down"></i></a>--}}
               {{--                    
               <div class="dropdown-menu dropdown-menu-right">--}}
                  {{--                        <a class="dropdown-item" href="#">En</a>--}}
                  {{--                        <a class="dropdown-item" href="#">Fr</a>--}}
                  {{--                    
               </div>
               --}}
               {{--                
            </li>
            --}}
         </ul>
      </div>
   </div>
   <div class="w-100">
      <div class="container container-header">
         <div class="wrap-form">
            <div class="logo-wrapper">
               <div><a href="{{route('user.home')}}"><img src="{{asset('public/frontend_updated/img/logo.png')}}"></a></div>
            </div>
            <div class="row m-0">
               <form id="zip_form" method="get" class="form-horizontal form-zipcode col-md-6 col-12"
                  action="{{route('product.search_by_zip_code')}}">
                  {{--                        @csrf--}}
                  <div class="form-group m-0">
                     @if(!empty($_GET['zip_code']) && isset($_GET['zip_code']) )
                     @php $zipcode =$_GET['zip_code']; @endphp
                     <input type="text" required id="zip_code_input" name="zip_code" value="{{$zipcode}}"
                        class="form-control txt-box">
                     @else
                     <input type="text" required id="zip_code_input" name="zip_code"
                        class="form-control txt-box" placeholder="Enter Zip Code">
                     @endif
                     <input type="submit" id="zip_submit" style="display: none">
                  </div>
               </form>
               <div class="wrap-btns">
                   {{-- <h1>{{ Auth::guard('farmer')->user()->name }}</h1> --}}
                  @if(Auth::guard('user')->check())
                  
                  <div class="dropdown prof-form">
                     <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                     @if (Auth::guard('user')->user()->profile_photo != '')
                     <img class="rounded-circle user-profile-img" src="{{ asset(Auth::guard('user')->user()->profile_photo) }}" alt="Image User"><span>{{ Auth::guard('user')->user()->name }} 
                     @else
                     <img class="rounded-circle user-profile-img"  src="{{ asset('public/frontend_updated/img/prof-img.png') }}" alt="Image User"><span>{{ Auth::guard('user')->user()->name }}
                     @endif
                     </a>
                     <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">My Account</a>
                        <a  class="dropdown-item" href="{{ route('user_logout') }}">Logout</a>
                     </div>
                  </div>

                  @elseif(Auth::guard('farmer')->check())
                    <div class="dropdown prof-form">
                     <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                     @if (Auth::guard('farmer')->user()->profile_photo != '')
                     <img class="rounded-circle user-profile-img" src="{{ asset(Auth::guard('farmer')->user()->profile_photo) }}" alt="Image User"><span>{{ Auth::guard('farmer')->user()->name }} 
                     @else
                     <img class="rounded-circle user-profile-img"  src="{{ asset('public/frontend_updated/img/prof-img.png') }}" alt="Image User"><span>{{ Auth::guard('farmer')->user()->name }}
                     @endif
                     </a>
                     <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">My Account</a>
                        <a class="dropdown-item" href="#">Shop</a>
                        <a class="dropdown-item" href="{{ route('farmer.logout') }}">Logout</a>
                     </div>
                  </div>
                  @else
               <button type="button" class="btn" data-toggle="modal" data-target="#loginModal">Sign In</button>
               <button type="button" class="btn" data-toggle="modal" data-target="#signUpModal">Sign Up</button>
               @endif


               </div>

               
            </div>
         </div>
      </div>
   </div>
   </div>
   <div class="w-100 bg-primary nav-wrapper">
      <div class="container container-header">
         <div class="row m-0">
            <nav class="navbar navbar-expand-lg navbar-light pl-0">
               <button type="button" data-toggle="collapse" class="navbar-toggler" aria-expanded="false" data-target="#navigation"><span class="navbar-toggler-icon"><i class="fas fa-bars text-white"></i></span></button>
               <div class="collapse navbar-collapse" id="navigation">
                  <ul class="navbar-nav mr-auto">
                     @foreach($head_categories as $key=>$category)
                     <li class="nav-item <?= ($key == 0) ? 'active': '' ?>">
                        <a href="{{route('category.show', ['slug'=>$category->slug])}}" class="nav-link">{{$category->name}}</a>
                     </li>
                     @endforeach
                  </ul>
               </div>
            </nav>
            <div class="sec-bill align">
               <a href="{{route('cart.get_products')}}" class="d-inline-block"><img src="{{asset('public/frontend_updated/img/ico-case.png')}}" alt="icon-cart">
               <span id="cart_count_and_total">
               <span id="cart_count" data-count="{{Cart::count()}}">{{Cart::count()}}</span>  -  $<span id="cart_total" data-total="{{Cart::total()}}">{{Cart::total()}} </span> USD
               </span></a>
            </div>
         </div>
      </div>
   </div>
</header>