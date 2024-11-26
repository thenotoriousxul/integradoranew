<?php
namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Persona;
use App\Models\Direccion;
use Illuminate\Support\Facades\Hash;
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
        Persona::create([
            'users_id' => $user->id,
            'direcciones_id' => $direccion->id,
            'nombre' => $input['nombre'],
            'apellido_paterno' => $input['apellido_paterno'],
            'apellido_materno' => $input['apellido_materno'],
            'genero' => $input['genero'],
            'numero_telefonico' => $input['numero_telefonico'],
        ]);

        $user->assignRole('cliente');


        return $user;
    }
}
