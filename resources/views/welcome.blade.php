@extends('layouts.log')

@section('title', 'Login')

@section('content')
<!-- wrapper -->
	<div class="wrapper d-flex items-center justify-center min-h-screen">
		<div class="section-authentication-login d-flex align-items-center justify-content-center py-3">
			<div class="row mt-5">
				<div class="col-12 col-lg-10 mx-auto">
					<div class="card radius-15 rounded-lg shadow-lg">
						<div class="row no-gutters">
							<div class="col-lg-6">
								<img src="{{asset('images/logo-img.jpg')}}" class="card-img h-100" alt="...">
							</div>
							<div class="col-lg-6">
								<div class="card-body p-md-5">
									<div class="text-center"> 
										<h2 class="mt-4 font-weight-bold">Welcome to {{ config('app.name') }}</h2> 
                    					<p class="mb-8 text-gray-800">Book vet appointments seamlessly, manage your pets, and stay on top of care schedules.</p>
										<hr/>
									</div>
									<div class="login-separater text-center"> <span>LOGIN WITH YOUR CREDENTIALS</span>
										<hr/>
									</div>
									@if($errors->any())
										<p class="text-center"><strong style="text-transform: uppercase;color:red" >Invalid credentials. Please check your entry.</strong></p>
									@endif
									<form method="POST" action="{{ route('login') }}">
										@csrf
                                        <!-- Email -->
										                      <div class="form-group mt-4">
                                            <label for="email" class="form-label fw-bold">Email address</label>
                                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                                            @error('email') 
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
										                      </div>

                                        <!-- Password -->
										                    <div class="form-group">
                                            <label for="password" class="form-label fw-bold">Password</label> 
                                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="current-password" required>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
										                    </div>

                                        <!-- Remember Me -->
										                    <div class="form-row">
                                            <div class="form-group col">
                                                <div class="mb-3 form-check">
                                                    <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} checked>
                                                    <label class="form-check-label" for="remember">Remember Me</label>
                                                </div>
                                            </div>
										                      </div>

                                        <div class="btn-group d-grid mt-3">
                                            <button type="submit" class="btn btn-primary btn-block text-white btn-lg btn:hover:btn-info">
                                                Log In <i class="lni lni-enter"></i>
                                            </button>
                                        </div>
									  </form>
								</div>
                                <!-- Footer -->
                                <div class="card-footer text-muted text-center small">
                                    Only authorized users may log in. Contact your administrator for access.
                                </div>
							</div>
						</div>
						<!--end row-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
@endsection
