@extends('layouts.user')

@section('home')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center rounded-top-4">
                    <h4 class="mb-0">🛒 Checkout Payment</h4>
                </div>

                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                        <strong>Total Amount:</strong>
                        <span class="fs-5 fw-semibold text-success">${{ $total }}</span>
                    </div>

                    @if(Session::has('success'))
                        <div class="alert alert-success text-center">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    @if(Session::has('error'))
                        <div class="alert alert-danger text-center">
                            {{ Session::get('error') }}
                        </div>
                    @endif

                    <form action="{{ route('stripe.post') }}" method="POST" id="payment-form">
                        @csrf
                        <input type="hidden" name="total" value="{{ $total }}">

                        <!-- Stripe Card Element -->
                        <div id="card-element" class="mb-3"></div>
                        <div id="card-errors" class="text-danger mb-3"></div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fs-5">
                            Pay with Card 💳
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stripe JS -->
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ env("STRIPE_KEY") }}');
    const elements = stripe.elements();
    const card = elements.create('card');
    card.mount('#card-element');

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const {token, error} = await stripe.createToken(card);

        if(error){
            document.getElementById('card-errors').textContent = error.message;
        } else {
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            form.submit();
        }
    });
</script>
@endsection
