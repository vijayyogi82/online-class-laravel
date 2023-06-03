<!-- This will show during mpesa checkout waiting page. -->
<!DOCTYPE html>
<html>

<head>
    <title>
        {{__("Payment in process please do not refresh page")}}
    </title>
    <link rel="stylesheet" href="{{ url("css/bootstrap.min.css") }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
</head>

<body>
    <br>
    <br>
    <center>
        <h1>{{ __("Your transaction is being processed!!!") }}</h1>
    </center>
    <center>
        <h4>{{ __("Please do not refresh this page...") }}</h4>
    </center>
    <center>
        <h4>{{ __("Checkout ID :") }} {{ strip_tags($checkoutid) }} </h4>
    </center>
    <center>
        <h6>{{ __("Getting payment status for ") }} {{ strip_tags($checkoutid) }} </h6>
    </center>

    <div class="mt-2 mb-2">
        <h5 class="payment_status text-primary text-center">
            {{__("Awaiting payment status....")}}
        </h5>
    </div>

    <div class="container">
        <div class="progress">
            <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar"
                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 99%"></div>
        </div>
    </div>
    <br>
    <center>
        <h6 class="text-secondary">{{ __("Page will automatically expires within 1 min if no response received.") }}
        </h6>
    </center>
    <br>
    <div class="text-center">
        <a href="{{ route('cart.show') }}" role="button" class="btn btn-md btn-danger text-center">
            {{__("Cancel Payment")}}
        </a>
    </div>
    <script src="{{url('js/jquery-2.min.js')}}"></script>
   
    <script>
        var orderreviewUrl = @json(route("cart.show"));
        var verifypaymentUrl = @json(route('verify.mpesa',$checkoutid));
        var ordersuccessUrl = @json(url("/confirmation"));
    </script>
    <script src="{{ Module::asset('mpesa:js/mpesawait.js') }}"></script>
</body>

</html>