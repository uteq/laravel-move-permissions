<?php

namespace Uteq\MovePermissions\Fields;

use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Permission;
use Uteq\Move\Actions\UnsetField;
use Uteq\Move\Fields\Field;

class Permissions extends Field
{
    public string $component = 'permissions-field';

    public $cachedValue = null;

    public function __construct(string $name, string $attribute = null, callable $callableValue = null)
    {
        parent::__construct(
            $name,
            $attribute,
            $callableValue ?? function ($data) {
                return $data instanceof Collection
                    ? $data->mapWithKeys(fn ($item) => [$item->id => $item->name])
                    : $data;
            }
        );

        $this->beforeStore(function ($value, $_field, $model) {
            $permissions = collect($value ?? [])
                ->map(fn ($value) => $value['name'] ?? $value);

            $model->syncPermissions($permissions);

            unset($model['permissions']);

            return UnsetField::class;
        });
    }

    public function getOptions(): Collection
    {
        /** @var Permission $permissionClass */
        $permissionClass = app(config('permission.models.permission'));

        /** @noinspection PhpUnnecessaryLocalVariableInspection */
        $permissions = $permissionClass::all()
            ->groupBy('group');

        return $permissions;
    }
}
