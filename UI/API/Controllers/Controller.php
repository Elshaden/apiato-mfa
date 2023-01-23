<?php

namespace App\Containers\Vendor\Mfa\UI\API\Controllers;

use App\Containers\Vendor\Mfa\Actions\GenerateOtpCodeAction;
use App\Containers\Vendor\Mfa\Actions\VaildateMfaKeyByUserIdAction;
use App\Containers\Vendor\Mfa\UI\API\Requests\CreateMfaKeyRequest;
use App\Containers\Vendor\Mfa\UI\API\Requests\DeleteMfaKeyRequest;
use App\Containers\Vendor\Mfa\UI\API\Requests\GenerateOtpCodeRequest;
use App\Containers\Vendor\Mfa\UI\API\Requests\UpdateMfaKeyRequest;
use App\Containers\Vendor\Mfa\UI\API\Requests\ValidateMfaKeyByUserIdRequest;
use App\Containers\Vendor\Mfa\UI\API\Transformers\MfaKeyTransformer;
use App\Containers\Vendor\Mfa\Actions\CreateMfaKeyAction;
use App\Containers\Vendor\Mfa\Actions\UpdateMfaKeyAction;
use App\Containers\Vendor\Mfa\Actions\DeleteMfaKeyAction;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{

    public function createMfaKey(CreateMfaKeyRequest $request)
    {
        $otpkey = app(CreateMfaKeyAction::class)->run($request);
        return $this->transform($otpkey, MfaKeyTransformer::class,[],[],'MfaKey');
    }

    public function ValidateMfaKeyByUserId(ValidateMfaKeyByUserIdRequest $request){

          $Valid = app(VaildateMfaKeyByUserIdAction::class)->run($request);
          return response()->json(['result'=>$Valid], 200);
    }


    public function updateMfaKey(UpdateMfaKeyRequest $request): array
    {
        $otpkey = app(UpdateMfaKeyAction::class)->run($request);
        return $this->transform($otpkey, MfaKeyTransformer::class);
    }

    public function DeleteMfa(DeleteMfaKeyRequest $request): JsonResponse
    {
        app(DeleteMfaKeyAction::class)->run($request);
        return $this->noContent();
    }


      public function GenerateOtpCode(GenerateOtpCodeRequest $request): JsonResponse
      {
            $otpkey = app(GenerateOtpCodeAction::class)->run($request);
            return response()->json(['code'=>$otpkey], 200) ;
      }


}
