<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Sales software for small shop">
    <meta name="author" content="Md. Solaiman Khan">
    <meta name="keyword" content="sales,solaiman,khan,pos,software,small business">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Main styles for this application-->
    <link href="{{ asset("assets/font-awesome/all.min.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/coreui/coreui.min.css") }}" rel="stylesheet">
    {{--    <link href="{{ asset("css/app.css") }}" rel="stylesheet">--}}
    <link href="{{ asset("assets/pace-progress/pace-progress.css") }}" rel="stylesheet">
{{--    <link href="{{ asset("assets/sweetalert2/sweetalert2.min.css") }}" rel="stylesheet">--}}
{{--    <link href="{{ asset("assets/toastr/toastr.min.css") }}" rel="stylesheet">--}}
    <link href="{{ asset("assets/custom.css") }}" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    @include("layouts.top-script")
    @stack("header")
    @stack("scripts")
</head>
<body class="c-app">
@include("layouts.sidebar")
<div class="c-wrapper c-fixed-components">
    @include("layouts.navbar")
    <div class="c-body">
        @yield("content")
        <footer class="c-footer">
            <div><a href="https://coreui.io">CoreUI</a> © 2020 creativeLabs.</div>
            <div class="ml-auto">Powered by&nbsp;<a href="https://coreui.io/">CoreUI</a></div>
        </footer>
    </div>
    {{--      @include("layouts.aside-bar")--}}
</div>

<!-- CoreUI and necessary plugins-->
<script src="{{ asset("assets/coreui/coreui.bundle.min.js") }}"></script>
<script src="{{ asset("assets/coreui/coreui-utils.js") }}"></script>
<script src="{{ asset("assets/coreui/icon-svgxuse.min.js") }}"></script>
{{--<script src="{{ asset("assets/toastr/toastr.min.js") }}"></script>--}}
{{--<script src="{{ asset("assets/sweetalert2/sweetalert2.min.js") }}"></script>--}}
<script src="{{ asset("assets/pace-progress/pace-progress.min.js") }}"></script>
<script src="{{ asset("assets/font-awesome/all.js") }}"></script>
<script src="{{ asset("assets/axios.min.js") }}"></script>
<script src="{{ asset("assets/jquery351.min.js") }}"></script>
<script src="{{ asset("assets/vue.js") }}"></script>
<script src="{{ asset("assets/bootstrap/bootstrap.bundle.min.js") }}"></script>
@include("layouts.bottom-script")
@stack("footer")
</body>
</html>
