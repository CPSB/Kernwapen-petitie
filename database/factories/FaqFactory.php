<?php

use Faker\Generator as Faker;

$factory->define(App\Faq::class, function (Faker $faker) {
    return [
        'author_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'question' => $faker->realText(180),
        'answer' => $faker->realText(200)
    ];
});
