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
                                    <h4 class="card-title">Category</h4>
                                </div>
                                <a href="#" class="btn border add-btn shadow-none mx-2 d-none d-md-block float-right"
                                    data-toggle="modal" data-target="#new-order"><i class="fa fa-plus mr-3"></i>Add Category
                                </a>
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
                                <form action="page-list-category.html" data-toggle="validator">
                                    @if (!empty($categories))
                                        <div class="table-responsive">
                                            <table id="example2" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            Category Name
                                                        </th>
                                                        <th>
                                                            Tools
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($categories as $category)
                                                        <tr>
                                                            <td>
                                                                {{ $category->categoryName }}
                                                            </td>
                                                            <td>
                                                                <a href="#" class="btn btn-success btn-sm"
                                                                    data-toggle="modal"
                                                                    data-target="#EditModal{{ $category->id }}"><i
                                                                        class="fa fa-edit"></i>Edit</a>
                                                                <a href="#" class="btn btn-danger btn-sm"  data-toggle="modal"
                                                                    data-target="#DModal{{ $category->id }}"><i
                                                                        class="fa fa-trash"></i>Delete</a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="2">Category Not Found!</td>
                                                        </tr>

                                                    @endforelse
                                                </tbody>
                                            </table>

                                        </div>
                                    @endif
                                </form>
                                <div class="float-right">
                                    {{$categories->links('pagination::bootstrap-4')}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page end  -->
            </div>
        </div>
    </div>
    {{-- Add Category --}}
    <div class="modal fade" id="new-order" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="popup text-left">
                        <h4 class="mb-3">Category</h4>
                        <hr>
                        <form action="{{route('category.store')}}" method="POST">
                            @csrf
                            <div class="content create-workform bg-body">
                                <div class="pb-3">
                                    {{-- <label class="mb-2">Category</label> --}}
                                    <input type="text" class="form-control" name="categoryName" placeholder="Enter Category">
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                        <div class="btn btn-primary mr-4" data-dismiss="modal">Cancel</div>
                                        <button type="submit" class="btn btn-outline-primary" >Create</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Category --}}
    @foreach($categories as $category)
    <form action="{{route('category.update',  $category->id)}}" method="POST">
        @csrf
        @method('put')
    <div class="modal fade" id="EditModal{{ $category->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="popup text-left">
                        <h4 class="mb-3">Edit Category</h4>
                        <hr>
                            <div class="content create-workform bg-body">
                                <div class="pb-3">
                                    {{-- <label class="mb-2">Category</label> --}}
                                    <input type="text" class="form-control" name="categoryName" placeholder="Enter Category" value="{{$category->categoryName}}">
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                        <div class="btn btn-primary mr-4" data-dismiss="modal">Cancel</div>
                                        <button type="submit" class="btn btn-outline-primary">Update</button>
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

    {{-- Delete Category --}}
    @foreach($categories as $category)
    <form action="{{route('category.destroy',  $category->id)}}" method="POST">
        @csrf
        @method('delete')
    <div class="modal fade" id="DModal{{$category->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="popup text-left">
                        <h4 class="mb-3">Deleting...</h4>
                        <hr>
                            <div class="content create-workform bg-body">
                                <div class="pb-3 text-center">
                                    <p class="text-danger">DELETE CATEGORY</p>

                                    <h2>{{ $category->categoryName }}</h2>
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
    {{-- End  --}}
@endsection
