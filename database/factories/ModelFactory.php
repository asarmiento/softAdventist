<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Entities\Member::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'charter' => str_random(10),
        'name' => $faker->name,
        'last' => $faker->lastName,
        'bautizmoDate'=> $faker->date,
        'birthdate'=> $faker->date,
        'phone'=>  rand(00000000,9999999),
        'cell' => rand(00000000,9999999),
        'email'=> $faker->unique()->safeEmail,
        'church_id'=> 1,
        'token'=> bcrypt(str_random(10)),
        'user_id' => 1,
    ];/*[
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];*/
});
