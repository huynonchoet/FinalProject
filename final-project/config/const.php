<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Status Order
    |--------------------------------------------------------------------------
    |
    | Show the status of the order
    |
    */


    'discount' => [
        'max' => '50',
        'min' => '0',
    ],

    'imageRoom'=>[
        'max' => 6,
        'min' => 2,
    ],

    'imageHomestay'=>[
        'max' => 6,
        'min' => 2,
    ],

    'social' => [
        'facebook' => 'facebook',
        'google' => 'google',
        'github' => 'github',
    ],

    'booking' => [
        'pending' => 1,
        'accepted' => 2,
        'cancelled' => 3
    ]
    
];
