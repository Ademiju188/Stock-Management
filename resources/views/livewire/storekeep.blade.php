<div>

    <div class="row">
        <div class="card-body">
            @include('inc.msg')
            <form action="page-list-category.html" data-toggle="validator">
                @if (!empty($store))
                    <div class="table-responsive">
                        <table id="example2" class="data-table table table-striped table-bordered mb-0 tbl-server-info">
                            <thead>
                                <tr>
                                    <th>
                                        Items
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($store as $data)
                                    <tr>
                                        <td>
                                            {{ $data->name }}
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-success btn-sm" data-toggle="modal"
                                                data-target="#EditModal{{ $data->id }}"><i
                                                    class="fa fa-eye mr-2"></i>View</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">Items Not Found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @endif
            </form>
            <div class="float-right">
                {{-- {{$categories->links('pagination::bootstrap-4')}} --}}
            </div>
        </div>
    </div>





@foreach ($store as $key => $data)
    <form action="{{ route('stock.update', $data->id) }}" method="POST">
        @csrf
        @method('put')
        <!-- Modal Edit -->
        <div wire:ignore.self class="modal fade bd-example-modal-lg" id="EditModal{{ $data->id }}" tabindex="-1"
            role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="popup text-left">
                            <div class="media align-items-top justify-content-between">
                                <h3 class="">Store</h3>
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

                                            <input type="hidden" name="supplierprice" id=""
                                                value="{{ $data->supplierprice }}">
                                            <input type="hidden" name="expiredate" id=""
                                                value="{{ $data->expiredate }}">
                                            <input type="hidden" name="category_id" id=""
                                                value="{{ $data->category_id }}">
                                                <input type="hidden" name="description" id=""
                                                value="{{ $data->description }}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <img src="{{ asset('/storage/stock/' . $data->stock_img) }}"
                                                        width="50%" alt="">
                                                    <h2 class="mt-4">{{ $data->name }}</h2>
                                                    <div class="dec mt-3">
                                                        <h5>Description:</h5>
                                                        <p class="text-justify" style="font-size: 12px;line-height:17px"
                                                            style="">{{ $data->description }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <input type="hidden" class="form-control"
                                                            placeholder="Enter Product Name" name="name"
                                                            data-errors="Please Product Name."
                                                            value="{{ $data->name }}" required="">
                                                        <div class="help-block with-errors"></div>

                                                    </div>


                                                    <div class="form-group">
                                                        <label>Total Stock *</label>
                                                        <input type="number" name="stock_alert"
                                                            value="{{ $data->stock_alert }}" class="form-control"
                                                            placeholder="Enter Total Stock"
                                                            data-errors="Please Enter Total Stock." required=""
                                                            readonly>
                                                        <div class="help-block with-errors"></div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label>Item Taken *</label>
                                                        <div class="input-group input-spinner">
                                                            <a href="#" class="btn badge-danger " id=""
                                                                wire:click="DecrementQty({{ $data->id }})">
                                                                −
                                                            </a>
                                                            <input type="text" class="form-control" name="" value="{{$count}}"
                                                                id="inc">
                                                            <a href="#" class="btn badge-success " id="" 
                                                                wire:click="IncrementQty({{ $data->id }})">
                                                                +
                                                            </a>
                                                        </div>
                                                    </div>

                                                        <div class="form-group">
                                                            <label>Reasons / Comment</label>
                                                            <textarea class="form-control" name="comments"
                                                                rows="6"></textarea>
                                                        </div>
                                                   
                                                </div>
                                            </div>
                                        </div>





                                        <div class="card-footer border-0">

                                            <div class="d-flex flex-wrap align-items-ceter justify-content-end">
                                        <button type="submit" class="btn btn-primary mr-2 float-right">Save</button>

                                {{-- <div class="btn btn-primary mr-3" data-dismiss="modal">Cancel</div>
                                <div class="btn btn-outline-primary" data-dismiss="modal">Save</div> --}}
                            </div>
                                        </div>
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
