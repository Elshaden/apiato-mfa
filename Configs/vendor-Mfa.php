<?php

return [

      /*
      |--------------------------------------------------------------------------
      | Vendor Section MfaKey Container
      |--------------------------------------------------------------------------
      |
      |
      |
      */

      /*
       *
       * The size of the QR code in pixels when generating the QR code svg
       *
       */
      'QR_Code_size' => 120,  // Pixels

      /*
       *
       * The name of the application that will be used in the QR code
       */
      'application_name' => 'WahdaOnline', // The name of the application that will be used in the QR code


      /*
       *
       * The attribute of the user or any other  model that contains the email address you can use a clas to get the email address
       * This will appear on the Qr code
       */
      'mfa_email_attribute' => 'email',


      /*
       *
       * The default mfable model that will be used if no mfable type is specified
       */
      'default_mfable' => 'App\Containers\AppSection\Customer\Models\Customer',


      /*
       *
       * The mfable Model Classes that will be used in the mfa key creation
       */
      'mfable_types' => [
            'User' => 'App\Containers\AppSection\User\Models\User',
            'Customer' => 'App\Containers\AppSection\Customer\Models\Customer',
      ],


      /*
       *
       * The default auth middleware that will be used in the mfa routes
       */
      'auth_middleware' => 'api',
];
