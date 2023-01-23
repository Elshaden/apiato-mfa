<?php

/**
 * @apiGroup           MfaKey
 * @apiName            findMfaKeyById
 *
 * @api                {GET} /v1/otpkeys/:id Endpoint title here..
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

Route::post('validate-mfa', [Controller::class, 'ValidateMfaKeyByUserId'])
    ->name('api_otpkey_validate_otp_key_by_user_id')
  ->middleware([ config('vendor-Mfa.auth_middleware')]);

