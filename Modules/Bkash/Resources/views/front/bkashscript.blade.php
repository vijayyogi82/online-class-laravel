<!-- This will append bkash script popup on checkout page -->
<!-- Bkash Payment popup script start -->
@if (config('bkash.SANDBOX_ENABLED') == 1)
<script src="{{ config('bkash.BKASH_PAYMENT_SANDBOX') }}/checkout/bKash-checkout-sandbox.js"></script>
@else
<script src="{{ config('bkash.BKASH_PAYMENT_LIVE') }}/checkout/bKash-checkout.js"></script>
@endif

<script type="text/javascript">
    "use Strict";
    var paymentID = '';

    bKash.init({
        paymentMode: 'checkout',
        paymentRequest: {
            amount: @json(strip_tags($secureamount)),
            intent: 'sale'
        },
        createRequest: function (request) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: @json(url("/bkash/checkout")),
                type: 'POST',
                contentType: 'application/json',
                success: function (data) {
                    data = JSON.parse(data);
                    if (data && data.paymentID != null) {
                        paymentID = data.paymentID;
                        bKash.create().onSuccess(data);
                    } else {
                        alert(result.errorMessage);
                        bKash.create().onError();
                    }
                },
                error: function () {
                    bKash.create().onError();
                }
            });
        },
        executeRequestOnAuthorization: function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: @json(url("/bkash/execute")),
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    "paymentID": paymentID
                }),
                success: function (data) {
                    //console.log(data);
                    result = JSON.parse(data);
                    if (result && result.paymentID != null) {
                        window.location.href = "{{ url('/bkash/success') }}?payment_details=" +data;
                    } else {
                        alert(result.errorMessage);
                        bKash.execute().onError();
                    }
                },
                error: function () {
                    bKash.execute().onError();
                }
            });
        }
    });
</script>
<!-- Bkash Payment popup script end -->