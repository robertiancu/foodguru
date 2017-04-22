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
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'admin' => $faker->boolean
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Event::class, function (Faker\Generator $faker) {
    $date_time = $faker->dateTimeBetween('+0 days', '+2 days');
    $interval = new DateInterval('PT2H');
    return [
        'name' => $faker->name,
        'location' => $faker->streetAddress,
        'start_time' => $date_time,
        'end_time' => (clone $date_time)->add($interval)
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Pivots\EventUser::class, function (Faker\Generator $faker) {
    return [
        'event_id' => $faker->numberBetween(1, 50),
        'user_id' => $faker->numberBetween(1, 100)
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Misc\EventRecipe::class, function (Faker\Generator $faker) {
    return [
        'recipe_id' => $faker->numberBetween(1, 5),
        'event_id' => $faker->numberBetween(1, 50)
    ];
});
