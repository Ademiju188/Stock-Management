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
                               <h4 class="card-title">Add Supplier</h4>
                           </div>
                       </div>
                       <br>
                       @include('inc.msg')
                       <div class="card-body">
                           <form action="{{route('supplier.store')}}" method="POST"  data-toggle="validator"  enctype="multipart/form-data">
                            @csrf
                               <div class="row"> 
                                   <div class="col-md-6">                      
                                       <div class="form-group">
                                           <label>Name *</label>
                                           <input type="name" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter Name" value="{{old('name')}}" required="">
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
                                           <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email"  name="email" value="{{old('email')}}" required="">
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
                                           <input type="number" class="form-control @error('mobile') is-invalid @enderror" placeholder="Enter Phone Number" name="mobile" value="{{old('mobile')}}" required="">
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
                                           <label>Address</label>
                                           <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{old('address')}}" rows="0"></input>
                                       </div>
                                       <div class="help-block with-errors"></div>
                                       @error('address')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                        @enderror
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
                                           <div class="help-block with-errors"></div>
                                       
                                   </div> 
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Supplier Image *</label>
                                           <input type="file"
                                                    class="form-control image-file border-start-0 @error('supplier_img') is-invalid @enderror"
                                                    name="supplier_img" placeholder="Choose Image" />
                                                @error('supplier_img')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                           <div class="help-block with-errors"></div>
                                       </div>
                                   </div>

                               </div>                            
                               <button type="submit" class="btn btn-primary mr-2">Add Supplier</button>
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