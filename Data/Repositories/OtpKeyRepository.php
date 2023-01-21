<?php

namespace App\Containers\Vendor\Mfa\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class OtpKeyRepository extends Repository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
