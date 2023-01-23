<?php

namespace App\Containers\Vendor\Mfa\Tasks;

use App\Containers\Vendor\Mfa\Data\Repositories\MfaKeyRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteMfaKeyTask extends Task
{
    protected MfaKeyRepository $repository;

    public function __construct(MfaKeyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id): ?int
    {
        try {
            return $this->repository->delete($id);
        }
        catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
