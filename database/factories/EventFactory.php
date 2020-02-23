<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    return [
        //

        'title' => $faker->unique()->randomElement([
            'Adele On Tour',
            'The Jonas Brothers',
            'U2 for U',
            'Taylor Swift tour',
            'Lana Del Rey',
            'James Arthur',
            'Craig David',
            'Andrea Bocelli tour',
            'Lana Del Rey',
            'Craig David',
        ]),
        'location' => $faker->randomElement([
            'Swansea',
            'Cardiff',
            'Bridgend',
            'Ogmore by Sea',
        'Cowbridge'
        ]),
        'available_tickets' => $faker->randomDigitNot(0),
    ];
});
