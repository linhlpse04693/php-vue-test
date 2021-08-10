<?php

namespace App\Repositories\Role;

use App\Models\Role;
use Prettus\Repository\Eloquent\BaseRepository;

class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    public function model(): string
    {
        return Role::class;
    }
}
