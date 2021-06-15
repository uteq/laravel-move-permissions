<?php

namespace Uteq\MovePermissions\Fields;

use Uteq\Move\Fields\Select;

class Role extends Select
{
    public string $component = 'role';

    public function __construct(string $name, string $attribute = null, callable $callableValue = null)
    {
        parent::__construct($name, $attribute, $callableValue);

        $this->placeholder = (string) __('Select a role');

        $this->beforeStore(function ($value, $field, $model, $data) {

            $model->syncRoles($value);

            return $value;
        });

        $this->callableValue = function ($value, $user, $field) {
            return optional($user->roles()->first())->name;
        };
    }
}
