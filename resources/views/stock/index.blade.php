@extends('layouts.dash')
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
                        <div>
                            <h4 class="mb-3">Stock List</h4>
                            <p class="mb-0"></p>
                        </div>
                        <a href="{{ route('stock.create') }}" class="btn btn-primary add-list"><i
                                class="fa fa-plus mr-3"></i>Add Product</a>
                    </div>
                </div>
                <div class="col-lg-12">
                    <br>
                    @include('inc.msg')
                    <div class="table-responsive rounded mb-3">
                        <table class="data-table table mb-0 tbl-server-info table-bordered">
                            <thead class="bg-white text-uppercase">
                                <tr class="ligth ligth-data">
                                    <th>
                                        #
                                    </th>
                                    <th>Product</th>
                                    <th>Description</th>
                                    <th>Comments</th>
                                    <th>Category</th>
                                    <th>Supplier Price</th>
                                    <th>Expire Date</th>

                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @foreach ($stocks as $key => $stock)
                                <tbody class="ligth-body">
                                    <tr>
                                        <td>
                                            {{ $key + 1 }}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('/storage/stock/' . $stock->stock_img) }}"
                                                    class="img-fluid rounded avatar-50 mr-3" alt="image">
                                                <div>
                                                    {{ $stock->name }}
                                                    <p class="mb-0"><small></small></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td><a class="badge badge-info w-100" data-toggle="modal" data-placement="top"
                                                title="" data-original-title="View" data-target="#view{{ $stock->id }}"
                                                href="#"><i class="fa fa-eye mr-0"></i> View</a></td>
                                        <td><a class="badge badge-info w-100" data-toggle="modal" data-placement="top"
                                                title="" data-original-title="View"
                                                data-target="#comment{{ $stock->id }}" href="#"><i
                                                    class="fa fa-eye mr-0"></i> View</a></td>
                                        <td>
                                            @if (empty($stock->category->categoryName))
                                                No Category Selected
                                            @else
                                                {{ $stock->category->categoryName }}
                                            @endif
                                        </td>
                                        <td># {{ number_format($stock->supplierprice), 2 }}</td>

                                        <td>
                                            @if (empty($stock->expiredate))
                                                Not Applicable
                                            @else
                                                {{ $stock->expiredate }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($stock->stock_alert < 20)
                                                <span class="badge badge-danger">Low Stock = {{ $stock->stock_alert }}
                                                </span>
                                            @else
                                                <span class="badge badge-success">{{ $stock->stock_alert }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center list-action">

                                                <a class="badge bg-success mr-2" data-toggle="modal" data-placement="top"
                                                    title="" data-original-title="Edit"
                                                    data-target="#editStock{{ $stock->id }}" href="#"><i
                                                        class="fa fa-edit mr-0"></i></a>
                                                <a class="badge bg-warning mr-2" data-toggle="modal" data-placement="top"
                                                    title="" data-original-title="Delete"
                                                    data-target="#DModal{{ $stock->id }}" href="#"><i
                                                        class="fa fa-trash mr-0"></i></a>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <!-- Page end  -->
        </div>

        @foreach ($stocks as $stock)
            <!-- Modal Edit -->
            <div class="modal fade bd-example-modal-lg" id="editStock{{ $stock->id }}" tabindex="-1" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="popup text-left">
                                <div class="media align-items-top justify-content-between">
                                    <h3 class="">Edit Stock</h3>
                                    <div class="btn-cancel p-0" data-dismiss="modal"><i class="fa fa-times"></i></div>
                                </div>
                                <div class="content edit-notes">
                                    <div class="card card-transparent card-block card-stretch event-note mb-0">
                                        <div class="card-body px-0 bukmark">
                                            <div
                                                class="d-flex align-items-center justify-content-between pb-2 mb-3 border-bottom">
                                                <div class="quill-tool">
                                                </div>
                                            </div>
                                            <div id="quill-toolbar1">
                                                <form action="{{ route('stock.update', $stock->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('put')
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Product Name *</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Enter Product Name" name="name"
                                                                    data-errors="Please Product Name."
                                                                    value="{{ $stock->name }}" required="">
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="comments" value="null" id="">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Category *</label>

                                                                <select class="selectpicker form-control" name="category_id"
                                                                    id="category_id" data-style="py-0" required>
                                                                    <option value="">Select Category Type</option>
                                                                    @if (empty($stock->category->id))
                                                                    @else
                                                                        <option value="{{ $stock->category_id }}"
                                                                            {{ $stock->category->id == $stock->category_id ? 'selected' : '' }}>
                                                                            {{ $stock->category->categoryName }}
                                                                        </option>

                                                                    @endif
                                                                    @foreach ($categories as $category)
                                                                        <option value="{{ $category->id }}">
                                                                            {{ $category->categoryName }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Total Stock *</label>
                                                                <input type="number" name="stock_alert"
                                                                    value="{{ $stock->stock_alert }}" class="form-control"
                                                                    placeholder="Enter Total Stock"
                                                                    data-errors="Please Enter Total Stock." required="">
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Supplier Price *</label>
                                                                <input type="number" name="supplierprice"
                                                                    value="{{ $stock->supplierprice }}"
                                                                    class="form-control" placeholder="Enter Supplier Price"
                                                                    data-errors="Please Enter Supplier Price." required="">
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Image</label>
                                                                <input type="file" class="form-control image-file"
                                                                    name="stock_img" name="pic" accept="image/*">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Expire Date *</label>
                                                                <input type="date" name="expiredate" id=""
                                                                    class="form-control" name="expiredate"
                                                                    value="{{ $stock->expiredate }}"
                                                                    placeholder="Enter Code"
                                                                    data-errors="Please Enter Code.">
                                                            </div>
                                                        </div>


                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Description / Product Details</label>
                                                                <textarea class="form-control" name="description"
                                                                    rows="4">{{ $stock->description }}</textarea>
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

        @foreach ($stocks as $stock)

            <!-- Modal Edit -->
            <form action="{{ route('stock.destroy', $stock->id) }}" method="POST">
                @csrf
                @method('delete')
                <div class="modal fade" id="DModal{{ $stock->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="popup text-left">
                                    <h4 class="mb-3">Deleting...</h4>
                                    <hr>
                                    <div class="content create-workform bg-body">
                                        <div class="pb-3 text-center">
                                            <p class="text-danger">DELETE PRODUCT</p>

                                            <h2>{{ $stock->name }}</h2>
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

        @foreach ($stocks as $stock)

            <!-- Modal Edit -->
            <div class="modal fade" id="view{{ $stock->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="popup text-left">
                                <div class="media align-items-top justify-content-between">
                                    <h3 class="mb-1">Description</h3>
                                    <div class="btn-cancel p-0" data-dismiss="modal"><i class="fa fa-times"></i></div>
                                </div>
                                <div class="content edit-notes">
                                    <div class="card card-transparent card-block card-stretch event-note mb-0">
                                        <div class="card-body px-0 bukmark">
                                            <div
                                                class="d-flex align-items-center justify-content-between pb-2 mb-3 border-bottom">
                                                <div class="quill-tool">
                                                </div>
                                            </div>
                                            <div id="quill-toolbar1">


                                                @if (empty($stock->description))
                                                    Not Applicable
                                                @else
                                                    {{ $stock->description }}
                                                @endif

                                                </p>
                                            </div>
                                        </div>
                                        <div class="card-footer border-0">
                                            <div class="d-flex flex-wrap align-items-ceter justify-content-end">
                                                <div class="btn btn-primary mr-3" data-dismiss="modal">Close</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


        {{-- Comment Session --}}
        @foreach ($stocks as $stock)

            <!-- Modal Edit -->
            <div class="modal fade" id="comment{{ $stock->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="popup text-left">
                                <div class="media align-items-top justify-content-between">
                                    <h3 class="mb-1">Comment</h3>
                                    <div class="btn-cancel p-0" data-dismiss="modal"><i class="fa fa-times"></i></div>
                                </div>
                                <div class="content edit-notes">
                                    <div class="card card-transparent card-block card-stretch event-note mb-0">
                                        <div class="card-body px-0 bukmark">
                                            <div
                                                class="d-flex align-items-center justify-content-between pb-2 mb-3 border-bottom">
                                                <div class="quill-tool">
                                                </div>
                                            </div>
                                            <div id="quill-toolbar1">


                                                @if (empty($stock->comments))
                                                    Not Applicable
                                                @else
                                                    {{ $stock->comments }}
                                                @endif

                                                </p>
                                            </div>
                                        </div>
                                        <div class="card-footer border-0">
                                            <div class="d-flex flex-wrap align-items-ceter justify-content-end">
                                                <div class="btn btn-primary mr-3" data-dismiss="modal">Close</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach



    </div>
@endsection
