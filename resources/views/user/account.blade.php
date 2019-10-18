@extends('user.layout')
@section('content')  


<div id="main" class="col-lg-9 col-12">
    <div class="menu-icon">
        <i class="fas fa-bars"></i>
    </div>
    <div class="col-12 row m-0 form-settings order-list">
        <h2>Account Settings</h2>
        <form id='add_account' class="form-horizontal form-contact cr-prod" method='POST' action='{{asset('user/add_account')}}'>
            <div class="wrap-row">
                <?php include resource_path('views/includes/messages.php'); ?>
                <div class="row">

                    <div class="form-group mb-3 col-lg-6">
                        <label for="first-name">First Name<sup>*</sup></label>
                        <input type="text" name='first_name' class="form-control form-control-lg" id="first-name" placeholder="Elija" value='{{$user->name}}'>
                        <input type="hidden" name='_token' value='{{csrf_token()}}' class="form-control form-control-lg"placeholder="Elija">
                    </div>
                    <div class="form-group mb-3 col-lg-6">
                        <label for="last-name">Last Name<sup>*</sup></label>
                        <input type="text" name='last_name' value='{{$user->last_name}}'class="form-control form-control-lg" id="last-name" placeholder="Crawford">
                    </div>    
                </div>
                <div class="row">
                    <div class="form-group mb-3 col-lg-6">
                        <label for="email">Email<sup>*</sup></label>
                        <input type="email" name='email' value='{{$user->email}}' class="form-control form-control-lg" placeholder="myemail@email.com">
                    </div>
                    <div class="form-group mb-3 col-lg-6">
                        <label for="phone">Phone<sup>*</sup></label>
                        <input type="tel" name='phone' value='{{$user->phone}}' class="form-control form-control-lg" placeholder="+1 123 456 789">
                    </div>
                </div>

            </div>
            <div class="wrap-row">
                <h2>Shipping Address</h2>


                <div class="form-group mb-3">
                    <label for="address">Address<sup>*</sup></label>
                    <input id="address" name='address' value='{{$user->address}}' type="text" class="form-control form-control-lg" placeholder="Street address">
                </div>
                <div class="row">
                    <div class="form-group mb-3 col-lg-6">
                        <label for="country">Country<sup>*</sup></label>
                        <input id="country" name='country'value='{{$user->country}}'  type="text" class="form-control form-control-lg" placeholder="Country">

                    </div>
                    <div class="form-group mb-3 col-lg-6">
                        <label for="state">State<sup>*</sup></label>
                        <input id="administrative_area_level_1" value='{{$user->state}}'  name='state' type="text" class="form-control form-control-lg" placeholder="State">


                    </div>
                </div>
                <div class="row">
                    <div class="form-group mb-3 col-lg-6">
                        <label for="city">City<sup>*</sup></label>
                        <input id="locality" name='city'value='{{$user->city}}'  type="text" class="form-control form-control-lg" placeholder="city">
                    </div>
                    <div class="form-group mb-3 col-lg-6">
                        <label for="zip">Zip Code<sup>*</sup></label>
                        <input id="zip" name='zip' value='{{$user->zip_code}}' type="text" class="form-control form-control-lg" placeholder="Zip Code">


                    </div>
                </div>
                <input type="submit" role="button" class="btn btn-primary btn-save" value="Save">
            </div>
        </form>
        <form id='login_pasword_form' action='{{asset('user/update_password')}}' method='POST'>
            <div class="wrap-row">
                <h2>Change Password</h2>
                <div class="row">
                    <div class="form-group mb-3 col-lg-6">
                        <label for="old-pwd">Old Password<sup>*</sup></label>
                             <input type="hidden" name='_token' value='{{csrf_token()}}' class="form-control form-control-lg"placeholder="Elija">
                   
                        <input type="password" id='old_password' name='old_password' class="form-control form-control-lg" id="old-pwd" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                        <span style="display:none; color:red;" id="span_old_passowrd">Password incorrect</span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group mb-3 col-lg-6">
                        <label for="new-pwd">Enter New Password<sup>*</sup></label>
                        <input type="password" id='new_password' name='new_password' class="form-control form-control-lg" id="new-pwd" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                    </div>
                    <div class="form-group mb-3 col-lg-6">
                        <label for="rp-pwd">Repeat New Password<sup>*</sup></label>
                        <input type="password" id='password_confirmation' name='password_confirmation' class="form-control form-control-lg" id="rp-pwd" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                    </div>
                </div>
            </div>
            <input type="submit" role="button" class="btn btn-primary btn-save" id='pass_chng' value="Save">
        </form>
    </div>
</div>


@endsection
@section('js')
<script>
    $(document).ready(function () {
        $('#add_account').validate({// initialize the plugin
            rules: {
                first_name: {
                    required: true,
                },
                last_name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                },
                address: {
                    required: true,
                },
                zip: {
                    required: true,
                },
                city: {
                    required: true,
                },
                state: {
                    required: true,
                },
                country: {
                    required: true,
                },
                phone: {
//               phoneUS: true,
                    required: true,
//               minlength: 9,
//               maxlength: 12,
//               number : true,

                },
                detail: {
                    required: true,
//                minlength: 9
                },
//            profile_image: {
//                extension: "xls|csv",
//            },
            }
        });
        $('#old_password').on('change', function () {
//        alert($(this).val());

            passwrod = $(this).val();
            $.ajax({
                type: "Post",
                url: "<?= asset('user/check_password') ?>",
                data: {'password': passwrod, '_token': '<?= csrf_token(); ?>'},
                success: function (data) {

                    if (data == '1') {
                        $('#span_old_passowrd').show();
                        $("#new_password").prop("disabled", true);
                        $("#password_confirmation").prop("disabled", true);
                        $("#pass_chng").prop("disabled", true);
                    } else {
                        $('#span_old_passowrd').hide();
                        $("#new_password").prop("disabled", false);
                        $("#password_confirmation").prop("disabled", false);
                        $("#pass_chng").prop("disabled", false);
                        $('#login_pasword_form').validate({// initialize the plugin
                            rules: {
                                new_password: {
                                    required: true,
                                    minlength: 6,

                                },
                                password_confirmation: {
                                    required: true,
                                    minlength: 6,
                                    equalTo: "#new_password"

                                },
                            }
                        });
                    }
                }, error: function () {
                },
            });
        });
    });

    var placeSearch, autocomplete;
    var componentForm = {
//                                                        street_number: 'short_name',
//                                                        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
//                                                        postal_code: 'short_name'
    };
    function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('address')),
                {types: ['geocode']});


//        autocomplete = new google.maps.places.Autocomplete(
//                /** @type {!HTMLInputElement} */(document.getElementById('stateName')),
//                {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.


        autocomplete.addListener('place_changed', fillInAddress);
//                                                         autocomplete2.addListener('place_changed', fillInAddress2);


    }
    function fillInAddress() {

        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();
        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();

        $('#lat').val(lat);
        $('#long').val(lng);

//                                                        for (var component in componentForm) {
//                                                            document.getElementById(component).value = '';
//                                                            //          document.getElementById(component).disabled = false;
//                                                        } 
// 
        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];

            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
        }
    }

    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApyIRH_zIWZT32AXvIU2A2Y-A0fvPSv50&libraries=places&callback=initAutocomplete" async defer></script> 
@endsection


