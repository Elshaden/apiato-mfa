<?php

namespace App\Containers\Vendor\Mfa\Actions;

use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Requests\Request;

class GetMfableClass
{

      public function run(array $data)
      {

            if (isset($data['class']) && $data['class']) {

                  $Class = config('vendor-Mfa.mfable_types')[$data['class']];
            } else {
                  $Class = config('vendor-Mfa.default_mfable');
            }

            try {

                  return app()->make($Class)->where(config('vendor-Mfa.request_key') , $data['key'])
                        ?->first()
                        ??throw new NotFoundException('Mfable Not Found');
            } catch (\Exception $e) {
                  throw new NotFoundException('Mfable Not Found');
            }


      }
}
