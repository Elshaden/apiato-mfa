<?php

namespace App\Containers\Vendor\Mfa\Models;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Models\Model;

class OtpKey extends Model
{



      protected $fillable = [
            'uuid',
            'code',
            'qr_code',
            'active'
      ];

      protected $attributes = [

      ];

      protected $hidden = [

      ];

      protected $casts = [
            'active' => 'boolean',
      ];

      protected $dates = [
            'created_at',
            'updated_at',
      ];

      public function mfable()
      {

            return $this->morphs('mfable', 'mfable_type', 'mfable_id');
      }

      /**
       * A resource key to be used in the serialized responses.
       */
      protected string $resourceKey = 'MfaKey';
}
