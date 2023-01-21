<?php

namespace App\Containers\Vendor\Mfa\Traits;

use Illuminate\Support\Str;

trait UuidTrait
{
      /**
       * Boot function from Laravel.
       */
      protected static function boot()
      {
            parent::boot();
            static::creating(function ($model) {
                  if (empty($model->{$model->getKeyName()})) {
                        $model->uuid = Str::uuid()->toString();
                  }
            });
      }
}
