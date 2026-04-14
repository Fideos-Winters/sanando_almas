<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Psicologa — solo inserta si no existe
        $idPsicologa = DB::table('Psicologa')
            ->where('correo', 'psicologa@sanando.com')
            ->value('id_psicologa');

        if (!$idPsicologa) {
            $idPsicologa = DB::table('Psicologa')->insertGetId([
                'correo'     => 'psicologa@sanando.com',
                'usuario'    => 'dra.lopez',
                'contrasena' => Hash::make('admin123'),
            ]);
        }

        $idPaciente = DB::table('Pacientes')
            ->where('correo', 'ana@test.com')
            ->value('id_pacientes');

        if (!$idPaciente) {
            $idPaciente = DB::table('Pacientes')->insertGetId([
                'nombre'           => 'Ana',
                'apellido'         => 'Garcia',
                'telefono'         => '555-1234',
                'correo'           => 'ana@test.com',
                'fecha_nacimiento' => '1995-06-15',
                'id_psicologa'     => $idPsicologa,
            ]);
        }

        // 3. Extra_pacientes — solo inserta si no existe
        $idExtra = DB::table('Extra_pacientes')
            ->where('correo', 'ana@test.com')
            ->value('id_extrapaciente');

        if (!$idExtra) {
            $idExtra = DB::table('Extra_pacientes')->insertGetId([
                'usuario'     => 'ana.garcia',
                'contrasena'  => Hash::make('password123'),
                'correo'      => 'ana@test.com',
                'id_paciente' => $idPaciente,
            ]);
        }

        // 4. Sesion — solo inserta si no existe una para hoy
        $idSesion = DB::table('Sesion')
            ->where('fecha', today()->toDateString())
            ->value('id_sesion');

        if (!$idSesion) {
            $idSesion = DB::table('Sesion')->insertGetId([
                'fecha'        => today()->toDateString(),
                'hora_inicio'  => '09:00:00',
                'hora_fin'     => '10:00:00',
                'id_notas'     => null,
                'id_ejercicios'=> null,
            ]);
        }

        // 5. Ejercicios — solo inserta si el paciente no tiene aun
        $tieneEjercicios = DB::table('Ejercicios')
            ->where('id_extrapaciente', $idExtra)
            ->exists();

        if (!$tieneEjercicios) {
            DB::table('Ejercicios')->insert([
                [
                    'titulo'           => 'Respiracion 4-7-8',
                    'descripcion'      => 'Inhala 4 segundos, sostiene 7 segundos, exhala 8 segundos. Repite 4 veces.',
                    'id_sesion'        => $idSesion,
                    'id_extrapaciente' => $idExtra,
                ],
                [
                    'titulo'           => 'Diario de emociones',
                    'descripcion'      => 'Escribe al final del dia las emociones que sentiste y en que situacion surgieron.',
                    'id_sesion'        => $idSesion,
                    'id_extrapaciente' => $idExtra,
                ],
            ]);
        }

        // 6. Citas — solo inserta si el paciente no tiene citas futuras
        $tieneCitas = DB::table('Citas')
            ->where('id_pacientes', $idPaciente)
            ->where('fecha', '>=', today()->toDateString())
            ->exists();

        if (!$tieneCitas) {
            DB::table('Citas')->insert([
                [
                    'fecha'        => today()->addDays(3)->toDateString(),
                    'hora'         => '09:00:00',
                    'id_pacientes' => $idPaciente,
                    'id_psicologa' => $idPsicologa,
                ],
                [
                    'fecha'        => today()->addDays(10)->toDateString(),
                    'hora'         => '11:00:00',
                    'id_pacientes' => $idPaciente,
                    'id_psicologa' => $idPsicologa,
                ],
            ]);
        }

        $this->command->info('Paciente de prueba listo: ana@test.com / password123');
    }
}