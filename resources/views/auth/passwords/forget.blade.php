@extends('layouts.app')
	@include('auth.passwords.ajax.forget')
@section('content')

	<!-- Page container -->
	<div class="page-container login-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Password recovery -->
					{!! Form::open(['route' => 'forget-password.store', 'method' => 'post','files'=>'true']) !!}
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
								<h5 class="content-group">Password recovery <small class="display-block">We'll send OTP Code to your Phone-Number</small></h5>
							</div>

							<div class="form-group has-feedback" id="otp_section">
								<input type="phone" class="form-control" id="your_number" placeholder="Your registered phone-number">
								<div class="form-control-feedback">
									<i class="icon-phone text-muted"></i>
								</div>
							</div>
							
							<div class="form-group has-feedback" id="email_section" style="display:none;">
								<input type="email"  id="your_email" class="form-control" placeholder="Your registered email">
								<div class="form-control-feedback">
									<i class="icon-mail5 text-muted"></i>
								</div>
							</div>

							<button type="button" id="getotp" name="otp-btn" class="btn bg-blue btn-block">Get OTP <i class="icon-arrow-right14 position-right"></i></button>
							<button type="button" id="resetpassword" name="reset-btn" style="display:none;" class="btn bg-blue btn-block">Reset password <i class="icon-arrow-right14 position-right"></i></button>
						</div>
					{!! Form::close() !!}
					<!-- /password recovery -->

					<!-- Footer -->
					<div class="footer text-muted">
						&copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->
@endsection
