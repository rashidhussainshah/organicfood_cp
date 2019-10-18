
<!-- Footer of the page Starts...  -->
<footer class="w-100 pt-xl-5 pb-xl-5 pt-3 pb-3">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-12 text-center text-xl-left">
                <div class="logo-footer w-100">
                    <a href='index.html'><img src="{{asset('public/frontend_updated/img/logo-footer.png')}}" alt="Organic Food"></a>
                </div>
            </div>
            <div class="col-xl-9 col-12 d-xl-flex justify-content-end nav-links">
                <ul class="list-inline col-xl-7 col-10 px-sm-3 px-0 mx-xl-0 mx-auto d-flex justify-content-between"
                    role="navigation">
                    <li class="list-inline-item"><a class="text-white" href="#">How it works</a></li>
                    <li class="list-inline-item"><a class="text-white" href="#">About</a></li>
                    <li class="list-inline-item"><a class="text-white" href="#">Help</a></li>
                    <li class="list-inline-item"><a class="text-white" href="#">FAQ</a></li>
                    <li class="list-inline-item"><a class="text-white" href="#">Contact</a></li>
                </ul>
                <ul class="social-networks list-inline col-xl-2 col-4 d-flex justify-content-between mx-xl-3 mx-auto my-xl-0 mt-2">
                    <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>


<!-- Notification Modal -->
<div class="toast" style="position: fixed; bottom: 50px; left: 1rem;">
    <div class="toast-header">
        <img src="{{asset('public/frontend_updated/img/logo.png')}}" style="width: 100px; height: auto;" class="rounded mr-2" alt="logo organicfood">
        <strong class="mr-auto">Notification</strong>
{{--        <small>11 mins ago</small>--}}
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body" id="notificatoin_message">
        Thank you for signing up with us!
    </div>
</div>

<!-- Sign In Modal Starts.. -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle"
     aria-hidden="true">
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
                    <div class="alert alert-danger ajax-msg-danger" style="display: none">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times</a>
                        <span class="ajax-body-danger"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">E-mail address</label>
                        <input id="email" type="email" name="email" class="form-control" placeholder="myemail@gmail.com"
                               required autocomplete="email" autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" class="form-control"
                               placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                    </div>
                    <div class="form-group mb-4 txt-forget">
                        <p>Forget your password? <a href="javascript:void(0)" data-toggle='modal' data-target='#resetModal' data-dismiss="modal">Reset Now</a></p>
                    </div>
                    <button type="button" id="user_login_btn" class="btn btn-block mb-4 btn-primary">Sign In</button>
                    <div class="form-group mb-5">
                        <p><span>Log in with </span> <a href="{{route('facebook.login')}}"
                                                       class="d-inline-block mr-3 ico-fb rounded-circle"><i
                                    class="fab fa-facebook-f"></i></a><a href="{{route('google.login')}}"
                                                                         class="d-inline-block rounded-circle ico-twitter"><i
                                    class="fab fa-google"></i></a></p>
                    </div>
                    <a href="#" class="btn btn-signUpAcc" role="button">Create Account</a>
                </form>
            </div>
            <div class="modal-footer border-0 text-center pt-0 pl-5 pr-5 pb-5">
                <p>OrganicFood uses Google ReCaptcha and users are subject to Google’s <a href="#">privacy policy</a>
                    &amp; <a href="#">terms</a>.</p>
            </div>
        </div>
    </div>
</div>
<!--Reset Modal..-->
<!--Reset Modal password..-->
<div class="modal fade" id="resetpassword" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-uppercase txt-title" id="loginModalTitle">Reset Password</h5>
                <button type="button" class="close text-white btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true text-danger"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form form-details" id="form-signIn" action="#">
                       <input type="hidden" id="token_p" class="modal-forgotpass-content" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" id='token_f' name="token" value="{{ isset($token)?$token:'' }}">
                    <div class="alert alert-danger ajax-msg-danger" style="display: none">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times</a>
                        <span class="ajax-body-danger"></span>
                    </div>
                
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                    <input id="password_p" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="password">

                                       </div>
                   <div class="form-group mb-3">
                        <label for="password">Confirm Password</label>
                       <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
                                                         </div>
                    <button type="button" id="user_login_btn" class="btn btn-block mb-4 btn-primary reset_p">Reset</button>
              
                </form>
            </div>
            <div class="modal-footer border-0 text-center pt-0 pl-5 pr-5 pb-5">
                <p>OrganicFood uses Google ReCaptcha and users are subject to Google’s <a href="#">privacy policy</a>
                    &amp; <a href="#">terms</a>.</p>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-uppercase txt-title" id="loginModalTitle">Reset</h5>
                <button type="button" class="close text-white btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true text-danger"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form form-details" id="form-signIn" action="#">
                    <div class="alert alert-danger ajax-msg-danger" style="display: none">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times</a>
                        <span class="ajax-body-danger"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">E-mail address</label>
                        <input id="email_reset" type="email" name="email" class="form-control" placeholder="myemail@gmail.com"
                               required autocomplete="email" autofocus>
                        <input type='hidden' name='_token' id='token' value='{{csrf_token()}}'>
                    </div>
                 
                    
                    <button type="button" id="reset_btn" class="btn btn-block mb-4 btn-primary reset">Reset</button>
               
                 
                </form>
            </div>
            <div class="modal-footer border-0 text-center pt-0 pl-5 pr-5 pb-5">
                <p>OrganicFood uses Google ReCaptcha and users are subject to Google’s <a href="#">privacy policy</a>
                    &amp; <a href="#">terms</a>.</p>
            </div>
        </div>
    </div>
</div>
<!-- Sign Up Modal Starts.. -->
<div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="signupModalTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-uppercase txt-title" id="signupModalTitle">Sign Up</h5>
                <button type="button" class="close text-white btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true text-danger"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="user_register_form" class="form-horizontal pl-5 pr-5 pb-3 form-details" action="#">
                    <!--Error Message-->
                    <div class="alert alert-danger  alert-dismissible ajax-msg-danger" style="display: none;">
                        <span class="ajax-body-danger"></span>
                    </div>
                    <!--Success Message-->
                    <div class="alert alert-success fade in alert-dismissible ajax-msg-success" style="display: none;">
                        <span class="ajax-body-success"></span>
                    </div>

                    {{--                    <h2>Delivery For:</h2>--}}
                    {{--                    <div class="form-row ml-0 mr-0 pl-3 pr-3">--}}
                    {{--                        <div class="custom-control custom-checkbox col-sm-3 col-12">--}}
                    {{--                            <input type="checkbox" name="chb" class="custom-control-input checkBox" id="customCheck1">--}}
                    {{--                            <label class="custom-control-label" for="customCheck1">Home</label>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="custom-control custom-checkbox col-sm-9 col-12">--}}
                    {{--                            <input type="checkbox" name="chb" class="custom-control-input checkBox" id="customCheck2">--}}
                    {{--                            <label class="custom-control-label" for="customCheck2">Business or School address</label>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    <input type="hidden" id="lat" name="lat">
                    <input type="hidden" id="long" name="long">
                    <div class="form-row mb-3">
                        <div class="form-group col-md-6">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Elijah">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Crawford">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="user_email">E-mail address</label>
                        <input id="user_email" name="email" type="email" class="form-control" placeholder="myemail@email.com">
                    </div>
                    <div class="form-group mb-3">
                        <label for="cell_num">Phone</label>
                        <input id="cell_num" name="phone" type="tel" class="form-control" placeholder="+1 123 456 789">
                    </div>
                    <div class="form-group mb-3">
                        <label for="user_password">Password</label>
                        <input id="user_password" name="password" type="password" class="form-control"
                               placeholder="&#9679&#9679&#9679&#9679&#9679&#9679&#9679&#9679">
                    </div>
                    <div class="form-group mb-3">
                        <label for="user_password-confirm">Repeat Password</label>
                        <input id="user_password-confirm" name="confirm_password" type="password" class="form-control"
                               placeholder="&#9679&#9679&#9679&#9679&#9679&#9679&#9679&#9679&#9679&#9679">
                    </div>
                    <button type="submit" id="user_registration_btn" class="btn btn-block mb-4 btn-primary">Sign Up</button>
                    <div class="form-group mb-5">
                        <p><span class="text-uppercase mr-3">Sign Up with</span> <a href="{{route('facebook.login')}}"
                                                                                    class="d-inline-block mr-3 ico-fb rounded-circle"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a href="{{route('google.login')}}"
                                                                         class="d-inline-block rounded-circle ico-twitter"><i
                                    class="fab fa-google"></i></a></p>
                    </div>
                    <a href="#" class="btn btn-signUpAcc" role="button">Already have an account? Sign in</a>
                </form>
            </div>
            <div class="modal-footer border-0 text-center pt-0 pl-5 pr-5 pb-5">
                <p>OrganicFood uses Google ReCaptcha and users are subject to Google’s <a href="#">privacy policy</a>
                    &amp; <a href="#">terms</a>.</p>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="{{asset('public/frontend_updated/js/jquery-slim.min.js')}}"></script>
<script src="{{asset('public/frontend_updated/js/jquery.min.js')}}"></script>
<script src="{{asset('public/frontend_updated/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public/frontend_updated/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/frontend_updated/js/slick.js')}}"></script>
<!-- For Jquery Validation -->
<script src="{{asset('public/frontend_updated/js/jquery.validate.min.js')}}"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
   
{{-- loader --}}
    {{-- <script>
        $('body').append('<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>');
        $(window).on('load', function () {
            setTimeout(removeLoader, 1000); //wait for page load PLUS two seconds.
        });
        function removeLoader() {
            $("#loadingDiv").hide(10000, function () {
                // fadeOut complete. Remove the loading div
                $("#loadingDiv").remove(); //makes page more lightweight 
            });
        }
    </script> --}}

<script>
    $('.dropdown-menu a').click(function () {
        $('a.dropdown-toggle').text($(this).text());
        $('a.dropdown-toggle').val($(this).text()).addClass('add')
            .append('<i class="fas fa-chevron-down"></i>');
    });

    //slick slider initiator
    $(document).ready(function () {
    $('body').on('click', '.reset_p', function (e) {
                e.preventDefault();
                var fd = new FormData();
//
                fd.append('_token', $("#token_p").val());
                fd.append('token', $("#token_f").val());
                fd.append('email', $("#email_p").val());
                fd.append('password', $("#password_p").val());
                fd.append('password_confirmation', $("#password-confirm").val());

                $.ajax({
                    url: "<?= asset('reset_password') ?>",
                    data: fd,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if(data.success)
                        {
                          $('.ajax-msg-danger').show();
                            $(".ajax-msg-danger").removeClass("alert-danger");
                            $(".ajax-msg-danger").addClass("alert-success");
                            $(".ajax-body-danger").html(data.message);
                        setTimeout(function () {
                                   window.location.href = '<?=asset('/');?>';
                                }, 3000)
                    }else{
                $('.ajax-msg-danger').show();
                            $(".ajax-msg-danger").addClass("alert-danger");
                            $(".ajax-msg-danger").removeClass("alert-success");
                            $(".ajax-body-danger").html(data.message);
                    }
                    },
                    error: function (e) {
                        if (e.responseJSON.errors.email) {

                            $('ul li:first-child').remove();
                            $("#show_message_forgot ul").append('<li><div class="alert alert-danger  in alert-dismissible ajax-label" ><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">x</a><span class="ajax-label-body">' + e.responseJSON.errors.email[0] + '</span></div></li>');
                        } else {

                            $('ul li:first-child').remove();
                            $("#show_message_forgot ul").append('<li><div class="alert alert-danger  in alert-dismissible ajax-label" ><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">x</a><span class="ajax-label-body">' + e.responseJSON.errors.password[0] + '</span></div></li>');
                        }

                    }
                });
            });
     $('body').on('click', '.reset', function (e) {
                e.preventDefault();
                var fd = new FormData();

                fd.append('_token', $("#token").val());
                fd.append('email', $("#email_reset").val());

                $.ajax({
                    url: "<?= asset('sendforget') ?>",
                    data: fd,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data.success)
                        {
                            $('.ajax-msg-danger').show();
                            $(".ajax-msg-danger").removeClass("alert-danger");
                            $(".ajax-msg-danger").addClass("alert-success");
                            $(".ajax-body-danger").html(data.message);
                              setTimeout(function () {
                                   window.location.href ='<?=asset('/')?>';
                                }, 3000)
                        } else {
                            $('.ajax-msg-danger').show();
                            $(".ajax-msg-danger").addClass("alert-danger");
                            $(".ajax-msg-danger").removeClass("alert-success");
                            $(".ajax-body-danger").html(data.message);
                        }
                    },
                    error: function (e) {
                        $('ul li:first-child').remove();
                        $("#show_message_for ul").append('<li><div class="alert alert-danger  in alert-dismissible ajax-label" ><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">x</a><span class="ajax-label-body">' + e.responseJSON.errors.email[0] + '</span></div></li>');
                    }
                });
            });
        //submit zip form while enter
        $('#submit_zip_form').keypress(function (e) {
            if(e.which == 13)
            {
                $('#zip_submit').trigger('click')
            }

        });

        $('.your-class').slick({

            centerMode: true,
            centerPadding: '80px',
            slidesToShow: 4,
            arrows: false,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '120px',
                        autoplay: true,
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        autoplay: true,
                        centerPadding: '40px',
                        slidesToShow: 1
                    }
                }
            ]

        });

    });
    $(".checkBox").change(function () {
        $(".checkBox").prop('checked', false);
        $(this).prop('checked', true);
    });

</script>
        <?php if (isset($reset_model_open)) { ?>

        <script>

            //
            $(document).ready(function () {

                $('#resetpassword').modal('show');
            });

        </script>

    <?php } ?>
<script>
    //slick slider initiator
    $(document).ready(function () {
        //user login
        $('#user_login_btn').click(function (event) {
            event.preventDefault();
            //get values from input fields
            var email, password;
            email = $('#email').val();
            password = $('#password').val();

            $.ajax({
                url: "<?= asset('/user/login');?>",
                data: {
                    '_token': '<?= csrf_token(); ?>',
                    email: email,
                    password: password,
                },
                type: "POST",
                success: function (success) {
                    window.location.href = success.redirect;
                    showNotification(success.message);

                }, error: function (err) {
                    // hide success messages
                    $('.ajax-msg-success').hide();
                    // show error message div
                    $('.ajax-msg-danger').show();
                    //empty if had already any value
                    $('.ajax-body-danger').empty();
                    $('#email').val('');
                    $('#password').val('');
                    $('.ajax-body-danger').append(err.responseJSON.message);

                }
            })

        });
        //user registration
        jQuery.validator.addMethod("phone", function (phone_number, element) {
            phone_number = phone_number.replace(/\s+/g, "");
            return this.optional(element) || phone_number.length > 0 &&
                phone_number.match(/^((\+)?[1-9]{1,2})?([-\s\.])?((\(\d{1,4}\))|\d{1,4})(([-\s\.])?[0-9]{1,12}){1,2}$/);
        }, "Please enter a valid phone number");
        $("#user_register_form").submit(function (event) {
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
                    phone:true
                }
            },

            submitHandler: function (form) {
                //get values from input fields
                var name, email, password, password_confirmation, lat, long, cell_num;
                name = $('#first_name').val();
                name = name + ' ' + $('#last_name').val();
                email = $('#user_email').val();
                password = $('#user_password').val();
                password_confirmation = $('#user_password-confirm').val();
                cell_num = $('#cell_num').val();
                lat = $('#lat').val();
                long = $('#long').val();

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
                    },
                    type: "POST",
                    success: function (success) {
                        console.log(success);

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
                var name, email, password, password_confirmation, lat, long, cell_num;
                name = $('#first_name').val();
                name = name + ' ' + $('#last_name').val();
                email = $('#user_email').val();
                password = $('#user_password').val();
                password_confirmation = $('#user_password-confirm').val();
                cell_num = $('#cell_num').val();
                lat = $('#lat').val();
                long = $('#long').val();

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
                    },
                    type: "POST",
                    success: function (success) {
                        console.log(success);

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

    });

</script>
<!-- get lat long and append to hidden fields -->
<script>
    function getLatLongOfUser() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }

    }

    function showPosition(position) {
        var lat = position.coords.latitude;
        var long = position.coords.longitude;
        if(lat != null)
        {
            $('#lat').val(lat);
        }
        if(lat != null)
        {
            $('#long').val(long);
        }



    }
    window.onload = getLatLongOfUser;
</script>
<script>
    function showNotification(message)
    {
        $('.toast').toast({delay: 3000});
        $('#notificatoin_message').text(message);
        $('.toast').toast('show');
    }
</script>

@yield('javascript')

