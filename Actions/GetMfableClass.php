<?php

namespace App\Containers\Vendor\Mfa\Actions;

use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Requests\Request;

class GetMfableClass
{

      public function run(array $data)
      {

            if (isset($data['class']) && $data['class']) {

                  $Class = $data['class'];
            } else {
                  $Class = config('vendor-Mfa.default_mfable');
            }

            try {
                  return app()->make($Class)->find($data['id']);
            } catch (\Exception $e) {
                  throw new NotFoundException('Mfable Not Found');
            }



      }
}
