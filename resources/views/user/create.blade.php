@extends('layouts.dash')
@section('content')
    <div class="wrapper">
        <div class="content-page">
            <div class="container-fluid add-form-list">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Add Users</h4>
                                </div>
                            </div>
                             <br>
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                @include('inc.msg')
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="card-body">
                                <form action="{{route('user.store')}}" method="POST" data-toggle="validator" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name *</label>
                                                <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Enter Name"
                                                   value="{{old('name')}}" required>
                                                <div class="help-block with-errors"></div>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email *</label>
                                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email"
                                                  value="{{old('email')}}"  required="">
                                                <div class="help-block with-errors"></div>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone Number *</label>
                                                <input type="number" class="form-control" name="mobile" placeholder="Enter Phone No"
                                                  value="{{old('mobile')}}"  required="">
                                                <div class="help-block with-errors"></div>
                                                @error('mobile')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Role</label>
                                                <select name="is_admin" class="selectpicker form-control"
                                                    data-style="py-0" required>

                                                    <option value="">Select User Type</option>
                                                    <option value="1" {{ old('is_admin') == '1' ? 'selected' : '' }}>Admin
                                                    </option>
                                                    <option value="2" {{ old('is_admin') == '2' ? 'selected' : '' }}>Stock Keeper
                                                    </option>
                                                    <option value="3" {{ old('is_admin') == '3' ? 'selected' : '' }}>Manager
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Status *</label>
                                                <select class="selectpicker form-control" name="status" data-style="py-0" required>
                                                    <option value="">Select Status Type</option>
                                                    <option value="1" {{old('status') == "1" ? 'selected' : ''}}>Active</option>
                                                    <option value="2" {{old('status') == "2" ? 'selected' : ''}}>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>User Image *</label>
                                                <input type="file" class="form-control image-file border-start-0 @error('user_img') is-invalid @enderror"
                                                name="user_img" placeholder="Choose Image">
                                                <div class="help-block with-errors"></div>
                                                @error('user_img')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" value="{{old('password')}}"  placeholder="Enter Password"
                                                    required="">
                                                <div class="help-block with-errors"></div>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" class="form-control  @error('confirm_password') is-invalid @enderror" name="confirm_password" value="{{old('confirm_password')}}" placeholder="Enter Confirm Password"
                                                    required="">
                                                <div class="help-block with-errors"></div>
                                                @error('confirm_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                        </div>
                                       
                                       
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Register</button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page end  -->
            </div>
        </div>
    </div>

@endsection
