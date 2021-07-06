@if(count($errors) > 0)
    @foreach ($errors->all() as $error)

    <div class="alert text-white bg-danger" role="alert">
        <div class="iq-alert-icon">
           <i class="fa fa-times-circle-o"></i>
        </div>
        <div class="iq-alert-text">{{$error}}</div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="fa fa-close"></i>
        </button>
     </div>


    @endforeach
@endif

@if (session('success'))


<div class="alert text-white bg-success" role="alert">
    <div class="iq-alert-icon">
       <i class="fa fa-check-circle"></i>
    </div>
    <div class="iq-alert-text">{{session('success')}}</div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <i class="fa fa-close"></i>
    </button>
 </div>


@endif

@if (session('error'))


<div class="alert text-white bg-danger" role="alert">
    <div class="iq-alert-icon">
       <i class="fa fa-times-circle-o"></i>
    </div>
    <div class="iq-alert-text">{{session('error')}}</div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <i class="fa fa-close"></i>
    </button>
 </div>


@endif

