
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home | {{$site->site_name}} | Spicecorner.se</title>
    <meta charset="utf-8">
    <meta name="author" content="digimo.se"/>
    <meta name="design" content="digimo.se"/>
    <meta name="development" content="digimo.se"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="base-url" content="{{url('/')}}"/>
    <link rel="icon" href="{{asset('upload/favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('site/css/grid.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/camera.css')}}"/>
    <link rel="stylesheet" href="{{asset('site/css/touchTouch.css')}}"/>
    <script src="{{asset('site/js/jquery.js')}}"></script>
    <script src="{{asset('site/js/jquery-migrate-1.2.1.js')}}"></script>
    <!--[if (gt IE 9)|!(IE)]><!-->
    <script src="{{asset('site/js/jquery.mobile.customized.min.js')}}"></script>
    <!--<![endif]-->
    <script src="{{asset('site/js/camera.js')}}"></script>
    <script src="{{asset('site/js/jquery.equalheights.js')}}"></script>
    <script src="{{asset('site/js/touchTouch.js')}}"></script>

    <link rel="stylesheet" href="{{asset('site/css/contact-form.css')}}"/>
    {{-- <script src="{{asset('site/js/jquery.equalheights.js')}}"></script>
    <script src="{{asset('site/js/modal.js')}}"></script> --}}
    {{-- <script src="{{asset('site/js/TMForm.js')}}"></script> --}}
    <script src="{{asset('site/js/isotope.min.js')}}"></script>
    <!--[if lt IE 9]>
    <div id="ie6-alert" style="width: 100%; text-align:center; background: #232323;">
        <img src="https://beatie6.frontcube.com/images/ie6.jpg" alt="Upgrade IE 6" width="640" height="344" border="0"
             usemap="#Map" longdesc="https://die6.frontcube.com"/>
        <map name="Map" id="Map">
            <area shape="rect" coords="496,201,604,329"
                  href="https://www.microsoft.com/windows/internet-explorer/default.aspx" target="_blank"
                  alt="Download Interent Explorer"/>
            <area shape="rect" coords="380,201,488,329" href="https://www.apple.com/safari/download/" target="_blank"
                  alt="Download Apple Safari"/>
            <area shape="rect" coords="268,202,376,330" href="https://www.opera.com/download/" target="_blank"
                  alt="Download Opera"/>
            <area shape="rect" coords="155,202,263,330" href="https://www.mozilla.com/" target="_blank"
                  alt="Download Firefox"/>
            <area shape="rect" coords="35,201,143,329" href="https://www.google.com/chrome" target="_blank"
                  alt="Download Google Chrome"/>
        </map>
    </div>

    <script src="js/html5shiv.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="css/ie.css">
    <![endif]-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,500;1,700&display=swap');
      </style>
    {{-- <script src="https://www.google.com/recaptcha/api.js?render=6LfpNbgZAAAAACTZoYE2YEhomPS6ie1a11EbyrSv"></script> --}}
    @yield('css')
</head>

<body>

<!--========================================================
                          HEADER
=========================================================-->
 
@include('site.extra.menu')
<!--========================================================
                          CONTENT
=========================================================-->
@yield('content')


<!--========================================================
                          FOOTER
=========================================================-->
@include('site.extra.fotter')

<script src="{{asset('site/js/script.js')}}"></script>
@yield('js')
</body>

</html>