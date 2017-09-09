<?php

use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    public function getModel()
    {
        return new \App\Entities\Member();
    }
    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
            'charter' => $faker->number,
            'name' => $faker->name,
            'last' => $faker->last,
            'bautizmoDate'=> $faker->date,
            'birthdate'=> $faker->birthdate,
            'phone'=> $faker->phone,
            'cell' => $faker->phone,
            'email'=> $faker->email,
            'church_id'=> 1,
            'token'=> bcrypt(rand(12121,1231241)),
            'user_id' => 1,
        ];
    }

    public function run()
    {
        factory(\App\Entities\Member::class)->times(150)->create();
    }
}
