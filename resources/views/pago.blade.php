@extends('layouts.app')

@section('content')
    <style>
        .payment-card {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 500px;
            margin: auto;
        }
        #card-number, #card-expiry, #card-cvc {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #f8f9fa;
            margin-bottom: 1rem;
        }
        #submit-payment {
            margin-top: 20px;
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            width: 100%;
            font-size: 1rem;
            cursor: pointer;
        }
        #submit-payment:hover {
            background-color: #45a049;
        }
        #submit-payment:disabled {
            cursor: not-allowed;
            opacity: 0.7;
        }
        .spinner-border {
            width: 1rem;
            height: 1rem;
            vertical-align: middle;
        }
    </style>

    <div class="container py-5">
        <h1 class="text-center mb-4">Proceso de Pago</h1>

        <div class="payment-card">
            <h2 class="text-center mb-4">Detalles de la Tarjeta</h2>
            <form id="payment-form">

                <label for="card-number" class="form-label">Número de tarjeta</label>
                <div id="card-number" class="mb-3"></div>

                <label for="card-expiry" class="form-label">Fecha de vencimiento</label>
                <div id="card-expiry" class="mb-3"></div>

                <label for="card-cvc" class="form-label">CVC</label>
                <div id="card-cvc" class="mb-3"></div>

                <!-- Botón con spinner -->
                <button id="submit-payment" type="button">
                    <span class="spinner-border spinner-border-sm d-none" id="spinner" role="status" aria-hidden="true"></span>
                    <span id="button-text">Pagar</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Stripe.js -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Inicializar Stripe
        const stripe = Stripe('{{ env('STRIPE_PUBLIC') }}');
        const elements = stripe.elements();

        // Crear los elementos individualmente
        const cardNumber = elements.create('cardNumber', { placeholder: '1234 5678 9012 3456' });
        const cardExpiry = elements.create('cardExpiry');
        const cardCvc = elements.create('cardCvc');

        // Montar cada elemento en su contenedor
        cardNumber.mount('#card-number');
        cardExpiry.mount('#card-expiry');
        cardCvc.mount('#card-cvc');

        // Manejo del botón de pago
        document.getElementById('submit-payment').addEventListener('click', async (e) => {
            e.preventDefault();

            const button = e.target;
            const spinner = document.getElementById('spinner');
            const buttonText = document.getElementById('button-text');

            // Desactivar botón y mostrar animación
            button.disabled = true;
            spinner.classList.remove('d-none');
            buttonText.textContent = 'Procesando...';

            try {
                // Crear Intent de Pago
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const response = await fetch('{{ route('createPaymentIntent') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({})
                });

                const { clientSecret } = await response.json();

                // Confirmar el pago con Stripe
                const { paymentIntent, error } = await stripe.confirmCardPayment(clientSecret, {
                    payment_method: {
                        card: cardNumber,
                        billing_details: {
                            name: 'Cliente'
                        }
                    }
                });

                if (error) {
                    alert('Error en el pago: ' + error.message);
                } else if (paymentIntent.status === 'succeeded') {
                    // Notificar al servidor sobre el pago exitoso
                    const backendResponse = await fetch('{{ route('procesarPago') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ payment_intent_id: paymentIntent.id })
                    });

                    const backendResult = await backendResponse.json();

                    if (backendResult.success) {
                        alert('Pago procesado con éxito.');
                        window.location.href = '/agradecimiento';
                    } else {
                        alert('Hubo un problema al guardar la orden: ' + backendResult.message);
                    }
                }
            } catch (error) {
                alert('Error procesando el pago: ' + error.message);
            } finally {
                // Restaurar el estado del botón
                button.disabled = false;
                spinner.classList.add('d-none');
                buttonText.textContent = 'Pagar';
            }
        });
    </script>
@endsection
