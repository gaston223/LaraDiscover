<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bookable;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$suffix = [
    'VW Combi Westfalia "Schwarz" 1.6 vert/blanc',
    'VW Combi Westfalia 2.0 jaune',
    'VW Combi T1 "Georwing" vert/blanc',
    'VW Combi T2 "Nicolae" jaune/blanc',
    'VW Combi T2 "Karvounis" multicolor',
    'VW Combi T2 "Caleb" beige/blanc ',
    'VW Combi T2 "Pedersen" orange/blanc',
    'VW Combi T2 "Theby" bleu/blanc',
    'VW Combi T1 "Sevcovic" vert pomme/blanc',
    'VW Combi T1 "Fisherman" blanc',

];

$factory->define(Bookable::class, function (Faker $faker) use ($suffix) {
    return [
        'title' => Arr::random($suffix),
        'description' => $faker->text(),
        'price' => random_int(100, 200)
    ];
});
