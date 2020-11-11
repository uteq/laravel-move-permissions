<?php

namespace Uteq\MovePermissions\Resources;

use Uteq\Move\Fields\Id;
use Uteq\Move\Fields\Text;
use Uteq\Move\Resource;
use Uteq\MovePermissions\Fields\Permissions;

class Role extends Resource
{
    /** The model the resource corresponds to.*/
    public static string $model = \Uteq\MovePermissions\Models\Role::class;

    public static array $search = [
        'name',
    ];

    public static ?int $defaultPerPage = 25;

    public static string $title = 'name';

    public function fields()
    {
        return [
            Id::make(),

            Text::make('Name', 'name')
                ->required(),

            Permissions::make('Permissions', 'permissions'),
        ];
    }

    public function actions()
    {
        return [

        ];
    }

    public function filters()
    {
        return [
        ];
    }

    public function icon()
    {
        return 'heroicon-o-lock-closed';
    }
}
