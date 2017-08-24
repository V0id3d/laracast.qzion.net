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
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/**
 * Thread Seeder
 * @var \Illuminate\Database\Eloquent\Factory $factory
 */
$factory->define(App\Forum\Thread::class, function(Faker\Generator $faker){
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'title' => $faker->sentence,
        'body' => $faker->paragraph
    ];
});

/**
 * Reply Seeder
 * @var \Illuminate\Database\Eloquent\Factory $factory
 */
$factory->define(App\Forum\Reply::class, function (Faker\Generator $faker) {
    return [
        'thread_id' => function () {
            return factory('App\Forum\Thread')->create()->id;
        },
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'body' => $faker->paragraph
    ];
});