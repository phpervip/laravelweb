<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use App\Models\User\Address;

$factory->define(Address::class, function (Faker $faker) {
    $address = [
        [2,52,500],
        [3,36,398],
        [16,220,1834],
        [31,383,3229],
        [6,77,705]
    ];
    $address = $faker->randomElement($address);

    $updated_at = $faker->dateTimeThisMonth();
    $created_at = $faker->dateTimeThisMonth($updated_at);

    return [
        'province_id'=> $address[0],
        'city_id'    => $address[1],
        'district_id'=> $address[2],
        'address'    => sprintf('第%d街道第%d号',$faker->randomNumber(2),$faker->randomNumber(3)),
        'created_at' => $created_at,
        'updated_at' => $updated_at,
    ];
});
