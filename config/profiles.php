<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Package Connection
    |--------------------------------------------------------------------------
    |
    | You can set a different database connection for this package. It will set
    | new connection for models Profiles and Permission. When this option is null,
    | it will connect to the main database, which is set up in database.php
    |
    */

    'connection' => null,

    /*
    |--------------------------------------------------------------------------
    | Slug Separator
    |--------------------------------------------------------------------------
    |
    | Here you can change the slug separator. This is very important in matter
    | of magic method __call() and also a `Slugable` trait. The default value
    | is a dot.
    |
    */

    'separator' => '.',

    /*
    |--------------------------------------------------------------------------
    | Models
    |--------------------------------------------------------------------------
    |
    | If you want, you can replace default models from this package by models
    | you created. Have a look at `Laravelit\Profiles\Models\Role` model and
    | `Laravelit\Profiles\Models\Permission` model.
    |
    */

    'models' => [
        'profile' => Laravelit\Profiles\Models\Profile::class,
    	'segment' => Laravelit\Profiles\Models\Segment::class,
       /* 'jobseeker' => Laravelit\Profiles\Models\JobSeeker::class,
    	'freelance' => Laravelit\Profiles\Models\JobSeeker::class,
    	'provider' => Laravelit\Profiles\Models\JobSeeker::class,
    	'client' => Laravelit\Profiles\Models\JobSeeker::class,
    	'inverstor' => Laravelit\Profiles\Models\JobSeeker::class,
    	'incubator' => Laravelit\Profiles\Models\JobSeeker::class,
    	'employ' => Laravelit\Profiles\Models\JobSeeker::class, */
    ],

    /*
    |--------------------------------------------------------------------------
    | Profiles, Default Profile "Pretend"
    |--------------------------------------------------------------------------
    |
    | You can pretend or simulate package behavior no matter what is in your
    | database. It is really useful when you are testing you application.
    | Set up what will methods default(), list() and count() return.
    |
    */

    'pretend' => [

        'enabled' => false,

        'options' => [
        		'match' => true,
        		'enque' => true,
        ],

    ],

];
