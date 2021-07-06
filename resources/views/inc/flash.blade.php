@if (count($errors) > 0)
    @foreach ($errors->all() as $error)

        <div class="text-center text-danger">
            <strong>{{ $error }} </strong>
        </div>

    @endforeach
@endif

{{-- @if (session('success'))
    
        <div class="text-center text-success">
            <strong>{{session('success')}}</strong>
        </div>
   
@endif

@if (session('error'))
   
        <div class="text-center text-danger">
            <strong>{{session('error')}}</strong>
        </div>
    
    
@endif --}}

@if (session()->has('CartSuccess'))
    <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
        <div class="d-flex align-items-center">
            <div class="font-35 text-white"><i class='bx bxs-check-circle'></i>
            </div>
            <div class="ms-3">
                <h6 class="mb-0 text-white">{{ session('CartSuccess') }}</h6>

            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
            <div class="d-flex align-items-center">
                <div class="font-35 text-white"><i class='bx bxs-check-circle'></i>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0 text-white">{{ session('message') }}</h6>

                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@elseif (session()->has('CartError'))

    <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
        <div class="d-flex align-items-center">
            <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
            </div>
            <div class="ms-3">
                <h6 class="mb-0 text-white">{{ session('CartError') }}</h6>

            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

@endif
