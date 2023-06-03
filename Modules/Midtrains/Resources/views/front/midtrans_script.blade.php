<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrains.MID_TRANS_CLIENT_KEY') }}"></script>
<script type="text/javascript">
    "use Strict";
    
    $('#pay-button-midtrans').on('click', function (event) {
        event.preventDefault();
        $(this).attr("disabled", "disabled");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({

            url: @json(route("midtrains.get.token")),
            cache: false,
            method: 'POST',
            data: {
                amount: @json($secureamount)
            },
            success: function (data) {

                data = $.trim(data);

                var resultType = document.getElementById('result-type');
                var resultData = document.getElementById('result-data');

                function changeResult(type, data) {
                    $("#result-type").val(type);
                    $("#result-data").val(JSON.stringify(data));
                }

                snap.pay(data, {

                    onSuccess: function (result) {
                        changeResult('success', result);
                        console.log(result.status_message);
                        console.log(result);
                        $("#midtrans-payment-form").submit();
                    },
                    onPending: function (result) {
                        changeResult('pending', result);
                        console.log(result.status_message);
                        $("#midtrans-payment-form").submit();
                    },
                    onError: function (result) {
                        changeResult('error', result);
                        console.log(result.status_message);
                        $("#midtrans-payment-form").submit();
                    }
                });
            }
        });
    });
</script>