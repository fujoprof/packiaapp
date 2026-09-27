<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Start Metadata-->
    @include('layouts.templates.meta')
    <!-- End Metadata-->

    <!-- Start global style sheet -->
    @include('layouts.templates.css')
    <!-- End global style sheet -->

    <!-- Start global style sheet -->
    @include('layouts.templates.js')
    <!-- End global style sheet -->

</head>

<body>
    
    <!-- Start main navigation -->
    @include('layouts.templates.public_container')
    <!-- End main navigation --> 

</body>
</html>
