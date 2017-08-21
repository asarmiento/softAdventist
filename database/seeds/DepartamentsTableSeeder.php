<?php

use Illuminate\Database\Seeder;

class DepartamentsTableSeeder extends Seeder
{

    public function getModel()
    {
        return new App\Entities\Departaments\Departament();
    }


    public function getDummyData(Generator $faker, array $customValues = [])
    {
        return [
            'charter' => $faker->number,
            'name' => $faker->name,
            'last' => $faker->last,
            'bautizmoDate' => $faker->date,
            'birthdate' => $faker->birthdate,
            'phone' => $faker->phone,
            'cell' => $faker->phone,
            'email' => $faker->email,
            'church_id' => 1,
            'token' => bcrypt(rand(12121, 1231241)),
            'user_id' => 1,
        ];
    }


    public function run()
    {
        $data = [
            ['name' => 'Fondos de Iglesia'],
            ['name' => 'Sociedad Dorcas'],
            ['name' => 'Hombres Adventistas'],
            ['name' => 'Ministerio Juvenil Adventista'],
            ['name' => 'Club de Aventureros'],
            ['name' => 'Club de Embajadores'],
            ['name' => 'Club de Conquistadores'],
            ['name' => 'Club de Guias Mayores'],
            ['name' => 'Ministerios Infantiles'],
            ['name' => 'Departamento de Comunicación'],
            ['name' => 'Ministerios de la Familia'],
            ['name' => 'Ministerios de la Salud'],
            ['name' => 'Asociación Hogar y Escuela'],
            ['name' => 'Ministerios Personales'],
            ['name' => 'Ministerio a Estudiantes en Universidades no Adventistas'],
            ['name' => 'Ministerio de Publicaciones'],
            ['name' => 'Libertad Religiosa'],
            ['name' => 'Escuela Sabática'],
            ['name' => 'Mayordomía'],
            ['name' => 'Ministerios de la Mujer'],
            ['name' => 'Jóvenes Adultos'],
        ];
        foreach ($data AS $datos) {
            \App\Entities\Departaments\ListDepartament::create($datos);
        }
    }
}
