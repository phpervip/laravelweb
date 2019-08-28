<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\News;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {

    $images = ['about-bg.jpg','contact-bg.jpg','home-bg.jpg','post-bg.jpg'];

    $title = $faker->sentence(mt_rand(3,10));

    $updated_at = $faker->dateTimeThisMonth();

    $created_at = $faker->dateTimeThisMonth($updated_at);

    return [
        'title'=>$title,
        'content'=>$faker->text(),
        'cover'=>$images[mt_rand(0,3)],
        'created_at'=>$created_at,
        'is_focus'=>rand(0,1),
        'recommend'=>rand(0,1),
        'hot'=>rand(0,1),
        'new'=>rand(0,1),
        'url'=>$faker->url,
        'updated_at'=>$updated_at,
    ];


});
