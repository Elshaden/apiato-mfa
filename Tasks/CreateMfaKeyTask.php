<?php

namespace App\Containers\Vendor\Mfa\Tasks;

use App\Containers\Vendor\Mfa\Data\Repositories\MfaKeyRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateMfaKeyTask extends Task
{
    protected MfaKeyRepository $repository;

    public function __construct(MfaKeyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {

        try {
            return $this->repository->create($data);
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
