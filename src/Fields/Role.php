<?php

namespace Uteq\MovePermissions\Fields;

use Uteq\Move\Fields\Select;

class Role extends Select
{
    public string $component = 'role';

    public string $useModel = \Uteq\MovePermissions\Models\Role::class;

    public function __construct(string $name, string $attribute = null, callable $callableValue = null)
    {
        parent::__construct($name, $attribute, $callableValue);

        $this->placeholder = (string) __('Select a role');

        $this->beforeStore(function ($value, $field, $model, $data) {
            $model->syncRoles($value);

            return $value;
        });

        $this->valueCallback = function ($value, $user, $field) {
            $this->setOptionsAutomatically();

            return optional($user->roles()->first())->name;
        };
    }

    public function setOptionsAutomatically()
    {
        $this->options = $this->useModel::all()
            ->mapWithKeys(fn ($role) => [
                $role->name => $role->name,
            ])
            ->toArray();
    }

    public function useModel(string $model)
    {
        $this->useModel = $model;

        return $this;
    }
}
