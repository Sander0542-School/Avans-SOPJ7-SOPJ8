<?php


namespace App\Common\Traits;


use Spatie\Permission\Models\Permission;

trait PermissionsTrait
{
    private static $types = ['*', 'update', 'delete'];

    public function createPermissions($prefix, $id)
    {
        Permission::insert($this->getRows($prefix, $id));
    }

    private function getRows($prefix, $id)
    {
        $rows = [];
        $permissions = $this->getPermissions($prefix, $id);

        foreach ($permissions as $permission) {
            $rows[] = [
                'name' => $permission,
                'guard_name' => config('fortify.guard'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        return $rows;
    }

    private function getPermissions($prefix, $id)
    {
        $permissions = [];

        foreach (self::$types as $type) {
            $permissions[] = $prefix.'.'.$type.'.'.$id;
        }

        return $permissions;
    }
}
