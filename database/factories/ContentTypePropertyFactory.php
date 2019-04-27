<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Clio\ContentType;
use Clio\ContentTypeProperty;
use Faker\Generator as Faker;

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

$factory->define(ContentTypeProperty::class, function (Faker $faker) {
    return [
        'content_type' => function () {
            return factory(ContentType::class)->create()->id;
        },
        'label' => $faker->word,
    ];
});
