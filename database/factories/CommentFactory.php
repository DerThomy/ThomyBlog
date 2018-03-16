<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'body' => $faker->text(20),
        'user_id' => '1',
        'post_id' => '61'
    ];
});
