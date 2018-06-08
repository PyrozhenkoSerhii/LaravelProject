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
        'isAdmin' => false,
    ];
});
$factory->define(App\Post::class, function (Faker\Generator $faker) {
    $text = $faker->unique()->text(255);
    $desc = substr($text, 0,100);
    $suggestedVoc = 'work = работать';

    return [
        'title' => $faker->slug,
        'description' => $desc,
        'category' => $faker->slug,
        'img_url' => null,
        'lecsics' => $suggestedVoc,
        'content' => $text,
        'created_by' => $faker->numberBetween(1,9),
        'published_at' => $faker->dateTime,
        'published'=> $faker->numberBetween(0,1),
    ];
});
$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'text' => $faker->text(200),
        'created_by' => $faker->numberBetween(1,9),
        'post_id' => $faker->numberBetween(1,14),
        'parent_id' => null,
    ];
});
$factory->define(App\Dictionary::class, function (Faker\Generator $faker) {
    return [
        'word' => $faker->word,
        'translation' => $faker->word,
        'user_id' => $faker->numberBetween(1,9),
        'learningPercent' => $faker->numberBetween(0,100),
    ];
});