<!-- This will append SQUAREPAY payment content on checkout page. -->
<!-- SQUAREPAY payment content start -->
@if(env('SQUARE_PAY_ENABLE') == 1)
<div class="card">
    <div class="card-header" id="headingOne">
        <div class="panel-title">
            <label for='squarepay'>
                <input type='radio' id='squarepay' name='occupation' value='Working' required />
                <a data-toggle="collapse" data-parent="#accordion" href="#squarepay_pay"></a>

                <img src="{{ Module::asset('squarepay:logo/sqaurepay.png') }}" class="img-fluid"
                    alt="course">
            </label>
        </div>
    </div>
    <div id="squarepay_pay" class="panel-collapse collapse in">
        <div class="card-body">

            <div class="payment-proceed-btn">



                <form id="sqp-payment-form" method="POST" action="{{ route('squarepay.front.payment') }}">
                    @csrf
                    <div id="sqp_card_container"></div>
                   
                    <input id="sqp_txn" type="hidden" value="" name="txn_id">
                    

                    <button id="card-button" class="btn btn-primary" title="checkout" type="button">{{ __('frontstaticword.Proceed') }}</button>

                </form>
                <div id="payment-status-container"></div>

                

            </div>
        </div>
    </div>
</div>

@endif


<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
<script>

    const appId      = @json(config('squarepay.SQUARE_APPLICATION_ID'));
    const locationId = @json(config('squarepay.SQUARE_PAY_LOCATION_ID')); 
    
        async function initializeCard(payments) {

        const card = await payments.card();

        await card.attach('#sqp_card_container'); 
            return card; 
        }



        document.addEventListener('DOMContentLoaded', async function () {
            if (!window.Square) {
                throw new Error('Square.js failed to load properly');
            }
            const payments = window.Square.payments(appId, locationId);

            let card;
            try {
                card = await initializeCard(payments);
            } catch (e) {
                console.error('Initializing Card failed', e);
                return;
            }

            async function handlePaymentMethodSubmission(event, paymentMethod) {
            event.preventDefault();

                try {
                    // disable the submit button as we await tokenization and make a
                    // payment request.
                    cardButton.disabled = true;
                    const token = await tokenize(paymentMethod);
                    const paymentResults = await createPayment(token);

                    if(paymentResults.payment.id){

                        $('#sqp_txn').val(paymentResults.payment.id);

                        $('#sqp-payment-form').submit();
                    }

                } catch (e) {
                    cardButton.disabled = false;
                    displayPaymentResults('FAILURE');
                    console.log(e.message);
                }
            }

            const cardButton = document.getElementById(
                'card-button'
            );

            cardButton.addEventListener('click', async function (event) {
                await handlePaymentMethodSubmission(event, card);
            });


        // Step 5.2: create card payment
        });

        async function createPayment(token) {

            const body = JSON.stringify({
                __token : '{{ csrf_token() }}',
                locationId,
                sourceId: token,
                amount : '{{ strip_tags($secureamount) }}'
            });

            return await axios.post('{{ url("/squarepay/create/payment") }}',body,{
                headers: {
                    'Content-Type': 'application/json',
                }
            })
            .then(res => {
                return res.data;
            })
            .catch(err => {
               return err.data;
            });

        }

        // This function tokenizes a payment method. 
        // The ‘error’ thrown from this async function denotes a failed tokenization,
        // which is due to buyer error (such as an expired card). It is up to the
        // developer to handle the error and provide the buyer the chance to fix
        // their mistakes.
        async function tokenize(paymentMethod) {
            const tokenResult = await paymentMethod.tokenize();
            if (tokenResult.status === 'OK') {
                return tokenResult.token;
            } else {
                let errorMessage = `Tokenization failed-status: ${tokenResult.status}`;
                if (tokenResult.errors) {
                errorMessage += ` and errors: ${JSON.stringify(
                    tokenResult.errors
                )}`;
                }
                throw new Error(errorMessage);
            }
        }

        function displayPaymentResults(status) {
            const statusContainer = document.getElementById(
                'payment-status-container'
            );
            if (status === 'SUCCESS') {
                statusContainer.classList.remove('is-failure');
                statusContainer.classList.add('is-success');
            } else {
                statusContainer.classList.remove('is-success');
                statusContainer.classList.add('is-failure');
            }

            statusContainer.style.visibility = 'visible';
        }   


</script>





<!-- SQUAREPAY payment content end -->