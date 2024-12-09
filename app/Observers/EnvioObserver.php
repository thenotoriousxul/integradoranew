<?php

namespace App\Observers;

use App\Mail\EnvioEntregado;
use App\Models\Envios;
use Illuminate\Support\Facades\Mail;

class EnvioObserver
{
    /**
     * Handle the Envios "created" event.
     */
    public function created(Envios $envios): void
    {
        //
    }

    /**
     * Handle the Envios "updated" event.
     *
     * @param  \App\Models\Envios  $envio
     * @return void
     */
    public function updated(Envios $envio): void
    {
        if ($envio->isDirty('estado_envio') && $envio->estado_envio === 'entregado') {
            $persona = $envio->orden->persona;

            // Verifica si la persona es de tipo "cliente" (asumido tipo_persona_id = 1 es "cliente")
            if ($persona && $persona->tipoPersona->id === 1) {
                $correo = $persona->usuario->email;
                Mail::to($correo)->send(new EnvioEntregado($envio));
            }
        }
    }

    /**
     * Handle the Envios "deleted" event.
     */
    public function deleted(Envios $envios): void
    {
        //
    }

    /**
     * Handle the Envios "restored" event.
     */
    public function restored(Envios $envios): void
    {
        //
    }

    /**
     * Handle the Envios "force deleted" event.
     */
    public function forceDeleted(Envios $envios): void
    {
        //
    }
}
