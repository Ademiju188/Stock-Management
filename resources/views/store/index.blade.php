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
                                    <h4 class="card-title">Store Keeper</h4>
                                </div>
                            </div>
                            <br>
                            <div class="card-body">

                                @livewire('storekeep')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
