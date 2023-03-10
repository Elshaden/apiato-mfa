<?php

/**
 * @apiGroup           MfaKey
 * @apiName            updateMfaKey
 *
 * @api                {PATCH} /v1/otpkeys/:id Endpoint title here..
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

use App\Containers\Vendor\Mfa\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('mfakeys/{id}/{class?}', [Controller::class, 'updateMfaKey'])
    ->name('api_otpkey_update_otp_key')
  ->middleware([config('vendor-Mfa.auth_middleware')]);

