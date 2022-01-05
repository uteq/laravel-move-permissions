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

    /**
     * @return (Id|Permissions|Text)[]
     *
     * @psalm-return array{0: Id, 1: Text, 2: Permissions}
     */
    public function fields()
    {
        return [
            Id::make(),

            Text::make('Name', 'name')
                ->required(),

            Permissions::make('Permissions', 'permissions'),
        ];
    }

    /**
     * @return array
     *
     * @psalm-return array<empty, empty>
     */
    public function actions()
    {
        return [

        ];
    }

    /**
     * @return array
     *
     * @psalm-return array<empty, empty>
     */
    public function filters()
    {
        return [
        ];
    }

    /**
     * @return string
     */
    public function icon()
    {
        return 'heroicon-o-lock-closed';
    }
}
