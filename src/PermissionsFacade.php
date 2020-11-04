<?php

namespace Uteq\Permissions;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Uteq\Permissions\Permissions
 */
class PermissionsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'move-permissions';
    }
}
