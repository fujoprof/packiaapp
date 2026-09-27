@extends('layouts.app')

@section('content')
	<!-- Page container -->
	<div class="page-container login-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Registration form -->
					{!! Form::open(['route' => 'register.store', 'method' => 'post','files'=>'true']) !!}
						<div class="row">
							<div class="col-lg-6 col-lg-offset-3">
								<div class="panel registration-form">
									<div class="panel-body">
										<div class="text-center">
											<div class="icon-object border-success text-success"><i class="icon-plus3"></i></div>
											<h5 class="content-group-lg">Create account <small class="display-block">All fields are required</small></h5>
										</div>

										<div class="form-group has-feedback">
                                            <input id="username" type="text" placeholder="Choose Username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                            <div class="form-control-feedback">
												<i class="icon-user-plus text-muted"></i>
                                                @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group has-feedback">
                                                    <input id="first_name" type="text" placeholder="First Name" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
													<div class="form-control-feedback">
														<i class="icon-user-check text-muted"></i>
                                                        @error('first_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
												</div>
											</div>

											<div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <input id="middle_name" type="text" placeholder="Middle Name" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}" required autocomplete="middle_name" autofocus>
													<div class="form-control-feedback">
														<i class="icon-user-check text-muted"></i>
                                                        @error('middle_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <input id="last_name" type="text" placeholder="Last Name" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
													<div class="form-control-feedback">
														<i class="icon-user-check text-muted"></i>
                                                        @error('last_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
												</div>
											</div>

											<div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <input id="password" type="password" placeholder="Create Password" class="form-control @error('create_password') is-invalid @enderror" name="create_password" required autocomplete="create_password">
                                                    @error('create_password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <div class="form-control-feedback">
														<i class="icon-user-lock text-muted"></i>
													</div>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <input id="password" type="password" placeholder="Repeat Password" class="form-control @error('repeat_password') is-invalid @enderror" name="repeat_password" required autocomplete="repeat_password">
                                                    @error('repeat_password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <div class="form-control-feedback">
														<i class="icon-user-lock text-muted"></i>
													</div>
												</div>
											</div>

											<div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <input id="email" type="email" placeholder="Your email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                    <div class="form-control-feedback">
														<i class="icon-mention text-muted"></i>
													</div>
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
												</div>
											</div>
										</div>

										<div class="form-group">
											<div class="checkbox">
												<label>
													<input type="checkbox" class="styled" checked="checked">
													Send me <a href="#">test account settings</a>
												</label>
											</div>

											<div class="checkbox">
												<label>
													<input type="checkbox" class="styled">
													Accept <a href="#">terms of service</a>
												</label>
											</div>
										</div>

										<div class="text-right">
											<a href="{{ route('login.create') }}" class="btn btn-link"><i class="icon-arrow-left13 position-left"></i>{{ __('Login') }}</a>
											<button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-10"><b><i class="icon-plus3"></i></b>{{ __('Register') }}</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					{{!! Form::close() !!}}
					<!-- /registration form -->


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
