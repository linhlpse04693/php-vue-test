<?php

namespace App\Repositories\Status;

use App\Models\Status;
use Prettus\Repository\Eloquent\BaseRepository;

class StatusRepositoryEloquent extends BaseRepository implements StatusRepository
{
    public function model(): string
    {
        return Status::class;
    }
}
