<?php

use Faker\Generator as Faker;

$factory->define(App\Admin::class, function (Faker $faker) {
    return [
        'name' => 'Admin',
        'email' => 'thomaskoehler@gmx.at',
        'password' => Hash::make('Anakankoe99')
    ];
});
