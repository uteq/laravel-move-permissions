<?php

namespace Uteq\MovePermissions\Filters;

use Illuminate\Database\Eloquent\Builder;
use Uteq\Move\Filters\Filter;
use Uteq\MovePermissions\Resources\Permission;

class PermissionGroupFilter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public string $component = 'select-filter';

    /** @var string */
    public string $name = 'Permissies groep';

    /**
     * Apply the filter to the given query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply($query, $value): Builder
    {
        if (empty($value)) {
            return $query;
        }

        return $query->where('group', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @return array
     */
    public function options()
    {
        return Permission::$model::all()
            ->unique('group')
            ->pluck('group')
            ->mapWithKeys(fn ($group) => [ucfirst($group) => $group])
            ->toArray();
    }
}
