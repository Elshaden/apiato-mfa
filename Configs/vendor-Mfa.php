<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Vendor Section OtpKey Container
    |--------------------------------------------------------------------------
    |
    |
    |
    */
      'QR_Code_size'=>120,  // Pixels


      'application_name'=>'WahdaOnline', // The name of the application that will be used in the QR code

      'mfa_email_attribute' => 'email', // The attribute of the user or any other  model that contains the email address you can use a clas to get the email address

      'default_mfable'=>'App\Containers\AppSection\Customer\Models\Customer',

      'mfable_types' => [
            'User'=>'App\Containers\AppSection\User\Models\User',
            'Customer'=>'App\Containers\AppSection\Customer\Models\Customer',
            ],


  'auth_middleware'=> 'api'   ,
];
