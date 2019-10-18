<?php
$current_id = '';
$current_name = '';
$current_user = '';
$current_user_type = '';
$current_photo = '';
$current_email = '';
if (Auth::user()) {
    $current_id = Auth::user()->id;
    $current_email = Auth::user()->email;
    $current_name = Auth::user()->name;
    $current_user = Auth::user();
    $current_user_type = Auth::user()->type;
    $current_photo = getUserImage($current_user->photo, $current_user->social_photo, $current_user->gender);
}
?>
