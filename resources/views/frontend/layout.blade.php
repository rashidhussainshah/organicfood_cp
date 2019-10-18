<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@php echo isset($title)? $title : 'Organic Food'  @endphp</title>
    <link rel="stylesheet" href="{{asset('public/frontend_updated/css/bootstrap.min.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('public/frontend_updated/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend_updated/css/style.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('public/frontend_updated/css/all.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
       <!-- You can use Open Graph tags to customize link previews.
    Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
    @if (isset($former_profile_link) && isset($title) && ($farmer_about) && isset($former_profile_photo))
    <meta property="og:url"           content="{{ $former_profile_link }}" /> 
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="{{ $title }}" />
    <meta property="og:description"   content="{{ $farmer_about }}" />
    @if ($former_profile_photo != '')
        <meta property="og:image" content="{{ $former_profile_photo }}" /> 
    @else
       <meta property="og:image" content="{{ asset('public/frontend_updated/img/logo.png') }}"/> 
    @endif
    @else 
    
    
    @endif
    <style>
        .error {
            color: red !important;
        }
    </style>
</head>
<body>
<!-- header -->
@include('frontend.header')
@yield('banner')

<!-- Main content -->
@yield('content')
<!-- /.content -->


<!-- Download App section -->
@yield('download_app')
<!-- Footer -->
@include('frontend.footer')

@yield('js')

</body>
</html>
