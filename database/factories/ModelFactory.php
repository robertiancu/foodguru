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
        'first_name' => $faker->firstName(null),
        'last_name' => $faker->lastName,
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
        'event_id' => $faker->numberBetween(1, 30),
        'user_id' => $faker->numberBetween(1, 100)
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Misc\EventRecipe::class, function (Faker\Generator $faker) {
    return [
        'event_id' => $faker->numberBetween(1, 50),
        'recipe_id' => $faker->numberBetween(1, 30)
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Circle::class, function (Faker\Generator $faker){
    return [
        'name' => $faker->name,
        'owner_id' => $faker->numberBetween(1,100),
        'public' => false
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Pivots\CircleUser::class, function (Faker\Generator $faker){
    return [
        'circle_id' => $faker->numberBetween(1,10),
        'user_id' => $faker->numberBetween(1,100)
        ];
});

$factory->define(App\Models\Ingredient::class, function (Faker\Generator $faker) {

    return [
        'description' => $faker->paragraph(1),
        'unit' => 'grame',
        'class' => 2
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Favourite::class, function (Faker\Generator $faker){
    return [
        'user_id' => $faker->numberBetween(1,100),
        'recipe_id' => $faker->numberBetween(1,5)
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Step::class, function (Faker\Generator $faker){
    return [
        'step_number' => $faker->numberBetween(1,15),
        'content' => $faker->text,
        'recipe_id' => $faker->numberBetween(1,5)
    ];
});
$factory->define(App\Models\Misc\IngredientMeta::class, function (Faker\Generator $faker) {

    return [];
});
