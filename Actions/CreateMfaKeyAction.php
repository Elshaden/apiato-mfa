<?php

namespace App\Containers\Vendor\Mfa\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;


class CreateMfaKeyAction extends Action
{
     public function run(Request $request)
      {
            $data = $request->sanitizeInput([
                  'key',
                  'class',

            ]);
            $Mfabel = app(GetMfableClass::class)->run($data);

            $Mfa = $Mfabel->CreateMfaKey();
            return $Mfa;

      }
}
