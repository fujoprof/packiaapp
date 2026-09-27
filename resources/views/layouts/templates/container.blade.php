<!-- Page container -->
<div class="page-container">

<!-- Page content -->
<div class="page-content">

	<!-- Start Main sidebar -->
	@include('layouts.templates.sidebar')
	<!-- End Main sidebar -->
	
	<!-- Main content -->
	<div class="content-wrapper">

		<!-- Page header -->
		@include('layouts.templates.header')
		<!-- /page header -->

		<!-- Content area -->
		<div class="content">

			<!-- Dashboard content -->
			@yield('content')
			<!-- /dashboard content -->


			<!-- Footer -->
			@include('layouts.templates.footer')
			<!-- /footer -->

		</div>
		<!-- /content area -->

	</div>
	<!-- /main content -->

</div>
<!-- /page content -->

</div>
<!-- /page container -->