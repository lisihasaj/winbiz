<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicons/apple-touch-icon.png')}}">
        <link rel="icon" type="image/png" href="{{asset('images/favicons/favicon-32x32.png')}}" sizes="32x32">
        <link rel="icon" type="image/png" href="{{asset('images/favicons/favicon-16x16.png')}}" sizes="16x16">
        <link rel="manifest" href="{{asset('images/favicons/site.webmanifest')}}">
        <link rel="mask-icon" href="{{asset('images/safari-pinned-tab.svg')}}" color="#5bbad5">
        <meta name="theme-color" content="#ffffff">
        <meta property="og:image" content="{{asset('images/')}}"/>
        <meta property="og:title" content=""/>
        <meta property="og:type" content="website"/>
        <meta property="og:site_name" content="Winbiz"/>
        <meta property="og:description" content=""/>
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <title></title>
        <script type="text/javascript">
            const user = '{!! Auth::user() !!}';
            const url = '{!! asset("") !!}';
            const window_locales = '{!! $locales !!}';
            const currentAppLocale = '{!! App::getLocale() !!}';
        </script>
        @include('app.analytics')
    </head>
    <body>
        @include('app.analytics-nonscript')
        <div id="app"></div>
    </body>
    <script src="{{ mix('js/app-vendors.js') }}"> </script>
    <script src="{{ mix('js/app.js') }}"> </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPARvWJgV9mGHielY2FsBA1y1BGSU1OC4&libraries=places" type="text/javascript">
    </script>
</html>