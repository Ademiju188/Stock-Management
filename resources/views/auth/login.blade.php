@extends('layouts.app')

@section('content')

<div class="wrapper">
    <section class="login-content">
       <div class="container">
          <div class="row align-items-center justify-content-center height-self-center">
             <div class="col-lg-8">
                <div class="card auth-card">
                   <div class="card-body p-0">
                      <div class="d-flex align-items-center auth-content">
                         <div class="col-lg-7 align-self-center">
                            <div class="p-3">
                               <h2 class="mb-2">Sign In</h2>
                               <p>Login to stay connected.</p>
                               <form method="POST" action="{{ route('login') }}">
                                @csrf
                                  <div class="row">
                                     <div class="col-lg-12">
                                        <div class="floating-label form-group">
                                           <input class="floating-input form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus type="email" placeholder=" ">
                                           <label>{{ __('E-Mail Address') }}</label>

                                           @error('email')
                                           <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                           </span>
                                        @enderror
                                        </div>
                                     </div>
                                     <div class="col-lg-12">
                                        <div class="floating-label form-group">
                                           <input class="floating-input form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" type="password" placeholder=" ">
                                           <label>{{ __('Password') }}</label>
                                           @error('password')
                                           <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                           </span>
                                       @enderror
                                        </div>
                                     </div>
                                     <div class="col-lg-6">
                                        <div class="custom-control custom-checkbox mb-3">
                                           <input type="checkbox" class="custom-control-input" id="customCheck1">
                                           <label class="custom-control-label control-label-1" for="customCheck1">Remember Me</label>
                                        </div>
                                     </div>
                                     <div class="col-lg-6">
                                        @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-primary float-right">{{ __('Forgot Your Password?') }}</a>
                                        @endif
                                     </div>
                                  </div>
                                  <button type="submit" class="btn btn-primary">Sign In</button>
                                  <p class="mt-3">
                                     Create an Account <a href="{{route('register')}}" class="text-primary">Sign Up</a>
                                  </p>
                               </form>
                            </div>
                         </div>
                         <div class="col-lg-5 content-right">
                            <img src="{{asset('assets/images/login/01.png')}}" class="img-fluid image-right" alt="">
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </section>
    </div>
@endsection
