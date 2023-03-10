<?php

/**
 * @apiGroup           MfaKey
 * @apiName            createMfaKey
 *
 * @api                {POST} /v1/otpkeys Endpoint title here..
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
 * {
 * // Insert the response of the request here...
 * }
 */

use App\Containers\Vendor\Mfa\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;


Route::get('generate-pin/{id}/{class?}', [Controller::class, 'GenerateOtpCode'])
    ->name('api_otpkey_generate_otp_code')
  ->middleware([config('vendor-Mfa.auth_middleware')]);

