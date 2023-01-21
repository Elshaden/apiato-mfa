<?php

namespace App\Containers\Vendor\Mfa\UI\API\Controllers;

use App\Containers\Vendor\Mfa\Actions\GenerateOtpCodeAction;
use App\Containers\Vendor\Mfa\Actions\VaildateOtpKeyByUserIdAction;
use App\Containers\Vendor\Mfa\UI\API\Requests\CreateOtpKeyRequest;
use App\Containers\Vendor\Mfa\UI\API\Requests\DeleteOtpKeyRequest;
use App\Containers\Vendor\Mfa\UI\API\Requests\GenerateOtpCodeRequest;
use App\Containers\Vendor\Mfa\UI\API\Requests\UpdateOtpKeyRequest;
use App\Containers\Vendor\Mfa\UI\API\Requests\ValidateOtpKeyByUserIdRequest;
use App\Containers\Vendor\Mfa\UI\API\Transformers\OtpKeyTransformer;
use App\Containers\Vendor\Mfa\Actions\CreateOtpKeyAction;
use App\Containers\Vendor\Mfa\Actions\UpdateOtpKeyAction;
use App\Containers\Vendor\Mfa\Actions\DeleteOtpKeyAction;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{

    public function createOtpKey(CreateOtpKeyRequest $request)
    {
        $otpkey = app(CreateOtpKeyAction::class)->run($request);
        return $this->transform($otpkey, OtpKeyTransformer::class,[],[],'MfaKey');
    }

    public function ValidateOtpKeyByUserId(ValidateOtpKeyByUserIdRequest $request){

          $Valid = app(VaildateOtpKeyByUserIdAction::class)->run($request);
          return response()->json(['result'=>$Valid], 200);
    }


    public function updateOtpKey(UpdateOtpKeyRequest $request): array
    {
        $otpkey = app(UpdateOtpKeyAction::class)->run($request);
        return $this->transform($otpkey, OtpKeyTransformer::class);
    }

    public function DeleteMfa(DeleteOtpKeyRequest $request): JsonResponse
    {
        app(DeleteOtpKeyAction::class)->run($request);
        return $this->noContent();
    }


      public function GenerateOtpCode(GenerateOtpCodeRequest $request): JsonResponse
      {
            $otpkey = app(GenerateOtpCodeAction::class)->run($request);
            return response()->json(['code'=>$otpkey], 200) ;
      }


}
