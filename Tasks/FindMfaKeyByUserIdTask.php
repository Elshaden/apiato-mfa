<?php

namespace App\Containers\Vendor\Mfa\Tasks;

use App\Containers\Vendor\Mfa\Data\Repositories\MfaKeyRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindMfaKeyByUserIdTask extends Task
{
    protected MfaKeyRepository $repository;

    public function __construct(MfaKeyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->findByField('user_id', $id)->first();
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
