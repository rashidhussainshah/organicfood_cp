@extends('layouts.user_layout')
@section('content')
    <div class="register-box-body">
        <p class="login-box-msg">Register a new user</p>

        <form action="{{route('user.register')}}" method="post" id="registration_form">
            <!--Error Message-->
            <div class="alert alert-danger fade in alert-dismissible ajax-msg-danger" style="display: none;">
                <span class="ajax-body-danger"></span>
            </div>
            <!--Success Message-->
            <div class="alert alert-success fade in alert-dismissible ajax-msg-success" style="display: none;">
                <span class="ajax-body-success"></span>
            </div>
            @csrf
            <?php
            if ($errors->any()) {
            foreach ($errors->all() as $error) {
            ?>
            <h6 class="alert alert-danger"> <?php echo $error ?></h6>
            <?php
            }
            }
            if (Session::has('error')) {
            ?>
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times</a>
                <?php echo Session::get('error') ?>
            </div>
            <?php } ?>
            <input type="hidden" id="lat" name="lat">
            <input type="hidden" id="long" name="long">
            <div class="form-group has-feedback">
                <input id="name" placeholder="Name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @error('name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="form-group has-feedback">
                <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="form-group has-feedback">
                <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="form-group has-feedback">
                <input id="password-confirm" placeholder="Retype Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> I agree to the <a href="#">terms</a>
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" id="submit_btn" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

{{--        <div class="social-auth-links text-center">--}}
{{--            <p>- OR -</p>--}}
{{--            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using--}}
{{--                Facebook</a>--}}
{{--            <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using--}}
{{--                Google+</a>--}}
{{--        </div>--}}

        <a href="{{route('login')}}" class="text-center">I already have a account</a>
    </div>
@endsection

@section('javascript')
    <script>
        $('#submit_btn').click(function (event) {
            event.preventDefault();
            //get values from input fields
            var name, email, password, password_confirmation, lat, long;
            name = $('#name').val();
            email = $('#email').val();
            password = $('#password').val();
            password_confirmation = $('#password-confirm').val();
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
                },
                type: "POST",
                success: function (success) {
                    var url = "<?= asset('/home');?>";
                    $(location).attr('href', url);

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

        });


    </script>
@endsection
