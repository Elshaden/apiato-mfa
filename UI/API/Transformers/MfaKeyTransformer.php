<?php

namespace App\Containers\Vendor\Mfa\UI\API\Transformers;

use App\Containers\Vendor\Mfa\Models\MfaKey;
use App\Ship\Parents\Transformers\Transformer;

class MfaKeyTransformer extends Transformer
{

      /**
       * @var  array
       */
      protected array $defaultIncludes = [

      ];

      /**
       * @var  array
       */
      protected array $availableIncludes = [

      ];

      public function transform(MfaKey $otpkey): array
      {
            $response = [
                  'object' => 'Mfa',
                  'id' => $otpkey->getHashedKey(),
                  'mfable_type' => $otpkey->mfable_type,
                  'mfable_id' => $otpkey->mfable_id,
                  'code' => decrypt($otpkey->code),
                  'qr_code' => decrypt($otpkey->qr_code),
                  'active' => $otpkey->active,
                  'created_at' => $otpkey->created_at,
                  'updated_at' => $otpkey->updated_at,


            ];

           return $response;
      }
}
