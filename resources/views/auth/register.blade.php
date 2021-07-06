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
                               <h2 class="mb-2">Sign Up</h2>
                               <p>Create your POSDash account.</p>
                               @include('inc.msg')
                               <form method="POST" action="{{ route('register') }}">
                                 @csrf
                                  <div class="row">
                                     <div class="col-lg-6">
                                        <div class="floating-label form-group">
                                           <input class="floating-input form-control  @error('name') is-invalid @enderror" type="text" placeholder=" " name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                           <label>{{ __('Name') }}</label>
                                          </div>
                                          @error('name')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                         @enderror
                                     </div>
                                     <div class="col-lg-6">
                                       <div class="floating-label form-group">
                                          <input class="floating-input form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" type="email" placeholder=" ">
                                          <label>{{ __('E-Mail Address') }}</label>
                                       </div>
                                    </div>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div class="col-lg-6">
                                       <div class="floating-label form-group">
                                          <input class="floating-input form-control  @error('mobile') is-invalid @enderror" required autocomplete="mobile" name="mobile"  type="number" type="text" placeholder=" " value="{{ old('mobile') }}">
                                          <label>{{__('Phone No.')}}</label>
                                       </div>
                                       @error('mobile')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                       @enderror
                                    </div>

                                     <div class="col-lg-6">
                                        <div class="floating-label form-group">
                                           <input class="floating-input form-control  @error('address') is-invalid @enderror" name="address" required autocomplete="address" type="text" placeholder=" " value="{{ old('address') }}">
                                           <label>{{__('Address')}}</label>
                                          </div>
                                          @error('address')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
                                     </div>
                                     <div class="col-lg-6">
                                        <div class="floating-label form-group">
                                           <input class="floating-input form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" type="password" placeholder=" ">
                                           <label>Password</label>
                                          </div>
                                          @error('password')
                                            <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                            </span>
                                         @enderror
                                     </div>
                                     <div class="col-lg-6">
                                        <div class="floating-label form-group">
                                           <input class="floating-input form-control" type="password"
                                           name="confirm_password" required autocomplete="new-password"
                                           placeholder=" ">
                                           <label>{{ __('Confirm Password') }}</label>
                                        </div>
                                     </div>
                                    
                                  </div>
                                  <button type="submit" class="btn btn-primary"> {{ __('Register') }}</button>
                                  <p class="mt-3">
                                     Already have an Account <a href="{{route('login')}}" class="text-primary">Sign In</a>
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
