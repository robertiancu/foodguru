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
        'image' => null,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'admin' => $faker->boolean,
        'remember_token' => str_random(10)
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Friend::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween(1,100),
        'friend_id' => $faker->numberBetween(1,100)
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\FriendRequest::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween(1,100),
        'new_friend_id' => $faker->numberBetween(1,100)
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Event::class, function (Faker\Generator $faker) {
    $date_time = $faker->dateTimeBetween('+0 days', '+2 days');
    $interval = new DateInterval('PT2H');
    return [
        'name' => $faker->name,
        'location' => $faker->streetAddress,
        'day' => $date_time->format('Y-m-d'),
        'start_time' => $date_time->format('H:i:s'),
        'end_time' => ((clone $date_time)->add($interval))->format('H:i:s'),
        'user_id' => $faker->numberBetween(1,100)
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
$factory->define(App\Models\Pivots\IngredientRecipe::class, function (Faker\Generator $faker) {
    return [
        'ingredient_id' => $faker->numberBetween(1, 3000),
        'quantity' => $faker->numberBetween(1, 100),
        'detail' => $faker->paragraph(1)
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Misc\EventRecipe::class, function (Faker\Generator $faker) {
    return [
        'event_id' => $faker->numberBetween(1, 30),
        'recipe_id' => $faker->numberBetween(1, 50)
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Ingredient::class, function (Faker\Generator $faker) {
    return [
        'description' => $faker->paragraph(1),
        'unit' => 'grame',
        'class' => 2
    ];
});

$factory->define(App\Models\Circle::class, function (Faker\Generator $faker){
    return [
        'name' => $faker->name,
        'user_id' => $faker->numberBetween(1,100),
        'public' => $faker->boolean
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Misc\IngredientMeta::class, function (Faker\Generator $faker) {
    return [
        'ingredient_id' => $faker->numberBetween(1, 100),
        'key' => $faker->paragraph(1),
        'value' => $faker->boolean ? 'adevarat' : 'fals'
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Rating::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 100),
        'recipe_id' => $faker->numberBetween(1, 50),
        'rating' => $faker->numberBetween(1, 5)
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Recipe::class, function (Faker\Generator $faker) {
    return [
        'category_id' => $faker->numberBetween(1, 10),
        'name' => $faker->words($nb = 3, $asText = true),
        'image' => $faker->imageUrl(640,480,'food'),
        'description' => $faker->text,
        'time' => $faker->numberBetween(15,200),
        'difficulty' => $faker->numberBetween(1,10),
        'user_id' => $faker->numberBetween(1, 100),
        'published' => $faker->boolean
    ];
});

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
$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->words($nb = 3, $asText = true),
        'image' => $faker->boolean ? $faker->imageUrl(320,320,'food') : null,
        'description' => $faker->text
    ];
});

$factory->define(App\Models\Favourite::class, function (Faker\Generator $faker){
    return [
        'user_id' => $faker->numberBetween(1,100),
        'recipe_id' => $faker->numberBetween(1,50)
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Step::class, function (Faker\Generator $faker){
    return [
        'step_number' => $faker->numberBetween(1,15),
        'content' => $faker->text
    ];
});
