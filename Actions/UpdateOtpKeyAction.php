<?php

namespace App\Containers\Vendor\Mfa\Actions;

use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Containers\Vendor\Mfa\Models\OtpKey;
use App\Containers\Vendor\Mfa\Tasks\UpdateOtpKeyTask;
use App\Ship\Exceptions\NotAuthorizedResourceException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class UpdateOtpKeyAction extends Action
{
      public function run(Request $request): OtpKey
      {
            $data = $request->sanitizeInput([
                  'user_id',
                  'class',
            ]);

            $Mfabel = app(GetMfableClass::class)->run($data);

            $Mfakey = $Mfabel->UpdateKey();

            return $Mfakey;

      }
}
