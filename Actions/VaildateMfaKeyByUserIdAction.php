<?php

namespace App\Containers\Vendor\Mfa\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;


class VaildateMfaKeyByUserIdAction extends Action
{
      public function run(Request $request)
      {
            $data = $request->sanitizeInput([
                  'id',
                  'pin',
                  'class',
                  'minutes'

            ]);
            $Mfabel = app(GetMfableClass::class)->run($data);

            isset($data['minutes']) ? $minutes = $data['minutes'] : $minutes = Null;

            $Code = $Mfabel->ValidateKey($data['pin'], $minutes);
            return $Code;
      }
}
