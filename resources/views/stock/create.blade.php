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
                               <h4 class="card-title">Add Product</h4>
                           </div>
                       </div>
                       <br>
                       @include('inc.msg')
                       <div class="card-body">
                        <form action="{{route('stock.store')}}" method="POST" data-toggle="validator" enctype="multipart/form-data">
                          
                               @csrf
                               <div class="row">
                                   <div class="col-md-6">                      
                                       <div class="form-group">
                                           <label>Product Name *</label>
                                           <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Product Name" name="name" value="{{old('name')}}" data-errors="Please Product Name." required="">
                                           @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                           <div class="help-block with-errors"></div>
                                       </div>
                                   </div>    
                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Category *</label>
                                       
                                        <select  class="selectpicker form-control @error('category_id') is-invalid @enderror" name="category_id" value="{{old('category_id')}}" id="category_id" data-style="py-0" required>
                                         <option value="">Select Category Type</option>

                                         @if (!empty($categories))
                                                                             
                                         @forelse ($categories as $category)
                                         
                                         <option
                                         value="{{ $category->id }}">{{ $category->categoryName }}
                                     </option>
                                     @empty
                                     <option value="">Category Not found, Add Category!</option>
                                     @endforelse
                                     @endif
                                     </select>
                                     @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Total Stock *</label>
                                        <input type="number" name="stock_alert" value="{{old('stock_alert')}}" class="form-control @error('stock_alert') is-invalid @enderror" placeholder="Enter Total Stock" data-errors="Please Enter Total Stock." required="">
                                        @error('stock_alert')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Supplier Price *</label>
                                        <input type="number" name="supplierprice" value="{{old('supplierprice')}}" class="form-control @error('supplierprice') is-invalid @enderror" placeholder="Enter Supplier Price" data-errors="Please Enter Supplier Price." required="">
                                        @error('supplierprice')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" class="form-control image-file @error('stock_img') is-invalid @enderror" name="stock_img" name="pic" accept="image/*">
                                        @error('stock_img')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                   <div class="col-md-6"> 
                                       <div class="form-group">
                                           <label>Expire Date *</label>
                                           <input type="date" name="expiredate" id="" class="form-control @error('expiredate') is-invalid @enderror" name="expiredate"  value="{{old('expiredate')}}" placeholder="Enter Code" data-errors="Please Enter Code.">
                                       </div>
                                       @error('expiredate')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                        @enderror
                                   </div> 
                                  
                                  
                                  
                                  
                                   <div class="col-md-12">
                                       <div class="form-group">
                                           <label>Description / Product Details</label>
                                           <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="4"></textarea>
                                           @error('description')
                                           <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                           </span>
                                       @enderror
                                       </div>
                                   </div>
                               </div>                            
                               <div class="float-right">
                                <button type="submit" class="btn btn-primary mr-2">Add Product</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                               </div>
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
