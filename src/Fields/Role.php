<?php

namespace Uteq\MovePermissions\Fields;

use Closure;
use Uteq\Move\Fields\Select;

class Role extends Select
{
    public string $component = 'role';

    public string $useModel = \Uteq\MovePermissions\Models\Role::class;

    public function __construct(
        string $name,
        string $attribute = null,
        Closure $valueCallback = null
    ) {
        parent::__construct($name, $attribute, $valueCallback);

        $this->placeholder = (string) __('Select a role');

        $this->beforeStore(function ($value, $_field, $model) {
            $model->syncRoles($value);

            return $value;
        });

        $this->valueCallback = function ($_value, $user) {
            $this->setOptionsAutomatically();

            return optional($user->roles()->first())->name;
        };
    }

    public function setOptionsAutomatically(): void
    {
        $this->options = $this->useModel::all()
            ->mapWithKeys(fn ($role) => [
                $role->name => $role->name,
            ])
            ->toArray();
    }

    public function useModel(string $model): self
    {
        $this->useModel = $model;

        return $this;
    }
}
