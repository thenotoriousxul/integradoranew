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
            'fecha_nacimiento' => ['required', 'date'],
            'genero' => ['required', 'string', 'in:M,F'],
            'numero_telefonico' => ['required', 'string', 'max:15'],
            'calle' => ['required', 'string', 'max:255'],
            'numero_ext' => ['required', 'string', 'max:50'],
            'numero_int' => ['nullable', 'string', 'max:50'],
            'colonia' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'string', 'max:255'],
            'codigo_postal' => ['required', 'string', 'max:10'],
            'pais' => ['required', 'string', 'max:255'],
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
            'fecha_nacimiento' => $input['fecha_nacimiento'],
            'genero' => $input['genero'],
            'numero_telefonico' => $input['numero_telefonico'],
        ]);

        return $user;
    }
}
