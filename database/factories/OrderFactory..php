<?php
use App\Models\Order;
use Faker\Generator as Faker;
$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'location_id' => $faker->numberBetween(1, 100) ,
        'title' => $faker->word,
        'description' => $faker->paragraph(1),
        'email' => $faker->unique()->safeEmail,
    ];
});
