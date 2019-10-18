    <body>
    <!-- Header of the page starts.. -->
    <header class="w-100 fixed-top">
            <div class="w-100 bg-light-g">
                <div class="container container-header">
                    <ul class="top-nav">
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Help</a></li>
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle drop-lang" aria-haspopup="true" aria-expanded="false">En <i class="fas fa-chevron-down"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">En</a>
                                <a class="dropdown-item" href="#">Fr</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="w-100">
                <div class="container container-header">
                    <div class="wrap-form">
                        <div class="logo-wrapper">
                            <div><a href="index.html"><img src="{{asset('public/frontend_updated/img/logo.png')}}"></a></div>
                        </div>
                        <div class="row m-0">
                        <form class="form-horizontal form-zipcode col-md-6 col-12" action="#">
                            <div class="form-group m-0">
                            <input type="text" class="form-control txt-box" placeholder="Enter Zip Code">
                            </div>
                        </form>
                        <div class="wrap-btns">
                            <!--<button type="button" class="btn" data-toggle="modal" data-target="#loginModal">Sign In</button>-->
                            <a type="button" class="btn" href='{{route('farmer.logout')}}'>Logout</a>
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
                                <li class="nav-item active">
                                <a href="#" class="nav-link">Meals</a>
                                </li>
                                <li class="nav-item">
                                <a href="#" class="nav-link">Fruits</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Vegetables</a>
                                </li>
                                <li class="nav-item">
                                <a href="#" class="nav-link">Meat & Poultry</a>
                                </li>
                                <li class="nav-item">
                                <a href="#" class="nav-link">Dairy</a>
                                </li>
                                <li class="nav-item">
                                <a href="#" class="nav-link">Bakery & Pastry</a>
                                </li>
                                <li class="nav-item">
                                <a href="#" class="nav-link">Party Platters</a>
                                </li>
                            </ul>
                            </div>
                        </nav>
                        <div class="sec-bill">
                            <a href="#" class="d-inline-block"><img src="{{asset('public/frontend_updated/img/ico-case.png')}}" alt="icon-cart"> 2 - $230 USD</a>
                        </div>
                    </div>
                </div>
            </div>
    </header>