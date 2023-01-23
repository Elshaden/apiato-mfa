<?php

namespace App\Containers\Vendor\Mfa\Tasks;

use App\Containers\Vendor\Mfa\Data\Repositories\MfaKeyRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateMfaKeyTask extends Task
{
    protected MfaKeyRepository $repository;

    public function __construct(MfaKeyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        try {
            return $this->repository->update($data, $id);
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
