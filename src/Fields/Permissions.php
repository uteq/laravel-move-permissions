<?php

namespace Uteq\Move\Fields;

use Spatie\Permission\Models\Permission;

class Permissions extends Field
{
    public string $component = 'permissions-field';

    public function getOptions(): array
    {
        /** @var Permission $permissionClass */
        $permissionClass = app(Permission::class)->getPermissionClass();
        $permissions = $permissionClass::all()->map(function ($permission, $key) {
            dd(__(ucfirst($permission->group)));
        });
    }
}
