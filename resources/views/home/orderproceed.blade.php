@extends('layouts.user')
@section('home')

<div class="container py-4">
    <h3 class="mb-4">Order Summary</h3>

    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            Please check the form and try again.
        </div>
    @endif

    @if(count($cart) > 0)
        <ul class="list-group mb-4">
            @foreach($cart as $id => $item)
                <li class="list-group-item d-flex justify-content-between">
                    <span>{{ $item['name'] }} x {{ $item['quantity'] }}</span>
                    <span>${{ number_format($item['quantity'] * $item['price'], 2) }}</span>
                </li>
            @endforeach

            <li class="list-group-item d-flex justify-content-between border border-primary rounded">
                <strong>Total:</strong>
                <span>${{ number_format($total, 2) }}</span>
            </li>
        </ul>

        <form method="POST" action="{{ route('order.store') }}" id="checkout-form">
            @csrf

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                @error('phone') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control" rows="3">{{ old('address') }}</textarea>
                @error('address') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <h4 class="mb-3">Select Payment Option</h4>

                <div class="form-check">
                    <input class="form-check-input payment-method" type="radio" name="payment_method" value="cod" {{ old('payment_method', 'cod') === 'cod' ? 'checked' : '' }} required>
                    <label class="form-check-label">Cash On Delivery</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input payment-method" type="radio" name="payment_method" value="bkash" {{ old('payment_method') === 'bkash' ? 'checked' : '' }}>
                    <label class="form-check-label">Pay by Bkash</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input payment-method" type="radio" name="payment_method" value="nagad" {{ old('payment_method') === 'nagad' ? 'checked' : '' }}>
                    <label class="form-check-label">Pay by Nagad</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input payment-method" type="radio" name="payment_method" value="card" {{ old('payment_method') === 'card' && $stripeKey ? 'checked' : '' }} {{ $stripeKey ? '' : 'disabled' }}>
                    <label class="form-check-label">Pay by Card</label>
                </div>

                <div id="mobile-payment-box" class="border rounded p-3 mt-3" style="display: none;">
                    <div id="bkash-instructions" class="mobile-payment-instructions" style="display: none;">
                        <p class="mb-1"><strong>Bkash payment number:</strong> {{ $bkashNumber }}</p>
                        <p class="text-muted small mb-3">Send the total amount, then enter your sender number and transaction ID.</p>
                    </div>

                    <div id="nagad-instructions" class="mobile-payment-instructions" style="display: none;">
                        <p class="mb-1"><strong>Nagad payment number:</strong> {{ $nagadNumber }}</p>
                        <p class="text-muted small mb-3">Send the total amount, then enter your sender number and transaction ID.</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sender Phone Number</label>
                        <input type="text" name="payment_sender_phone" class="form-control" value="{{ old('payment_sender_phone') }}">
                        @error('payment_sender_phone') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-0">
                        <label class="form-label">Transaction ID</label>
                        <input type="text" name="mobile_transaction_id" class="form-control" value="{{ old('mobile_transaction_id') }}">
                        @error('mobile_transaction_id') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div id="card-payment-box" class="border rounded p-3 mt-3" style="display: none;">
                    @if($stripeKey)
                        <label class="form-label fw-semibold">Card Details</label>
                        <div id="card-element" class="form-control py-3"></div>
                        <div id="card-errors" class="text-danger small mt-2"></div>
                        @error('stripeToken') <div class="text-danger small">{{ $message }}</div> @enderror
                    @else
                        <div class="alert alert-warning mb-0">
                            Card payment is not configured.
                        </div>
                    @endif
                </div>

                @unless($stripeKey)
                    <div class="text-muted small mt-2">
                        Card payment will be available after Stripe keys are added in .env.
                    </div>
                @endunless
            </div>

            <button type="submit" class="btn btn-success">Confirm Order</button>
        </form>
    @else
        <p>Your cart is empty!</p>
    @endif
</div>

@if(count($cart) > 0 && $stripeKey)
    <script src="https://js.stripe.com/v3/"></script>
@endif

@if(count($cart) > 0)
    <script>
        const checkoutForm = document.getElementById('checkout-form');
        const paymentMethods = document.querySelectorAll('.payment-method');
        const cardPaymentBox = document.getElementById('card-payment-box');
        const mobilePaymentBox = document.getElementById('mobile-payment-box');
        const bkashInstructions = document.getElementById('bkash-instructions');
        const nagadInstructions = document.getElementById('nagad-instructions');
        const hasStripeKey = @json((bool) $stripeKey);
        let stripe = null;
        let elements = null;
        let card = null;
        let cardMounted = false;

        if (hasStripeKey) {
            stripe = Stripe('{{ $stripeKey }}');
            elements = stripe.elements();
            card = elements.create('card');
        }

        function selectedPaymentMethod() {
            return document.querySelector('input[name="payment_method"]:checked')?.value;
        }

        function togglePaymentBox() {
            const method = selectedPaymentMethod();
            const isCard = method === 'card';
            const isMobilePayment = method === 'bkash' || method === 'nagad';

            cardPaymentBox.style.display = isCard ? 'block' : 'none';
            mobilePaymentBox.style.display = isMobilePayment ? 'block' : 'none';
            bkashInstructions.style.display = method === 'bkash' ? 'block' : 'none';
            nagadInstructions.style.display = method === 'nagad' ? 'block' : 'none';

            if (isCard && hasStripeKey && !cardMounted) {
                card.mount('#card-element');
                cardMounted = true;
            }
        }

        paymentMethods.forEach((method) => {
            method.addEventListener('change', togglePaymentBox);
        });

        togglePaymentBox();

        checkoutForm.addEventListener('submit', async (event) => {
            if (selectedPaymentMethod() !== 'card' || !hasStripeKey) {
                return;
            }

            event.preventDefault();

            const {token, error} = await stripe.createToken(card);
            const errorBox = document.getElementById('card-errors');

            if (error) {
                errorBox.textContent = error.message;
                return;
            }

            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            checkoutForm.appendChild(hiddenInput);
            checkoutForm.submit();
        });
    </script>
@endif

@endsection
