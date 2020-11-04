<?php

namespace Uteq\MovePermissions;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Uteq\MovePermissions\Permissions
 */
class PermissionsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'move-permissions';
    }
}
