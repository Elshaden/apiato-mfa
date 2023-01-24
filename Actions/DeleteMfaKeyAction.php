<?php

namespace App\Containers\Vendor\Mfa\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class DeleteMfaKeyAction extends Action
{
      public function run(Request $request)
      {

            $data = $request->sanitizeInput([
                  'key',
                  'class',
            ]);
            $Mfabel = app(GetMfableClass::class)->run($data);
            $Mfabel->DeleteKey();
            return $Mfabel;
            //  return app(DeleteMfaKeyTask::class)->run($request->id);
      }
}
