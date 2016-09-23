<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Keys
    |--------------------------------------------------------------------------
    |
    | Set the public and private API keys as provided by reCAPTCHA.
    |
    | In version 2 of reCAPTCHA, public_key is the Site key,
    | and private_key is the Secret key.
    |
    */
    /*'public_key'     => env('RECAPTCHA_PUBLIC_KEY', '6LfixSITAAAAAJTmMGi8svEItXluqn9o2doXPj10'),
    'private_key'    => env('RECAPTCHA_PRIVATE_KEY', '6LfixSITAAAAAGZ6443uTpx6K4QplUdClEdFAbtF'),*/
    'public_key'     => env('RECAPTCHA_PUBLIC_KEY', '6LcpdgcUAAAAANIOrYiOhYt5kVVs3MLfQHabhF3J'),
    'private_key'    => env('RECAPTCHA_PRIVATE_KEY', '6LcpdgcUAAAAAEgpgqS7zDXksiY_ELMSqPGb45Fq'),

    /*
    |--------------------------------------------------------------------------
    | Template
    |--------------------------------------------------------------------------
    |
    | Set a template to use if you don't want to use the standard one.
    |
    */
    'template'    => '',

    /*
    |--------------------------------------------------------------------------
    | Driver
    |--------------------------------------------------------------------------
    |
    | Determine how to call out to get response; values are 'curl' or 'native'.
    | Only applies to v2.
    |
    */
    'driver'      => 'curl',

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    |
    | Various options for the driver
    |
    */
    'options'     => [

        'curl_timeout' => 1,

    ],

    /*
    |--------------------------------------------------------------------------
    | Version
    |--------------------------------------------------------------------------
    |
    | Set which version of ReCaptcha to use.
    |
    */

    'version'     => 2,

];
