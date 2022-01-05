<?php

namespace Uteq\MovePermissions\Resources;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\PermissionRegistrar;
use Uteq\Move\Fields\Id;
use Uteq\Move\Fields\Text;
use Uteq\Move\Resource;
use Uteq\MovePermissions\Filters\PermissionGroupFilter;

class Permission extends Resource
{
    /** The model the resource corresponds to.*/
    public static string $model = \Spatie\Permission\Models\Permission::class;

    public static array $search = [
        'name',
    ];

    public static ?int $defaultPerPage = 25;

    public static string $title = 'name';

    /**
     * Creates a new resource instance.
     */
    public function __construct(Model $resource)
    {
        static::$model = get_class(app(PermissionRegistrar::class)->getPermissionClass());

        parent::__construct($resource);
    }

    public function fields(): array
    {
        return [
            Id::make(),

            Text::make(__('Name'), 'name')
                ->required(),

            Text::make(__('Group'), 'group')
                ->required(),
        ];
    }

    public function actions(): array
    {
        return [];
    }

    public function filters(): array
    {
        return [
            new PermissionGroupFilter,
        ];
    }
}
