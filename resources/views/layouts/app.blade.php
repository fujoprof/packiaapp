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
    <div id="app">
        <!-- Main navbar -->
<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.html">
			{{ config('app.name', 'Laravel') }}
			<!-- <img src="assets/images/logo_light.png" alt=""> -->
            </a>

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
