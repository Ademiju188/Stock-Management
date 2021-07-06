@extends('layouts.dash')
@section('content')
<div class="wrapper">
    <div class="content-page">
        
            <div class="container-fluid">
               <div class="row">
                   <div class="col-lg-12">
                       <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
                           <div>
                               <h4 class="mb-3">Supplier List</h4>
                               <p class="mb-0"></p>
                           </div>
                           <a href="{{route('supplier.create')}}" class="btn btn-primary add-list"><i class="fa fa-plus mr-3"></i>Add Supplier</a>
                       </div>
                   </div>
                   <br>
                   <div class="col-lg-12">
                      
                           @include('inc.msg')
                           
                       <div class="table-responsive rounded mb-3">
                        <table id="user-list-table" class="table table-striped  dataTable mt-4 tbl-server-info data-table" role="grid"  
                        aria-describedby="user-list-page-info">
                           <thead class="">
                            <tr class="ligth">
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Action</th>
                               </tr>
                           </thead>
                          
                           
                           <tbody class="ligth-body">
                           
                            @foreach ($suppliers as $key => $supplier)
    
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('/storage/supplier/'.$supplier->supplier_img) }}" class="img-fluid rounded avatar-50 mr-3" alt="image">
                                            
                                        </div>
                                    </td>
                                    <td>{{ $supplier->supplier_name }}</td>
                                    <td>{{ $supplier->email }}</td>
                                    <td>{{ $supplier->mobile }}</td>
                                    <td>{{ $supplier->address }}</td>
                                    <td>
                                        @if ($supplier->status == 1)
                                            <span class="badge bg-primary">ACTIVE</span>
                                        @else
                                            <span class="badge badge-danger">INACTIVE</span>
                                        @endif
                                    </td>
                                  
                                        <td>
                                            <div class="d-flex align-items-center list-action">
                                                
                                                <a class="badge bg-success mr-2" data-toggle="modal" data-placement="top" title="" data-original-title="Edit" data-target="#editSupplier{{ $supplier->id }}" href="#"><i class="fa fa-edit mr-0"></i></a>
                                                <a class="badge bg-warning mr-2" data-toggle="modal" data-placement="top" title="" data-original-title="Delete"  data-target="#DModal{{$supplier->id}}" href="#"><i class="fa fa-trash mr-0"></i></a>
                                            </div>
                                       
                                        {{-- <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editSupplier{{ $user->id }}"><i
                                                class="bx bxs-edit"></i>Edit</a>
                                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteUser{{ $user->id }}"><i
                                                class="bx bxs-trash"></i>Delete</a> --}}
                                    </td>
    
                                </tr>
    
                                @endforeach
                                </tbody>
    
    
                               
                        </tbody>
                       </table>
                       </div>
                   </div>
               </div>
               <!-- Page end  -->
           </div>
           @foreach($suppliers as $supplier)
           <!-- Modal Edit -->
           
             <div class="modal fade bd-example-modal-lg"  id="editSupplier{{ $supplier->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                           <div class="modal-content">
                            <div class="modal-body">
                           <div class="popup text-left">
                               <div class="media align-items-top justify-content-between">                            
                                   <h3 class="">Edit Supplier</h3>
                                   <div class="btn-cancel p-0" data-dismiss="modal"><i class="fa fa-times"></i></div>
                               </div>
                               <div class="content edit-notes">
                                   <div class="card card-transparent card-block card-stretch event-note mb-0">
                                       <div class="card-body px-0 bukmark">
                                           <div class="d-flex align-items-center justify-content-between pb-2 mb-3 border-bottom">                                                    
                                               <div class="quill-tool">
                                               </div>
                                           </div>
                                           <div id="quill-toolbar1">
                                            <form action="{{route('supplier.update', $supplier->id)}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('put')
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Name *</label>
                                                            <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Enter Name"
                                                               value="{{$supplier->supplier_name}}" required>
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
                                                              value="{{$supplier->email}}"  required="">
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
                                                              value="{{$supplier->mobile}}"  required="">
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
                                                            <label>Address *</label>
                                                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter address"
                                                              value="{{$supplier->address}}"  required="">
                                                            <div class="help-block with-errors"></div>
                                                            @error('address')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Status *</label>
                                                            <select class="selectpicker form-control" name="status" data-style="py-0" required>
                                                                <option value="">Select Status Type</option>
                                                                <option value="1" @if ($supplier->status == 1) selected @endif>ACTIVE
                                                                </option>
                                                                <option value="2" @if ($supplier->status == 2) selected @endif>
                                                                    INACTIVE</option>
                                                               
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>User Image *</label>
                                                            <img width="30" class="py-2"
                                                            src="{{ asset('/storage/supplier/'.$supplier->supplier_img) }}"
                                                            alt="">
                                                            <input type="file" class="form-control image-file border-start-0 @error('supplier_img') is-invalid @enderror"
                                                            name="supplier_img" placeholder="Choose Image">
                                                            <div class="help-block with-errors"></div>
                                                            @error('supplier_img')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        </div>
                                                    </div>
                                                    
                                                   
                                                </div>
                                                <button type="submit" class="btn btn-primary mr-2">Update</button>
                                                <button type="reset" class="btn btn-danger">Reset</button>
                                            </form>
                                           </div>
                                       </div>
                                       <div class="card-footer border-0">
                                           {{-- <div class="d-flex flex-wrap align-items-ceter justify-content-end">
                                               <div class="btn btn-primary mr-3" data-dismiss="modal">Cancel</div>
                                               <div class="btn btn-outline-primary" data-dismiss="modal">Save</div>
                                           </div> --}}
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
        @endforeach
           @foreach($suppliers as $supplier)
             
       <!-- Modal Edit -->
       <form action="{{route('supplier.destroy',  $supplier->id)}}" method="POST">
        @csrf
        @method('delete')
    <div class="modal fade" id="DModal{{$supplier->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="popup text-left">
                        <h4 class="mb-3">Deleting...</h4>
                        <hr>
                            <div class="content create-workform bg-body">
                                <div class="pb-3 text-center">
                                    <p class="text-danger">DELETE SUPPLIER</p>

                                    <h2>{{ $supplier->supplier_name }}</h2>
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                        <div class="btn btn-primary mr-4" data-dismiss="modal">Cancel</div>
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
       @endforeach





         </div>
</div>


@endsection