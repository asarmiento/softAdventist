<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    public function getModel()
    {
        return new \App\Entities\Member();
    }
    public function getDummyData(Generator $faker, array $customValues = array())
    {

    }

    public function run()
    {
        \App\Entities\Country::create([
            'name' => 'Costa Rica',
            'token'=> bcrypt('Costa Rica'),
        ]);

        \App\Entities\Country::create([
            'name' => 'Honduras',
            'token'=> bcrypt('Honduras'),
        ]);
        //factory(\App\Entities\Country::class)->times(150)->create();
    }
}
