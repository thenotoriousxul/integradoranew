<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\TipoPersona;
use App\Models\Persona;
use App\Models\Direccion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuarioAdminSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Crear usuario
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password1234'),
                'status' => 1,
            ]
        );
        $admin->assignRole($adminRole);

        // Crear dirección
        $direccion = Direccion::firstOrCreate(
            ['calle' => 'Calle Principal', 'numero_ext' => '1', 'colonia' => 'Centro'],
            [
                'numero_int' => '',
                'estado' => 'Coahuila',
                'codigo_postal' => '27000',
                'pais' => 'México',
            ]
        );

        // Crear persona asociada al usuario y dirección
        $persona = Persona::firstOrCreate(
            ['users_id' => $admin->id],
            [
                'nombre' => 'Administrador',
                'apellido_paterno' => '',
                'apellido_materno' => '',
                'genero' => 'M',
                'numero_telefonico' => '',
                'direcciones_id' => $direccion->id,
            ]
        );

        // Crear tipo de persona completo
        TipoPersona::firstOrCreate(
            ['personas_id' => $persona->id],
            [
                'tipo_persona' => 'Empleado', // o 'Admin' según tu lógica
                'curp' => 'XXXXXXXXXXXXXXX',
                'rfc' => 'XXXXXXXXXXXX',
                'numero_ss' => 'XXXXXXXXXX',
            ]
        );

        $this->command->info('Admin creado con Dirección, Persona y TipoPersona correctamente.');
    }
}
