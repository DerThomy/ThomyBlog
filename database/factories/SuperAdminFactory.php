<?php

use Faker\Generator as Faker;

$factory->define(App\SuperAdmin::class, function (Faker $faker) {
    return [
        'name' => 'SA Thomas',
        'email' => 'thomaskoehler@gmx.at',
        'password' => Hash::make('Anakankoe99')
    ];
});
