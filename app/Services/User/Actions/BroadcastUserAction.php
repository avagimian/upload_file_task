<?php

namespace App\Services\User\Actions;

use App\Jobs\User\ProcessBroadcastJob;
use App\Models\User;
use App\Repositories\Read\User\UserReadRepositoryInterface;

class BroadcastUserAction
{
    public function __construct(
        protected UserReadRepositoryInterface $userReadRepository
    ) {
    }

    public function run(): void
    {
        $offset = 0;

        do {
            $unsentUsersIds = $this->userReadRepository->getUnsentUserIds($offset);

            if ($unsentUsersIds->isNotEmpty()) {
                ProcessBroadcastJob::dispatch($unsentUsersIds);
            }

            $offset += User::CHUNK_LIMIT;
        } while ($unsentUsersIds->isNotEmpty());
    }
}
