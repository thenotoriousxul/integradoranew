<?php
namespace App\Actions\Fortify;

use App\Mail\clienteEmail;
use App\Mail\empleadoMail;
use App\Models\TipoPersona;
use App\Models\User;
use App\Models\Persona;
use App\Models\Direccion;
use AWS\CRT\HTTP\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */

    public function create(array $input)
    {
        // Validar los datos
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nombre' => ['required', 'string', 'max:255'],
            'apellido_paterno' => ['required', 'string', 'max:255'],
            'apellido_materno' => ['required', 'string', 'max:255'],
            'genero' => ['required', 'string', 'in:M,F'],
            'numero_telefonico' => ['required', 'string', 'max:15'],
            'calle' => ['required', 'string', 'max:255'],
            'numero_ext' => ['required', 'string', 'max:50'],
            'numero_int' => ['nullable', 'string', 'max:50'],
            'colonia' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'string', 'max:255'],
            'codigo_postal' => ['required', 'string', 'max:10'],
            'pais' => ['required', 'string','max:255']
            
        ])->validate();

        // Crear usuario
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        // Crear dirección
        $direccion = Direccion::create([
            'calle' => $input['calle'],
            'numero_ext' => $input['numero_ext'],
            'numero_int' => $input['numero_int'] ?? null,
            'colonia' => $input['colonia'],
            'estado' => $input['estado'],
            'codigo_postal' => $input['codigo_postal'],
            'pais' => $input['pais'],
        ]);

        // Crear persona
       $persona= Persona::create([
            'users_id' => $user->id,
            'direcciones_id' => $direccion->id,
            'nombre' => $input['nombre'],
            'apellido_paterno' => $input['apellido_paterno'],
            'apellido_materno' => $input['apellido_materno'],
            'genero' => $input['genero'],
            'numero_telefonico' => $input['numero_telefonico'],
        ]);
    
        TipoPersona::create([
            'personas_id' => $persona->id,
            'tipo_persona'=> 'Cliente'

        ]);



        $user->assignRole('cliente');

        try {
            Mail::to($input['email'])->send(new clienteEmail);
        } catch (\Exception $e) {
            // Manejo de errores de correo (opcional, para no interrumpir el flujo)
            logger('Error al enviar el correo: ' . $e->getMessage());
        }
        
        return $user;
    }



public function createEmpleado(array $input)
{
    // Usar una transacción para garantizar atomicidad
    return DB::transaction(function () use ($input) {
        // Validar los datos
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'calle' => ['required', 'string'],
            'numero_ext' => ['required', 'string'],
            'colonia' => ['required', 'string'],
            'estado' => ['required', 'string'],
            'codigo_postal' => ['required', 'string'],
            'pais' => ['required', 'string'],
            'nombre' => ['required', 'string'],
            'apellido_paterno' => ['required', 'string'],
            'genero' => ['required', 'string'],
            'numero_telefonico' => ['required', 'string'],
        ])->validate();

        // Crear usuario
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $password = $input['password'];

        // Crear dirección
        $direccion = Direccion::create([
            'calle' => $input['calle'],
            'numero_ext' => $input['numero_ext'],
            'numero_int' => $input['numero_int'] ?? null,
            'colonia' => $input['colonia'],
            'estado' => $input['estado'],
            'codigo_postal' => $input['codigo_postal'],
            'pais' => $input['pais'],
        ]);

        // Crear persona con información adicional
        $persona = Persona::create([
            'users_id' => $user->id,
            'direcciones_id' => $direccion->id,
            'nombre' => $input['nombre'],
            'apellido_paterno' => $input['apellido_paterno'],
            'apellido_materno' => $input['apellido_materno'],
            'genero' => $input['genero'],
            'numero_telefonico' => $input['numero_telefonico'],
        ]);

        // Crear TipoPersona
        TipoPersona::create([
            'personas_id' => $persona->id,
            'tipo_persona' => 'Empleado',
        ]);

        // Asignar rol de empleado
        $user->assignRole('empleado');

        // Enviar correo
        Mail::to($input['email'])->send(new empleadoMail($input['email'], $password));

        return $user;
    });
}


}
