<?php

namespace Uteq\MovePermissions\Fields;

use Spatie\Permission\Models\Permission;
use Uteq\Move\Fields\Field;

class Permissions extends Field
{
    public string $component = 'permissions-field';

    public function __construct(string $name, string $attribute = null, callable $callableValue = null)
    {
        parent::__construct($name, $attribute, $callableValue);

        $this->beforeStore(function ($model, $data, $value) {
            $permissions = collect($data['permissions'] ?? [])
                ->map(fn ($value) => $value['name'] ?? $value);

            $model->syncPermissions($permissions);

            unset($data['permissions']);

            return $data;
        });
    }

    public function getOptions()
    {
        /** @var Permission $permissionClass */
        $permissionClass = app(Permission::class)->getPermissionClass();
        $permissions = $permissionClass::all()->groupBy('group');

        return $permissions;
    }
}
