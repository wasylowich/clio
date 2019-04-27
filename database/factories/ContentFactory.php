<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Clio\Content;
use Clio\ContentType;
use Faker\Generator as Faker;

$factory->define(Content::class, function (Faker $faker) {
    return [
		'content_type' => function () {
            return factory(ContentType::class)->create()->id;
        },
        'title' => $faker->sentence,
        'body'  => $faker->paragraph,
    ];
});
