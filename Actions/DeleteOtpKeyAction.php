<?php

namespace App\Containers\Vendor\Mfa\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class DeleteOtpKeyAction extends Action
{
    public function run(Request $request)
    {

              $data = $request->sanitizeInput([
                  'id',
                  'class',
              ]);
              $Mfabel = app(GetMfableClass::class)->run($data);
              $Mfabel->DeleteKey();
              return $Mfabel;
      //  return app(DeleteOtpKeyTask::class)->run($request->id);
    }
}
