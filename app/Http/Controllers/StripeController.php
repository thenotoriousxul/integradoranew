<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class StripeController extends Controller
{
    public function __construct()
    {
        // Establece la clave secreta de Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function createPaymentIntent(Request $request)
    {

// Calcula el monto total del carrito
$contenidoCarrito = collect(session()->get('carrito', []));
        $total = $contenidoCarrito->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });

try {
    // Crea un PaymentIntent
    $paymentIntent = PaymentIntent::create([
        'amount' => $total * 100, // Stripe usa centavos
        'currency' => 'mxn',
        'payment_method_types' => ['card'],
    ]);

    return response()->json([
        'clientSecret' => $paymentIntent->client_secret,
    ]);
} catch (\Exception $e) {
    return response()->json([
        'error' => $e->getMessage(),
    ], 500);
}
    }

}
