

    @include("farmer.includes.head")
    <main role="content" class="container-main container container-custom">
         @include("farmer.includes.header")
         <div class="row">
              @include("farmer.includes.sidebar")
                @yield("content")
         </div>
    </main>
    <!-- Footer of the page Starts...  -->
    
          
    <!-- Sign In Modal Starts.. -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header border-0">
            <h5 class="modal-title text-uppercase txt-title" id="loginModalTitle">Log in</h5>
            <button type="button" class="close text-white btn-close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true text-danger"><i class="fas fa-times"></i></span>
            </button>
        </div>
        <div class="modal-body">
            <form class="form form-details" id="form-signIn" action="#">
            <div class="form-group mb-3">
                <label for="e-address">E-mail address</label>
                <input id="e-address" type="text" class="form-control" placeholder="myemail@gmail.com">
            </div>
            <div class="form-group mb-3">
                <label for="pwd">Password</label>
                <input id="pwd" type="password" class="form-control" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
            </div>
            <div class="form-group mb-4 txt-forget">
                <p>Forget your password? <a href="#">Reset Now</a></p>
            </div>
            <button type="submit" class="btn btn-block mb-4 btn-primary">Sign In</button>
            <div class="form-group mb-5">
                <p><span>Log in with</span> <a href="#" class="d-inline-block mr-3 ico-fb rounded-circle"><i class="fab fa-facebook-f"></i></a><a href="#" class="d-inline-block rounded-circle ico-twitter"><i class="fab fa-twitter"></i></a></p>
            </div>
            <a href="#" class="btn btn-signUpAcc" role="button">Create Account</a>
            </form>
        </div>
        <div class="modal-footer border-0">
            <p>OrganicFood uses Google ReCaptcha and users are subject to Google’s <a href="#">privacy policy</a> &amp; <a href="#">terms</a>.</p>
        </div>
        </div>
    </div>
    </div>

    <!-- Sign Up Modal Starts.. -->
    <div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="signupModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header border-0">
            <h5 class="modal-title text-uppercase txt-title" id="signupModalTitle">Sign Up</h5>
            <button type="button" class="close text-white btn-close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true text-danger"><i class="fas fa-times"></i></span>
            </button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal form-details" action="#">
            <h2>Delivery For:</h2>
            <div class="form-row ml-0 mr-0 pl-3 pr-3">
                <div class="custom-control custom-checkbox col-sm-3 col-12">
                    <input type="checkbox" name="chb" class="custom-control-input checkBox" id="home-check">
                    <label class="custom-control-label" for="home-check">Home</label>
                </div>
                <div class="custom-control custom-checkbox col-sm-9 col-12">
                <input type="checkbox" name="chb" class="custom-control-input checkBox" id="business">
                    <label class="custom-control-label" for="business">Business or School address</label>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="first-name">First Name</label>
                    <input type="text" class="form-control" id="first-name" placeholder="Elijah">
                </div>
                <div class="form-group col-md-6">
                    <label for="last-name">Last Name</label>
                    <input type="text" class="form-control" id="last-name" placeholder="Crawford">
                </div>
                </div>
            <div class="form-group mb-3">
                <label for="email-add">E-mail address</label>
                <input id="email-add" type="email" class="form-control" placeholder="myemail@email.com">
            </div>
            <div class="form-group mb-3">
                <label for="cell-num">Phone</label>
                <input id="cell-num" type="tel" class="form-control" placeholder="+1 123 456 789">
            </div>
            <div class="form-group mb-3">
                <label for="pswd">Password</label>
                <input id="pswd" type="password" class="form-control" placeholder="&#9679&#9679&#9679&#9679&#9679&#9679&#9679&#9679">
            </div>
            <div class="form-group mb-3">
                <label for="r-pswd">Repeat Password</label>
                <input id="r-pswd" type="password" class="form-control" placeholder="&#9679&#9679&#9679&#9679&#9679&#9679&#9679&#9679&#9679&#9679">
            </div>
            <button type="submit" class="btn btn-block mb-4 btn-primary">Sign Up</button>
            <div class="form-group mb-5">
                <p><span class="text-uppercase mr-3">Sign Up with</span> <a href="#" class="d-inline-block mr-3 ico-fb rounded-circle"><i class="fab fa-facebook-f"></i></a><a href="#" class="d-inline-block rounded-circle ico-twitter"><i class="fab fa-twitter"></i></a></p>
            </div>
            <a href="#" class="btn btn-signUpAcc" role="button">Already have an account? Sign In</a>
            </form>
        </div>
        <div class="modal-footer border-0">
            <p>OrganicFood uses Google ReCaptcha and users are subject to Google’s <a href="#">privacy policy</a> &amp; <a href="#">terms</a>.</p>
        </div>
        </div>
    </div>
    </div>
  @include("farmer.includes.footer")
   @yield('javascript')
</body>
</html>