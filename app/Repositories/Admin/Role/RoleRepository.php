<?php


namespace App\Repositories\Admin\Role;


use App\Repositories\BaseRepository;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Role::class;
    }
}
