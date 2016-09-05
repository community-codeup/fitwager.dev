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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'fitbit_id' => str_random(5),
        'coins' => $faker->randomDigit,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Challenge::class, function (Faker\Generator $faker){
	return [
		'description' => str_random(10),
		'created_by' => $faker->randomDigit,
		'bet_type' => $faker->randomDigit,
		'start_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
		'end_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
		'wager' => $faker->randomDigit,
	];
});

// $factory->define(App\User::class, function (Faker\Generator $faker) {
//     return [
//         'id' => $faker->name,
//         'name' => $faker->safeEmail,
//         'email' => bcrypt(str_random(10)),
//         'fitbit_id' => str_random(5),
//         'coins' => $faker->randomDigit,
//         'remember_token' => str_random(10),
//     ];
// });

// $factory->define(App\User::class, function (Faker\Generator $faker) {
//     return [
//         'id' => $faker->name,
//         'name' => $faker->safeEmail,
//         'email' => bcrypt(str_random(10)),
//         'fitbit_id' => str_random(5),
//         'coins' => $faker->randomDigit,
//         'remember_token' => str_random(10),
//     ];
// });

