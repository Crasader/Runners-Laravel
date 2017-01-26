<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/



/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        "firstname"=>$faker->name,
        "lastname"=>$faker->lastName,
        "name"=>$faker->unique()->name,
        "sex"=>$faker->boolean,
        "phone_number"=>$faker->phoneNumber,
        "accesstoken"=>str_random(255),
        "group_id"=>factory(\App\Group::class)->create()->id,
        "stat"=>"Actif"
    ];
});

$factory->define(App\Car::class, function (Faker\Generator $faker){
    return [
        "plate_number"=>"VD ".$faker->numberBetween(1000000,200000),
        "brand"=>$faker->company,
        "model"=>$faker->word,
        "color"=>$faker->colorName,
        "nb_place"=>$faker->numberBetween(3,7),
        "car_type_id"=>function(){return factory(App\CarType::class)->create()->id;},
        "comment"=>"",
        "name"=>$faker->word,
        "stat"=>"Actif"

    ];
});
$factory->define(App\CarType::class, function (Faker\Generator $faker){
    return [
        "type"=>$faker->unique()->word,
        "description"=>$faker->text
    ];
});
$factory->define(App\Run::class, function (Faker\Generator $faker){
    $geoFrom = trim("{
         \"address_components\" : [
            {
               \"long_name\" : \"Sydney\",
               \"short_name\" : \"Sydney\",
               \"types\" : [ \"colloquial_area\", \"locality\", \"political\" ]
            },
            {
               \"long_name\" : \"Nouvelle-Galles du Sud\",
               \"short_name\" : \"NSW\",
               \"types\" : [ \"administrative_area_level_1\", \"political\" ]
            },
            {
               \"long_name\" : \"Australie\",
               \"short_name\" : \"AU\",
               \"types\" : [ \"country\", \"political\" ]
            }
         ],
         \"formatted_address\" : \"Sydney Nouvelle-Galles du Sud, Australie\",
         \"geometry\" : {
            \"bounds\" : {
               \"northeast\" : {
                  \"lat\" : -33.5781409,
                  \"lng\" : 151.3430209
               },
               \"southwest\" : {
                  \"lat\" : -34.118347,
                  \"lng\" : 150.5209286
               }
            },
            \"location\" : {
               \"lat\" : -33.8688197,
               \"lng\" : 151.2092955
            },
            \"location_type\" : \"APPROXIMATE\",
            \"viewport\" : {
               \"northeast\" : {
                  \"lat\" : -33.5782519,
                  \"lng\" : 151.3429976
               },
               \"southwest\" : {
                  \"lat\" : -34.118328,
                  \"lng\" : 150.5209286
               }
            }
         },
         \"place_id\" : \"ChIJP3Sa8ziYEmsRUKgyFmh9AQM\",
         \"types\" : [ \"colloquial_area\", \"locality\", \"political\" ]
      }");
    $geoTo = trim("{
                    \"address_components\": [
                    {
                    \"long_name\": \"Genève Aéroport\",
                    \"short_name\": \"Genève Aéroport\",
                    \"types\": [
                    \"airport\",
                    \"establishment\",
                    \"point_of_interest\"
                    ]
                    },
                    {
                    \"long_name\": \"21\",
                    \"short_name\": \"21\",
                    \"types\": [
                    \"street_number\"
                    ]
                    },
                    {
                    \"long_name\": \"Route de l'Aéroport\",
                    \"short_name\": \"Route de l'Aéroport\",
                    \"types\": [
                    \"route\"
                    ]
                    },
                    {
                    \"long_name\": \"Le Grand-Saconnex\",
                    \"short_name\": \"Le Grand-Saconnex\",
                    \"types\": [
                    \"locality\",
                    \"political\"
                    ]
                    },
                    {
                    \"long_name\": \"Genève\",
                    \"short_name\": \"Genève\",
                    \"types\": [
                    \"administrative_area_level_2\",
                    \"political\"
                    ]
                    },
                    {
                    \"long_name\": \"Genève\",
                    \"short_name\": \"GE\",
                    \"types\": [
                    \"administrative_area_level_1\",
                    \"political\"
                    ]
                    },
                    {
                    \"long_name\": \"Suisse\",
                    \"short_name\": \"CH\",
                    \"types\": [
                    \"country\",
                    \"political\"
                    ]
                    },
                    {
                    \"long_name\": \"1215\",
                    \"short_name\": \"1215\",
                    \"types\": [
                    \"postal_code\"
                    ]
                    }
                    ],
                    \"formatted_address\": \"Genève Aéroport, Route de l'Aéroport 21, 1215 Le Grand-Saconnex, Suisse\",
                    \"geometry\": {
                    \"location\": {
                    \"lat\": 46.23700969999999,
                    \"lng\": 6.1091564
                    },
                    \"location_type\": \"APPROXIMATE\",
                    \"viewport\": {
                    \"northeast\": {
                    \"lat\": 46.2383586802915,
                    \"lng\": 6.110505380291502
                    },
                    \"southwest\": {
                    \"lat\": 46.2356607197085,
                    \"lng\": 6.107807419708498
                    }
                    }
                    },
                    \"place_id\": \"ChIJN5MjroBkjEcRMKa4TvKpEeU\",
                    \"types\": [
                    \"airport\",
                    \"establishment\",
                    \"point_of_interest\"
                    ]

                    }");
    return [
        "start_at"=>$faker->dateTimeBetween("now","+13 days"),
        "end_at"=>$faker->dateTimeBetween("+13 days","+15 days"),
        "user_id"=>function(){return \App\User::find(1)->id;},
        "car_id"=>function(){return factory(App\Car::class)->create()->id;},
        "geo_from"=>$geoFrom,
        "geo_to"=>$geoTo,
        "flight_num"=>$faker->numberBetween(0,400),
        "note"=>$faker->text
    ];
});
$factory->define(App\Group::class, function (Faker\Generator $faker){
    return [
        "active"=>true
    ];
});
