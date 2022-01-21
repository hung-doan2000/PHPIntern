<?php


namespace App\Repositories\Admin\Permission;


use App\Repositories\BaseRepository;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Permission::class;
    }
}
