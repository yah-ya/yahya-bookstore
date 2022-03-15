<?php

/** @var Factory $factory */

use Yahyya\bookstore\App\Models\Book;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'short_desc' => $faker->shuffleString,
        'amount' => $faker->randomDigitNotZero(),
        'stock' => $faker->randomNumber(),
        'author_id'=> \factory(\Yahyya\bookstore\App\Models\Author::class)->create()->first()->id,
    ];
});
