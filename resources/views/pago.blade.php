@extends('layouts.app')

@section('content')


<div class="container py-5">
    <h1 class="text-center mb-4">Proceso de Pago</h1>

    <div class="container">
    <h1>Pagar</h1>
    <div id="payment-form">
        <div id="card-element"></div>
        <button id="submit-payment">Pagar</button>
    </div>
</div>

<!-- Script de Pago Simulado -->
<script src="https://js.stripe.com/v3/"></script>
   <script>
        const stripe = Stripe('{{ env('STRIPE_PUBLIC') }}');
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        document.getElementById('submit-payment').addEventListener('click', async (e) => {
            e.preventDefault();

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

const response = await fetch('{{ route('createPaymentIntent') }}', {
    method: 'POST',
    headers: { 
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
    },
    body: JSON.stringify({}) // Si necesitas enviar datos adicionales
});

            const { clientSecret } = await response.json();

            const { error } = await stripe.confirmCardPayment(clientSecret, {
                payment_method: { card: cardElement },
            });

            if (error) {
                alert('Error en el pago: ' + error.message);
            } else {
                alert('Pago realizado con éxito');
                window.location.href = '/gracias';
            }
        });
    </script>

@endsection
