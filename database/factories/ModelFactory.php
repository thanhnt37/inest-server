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

$factory->define(
    App\Models\User::class,
    function (Faker\Generator $faker) {
        return [
            'name'                 => $faker->name,
            'email'                => $faker->email,
            'password'             => bcrypt(str_random(10)),
            'remember_token'       => str_random(10),
            'gender'               => 1,
            'telephone'            => $faker->phoneNumber,
            'birthday'             => $faker->date('Y-m-d'),
            'locale'               => $faker->languageCode,
            'address'              => $faker->address,
            'last_notification_id' => 0,
            'api_access_token'     => '',
            'profile_image_id'     => 0,
            'is_activated'         => 0,
        ];
    }
);

$factory->define(
    App\Models\AdminUser::class,
    function (Faker\Generator $faker) {
        return [
            'name'                 => $faker->name,
            'email'                => $faker->email,
            'password'             => bcrypt(str_random(10)),
            'remember_token'       => str_random(10),
            'locale'               => $faker->languageCode,
            'last_notification_id' => 0,
            'api_access_token'     => '',
            'profile_image_id'     => 0,
        ];
    }
);

$factory->define(
    App\Models\AdminUserRole::class,
    function (Faker\Generator $faker) {
        return [
            'admin_user_id' => $faker->randomNumber(),
            'role'          => 'supper_user'
        ];
    }
);

$factory->define(
    App\Models\SiteConfiguration::class,
    function (Faker\Generator $faker) {
        return [
            'locale'                => 'ja',
            'name'                  => $faker->name,
            'title'                 => $faker->sentence,
            'keywords'              => implode(',', $faker->words(5)),
            'description'           => $faker->sentences(3, true),
            'ogp_image_id'          => 0,
            'twitter_card_image_id' => 0,
        ];
    }
);

$factory->define(
    App\Models\Image::class,
    function (Faker\Generator $faker) {
        return [
            'url'                => $faker->imageUrl(),
            'title'              => $faker->sentence,
            'is_local'           => false,
            'entity_type'        => '',
            'entity_id'          => 0,
            'file_category_type' => '',
            's3_key'             => '',
            's3_bucket'          => '',
            's3_region'          => '',
            's3_extension'       => '',
            'media_type'         => 'image/png',
            'format'             => 'png',
            'file_size'          => 0,
            'width'              => 100,
            'height'             => 100,
            'is_enabled'         => true,
        ];
    }
);

$factory->define(
    App\Models\Article::class,
    function (Faker\Generator $faker) {
        return [
            'slug'               => $faker->word,
            'title'              => $faker->sentence,
            'keywords'           => implode(',', $faker->words(5)),
            'description'        => $faker->sentences(3, true),
            'content'            => $faker->sentences(3, true),
            'cover_image_id'     => 0,
            'locale'             => 'ja',
            'is_enabled'         => true,
            'publish_started_at' => $faker->dateTime,
            'publish_ended_at'   => null,
        ];
    }
);

$factory->define(
    App\Models\UserNotification::class,
    function (Faker\Generator $faker) {
        return [
            'user_id'       => \App\Models\UserNotification::BROADCAST_USER_ID,
            'category_type' => \App\Models\UserNotification::CATEGORY_TYPE_SYSTEM_MESSAGE,
            'type'          => \App\Models\UserNotification::TYPE_GENERAL_MESSAGE,
            'data'          => '',
            'locale'        => 'en',
            'content'       => 'TEST',
            'read'          => false,
            'sent_at'       => $faker->dateTime,
        ];
    }
);

$factory->define(
    App\Models\AdminUserNotification::class,
    function (Faker\Generator $faker) {
        return [
            'user_id'       => \App\Models\AdminUserNotification::BROADCAST_USER_ID,
            'category_type' => \App\Models\AdminUserNotification::CATEGORY_TYPE_SYSTEM_MESSAGE,
            'type'          => \App\Models\AdminUserNotification::TYPE_GENERAL_MESSAGE,
            'data'          => '',
            'locale'        => 'en',
            'content'       => 'TEST',
            'read'          => false,
            'sent_at'       => $faker->dateTime,
        ];
    }
);

$factory->define(App\Models\Application::class, function (Faker\Generator $faker) {
    return [
        'name'         => $faker->name,
        'bundle_id'    => $faker->creditCardNumber(),
        'version'      => $faker->numberBetween(1, 10),
        'introduction' => $faker->sentences(4, true),
        'icon'         => $faker->imageUrl(100, 100),
        'ios_url'      => $faker->url,
        'android_url'  => $faker->url,
        'ads_type'     => $faker->randomElement(['normal', 'video']),
        'message_id'   => 0,
    ];
});

$factory->define(App\Models\Message::class, function (Faker\Generator $faker) {
    return [
        'title'     => $faker->sentence,
        'message'   => $faker->sentences(4, true),
        'image_url' => $faker->imageUrl(),
        'ok_title'  => $faker->sentence,
        'url'       => $faker->url,
    ];
});

$factory->define(App\Models\Device::class, function (Faker\Generator $faker) {
    return [
        'device_id'   => $faker->creditCardNumber(),
        'name'        => $faker->name,
        'model'       => $faker->word,
        'platform'    => $faker->randomElement(['ios', 'android']),
        'os_version'  => $faker->numberBetween(1, 10),
        'lbh'         => $faker->boolean,
        'mode_player' => $faker->randomElement(['xcd', 'yt']),
        'bg'          => $faker->boolean,
        'ads_name'    => $faker->name,
    ];
});

$factory->define(App\Models\Advertisement::class, function (Faker\Generator $faker) {
    return [
        'type'        => $faker->randomElement(['normal', 'video']),
        'name'        => $faker->name,
        'icon_url'    => $faker->imageUrl(100, 100),
        'url'         => $faker->url,
        'description' => $faker->sentences(4, true),
        'image_url'   => $faker->imageUrl(),
        'video_url'   => $faker->url,
    ];
});

$factory->define(App\Models\ApplicationDevice::class, function (Faker\Generator $faker) {
    return [
        'application_id' => 0,
        'device_id'      => 0
    ];
});

/* NEW MODEL FACTORY */
