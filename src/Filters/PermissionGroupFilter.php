<?php

namespace Uteq\MovePermissions\Filters;

use Illuminate\Database\Eloquent\Builder;
use Uteq\Move\Filters\Filter;
use Uteq\MovePermissions\Resources\Permission;

class PermissionGroupFilter extends Filter
{
    /**
     * The name used to locate the view
     * and identify the component
     */
    public string $component = 'select-filter';

    /**
     * The user-friendly name to describe the filter
     */
    public string $name = 'Permissies groep';

    /**
     * Applies the filter to the given query.
     */
    public function apply(Builder $query, $value, $request): Builder
    {
        return empty($value)
            ? $query
            : $query->where('group', $value);
    }

    /**
     * Get the filter's available options.
     */
    public function options(): array
    {
        return Permission::$model::query()
            ->get()
            ->unique('group')
            ->pluck('group')
            ->mapWithKeys(fn ($group) => [ucfirst($group) => $group])
            ->toArray();
    }
}
