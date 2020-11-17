# Permissions for Laravel Move Admin Panel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/uteq/laravel-move-permissions.svg?style=flat-square)](https://packagist.org/packages/uteq/laravel-move-permissions)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/uteq/laravel-move-permissions/run-tests?label=tests)](https://github.com/uteq/laravel-move-permissions/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/uteq/laravel-move-permissions.svg?style=flat-square)](https://packagist.org/packages/uteq/laravel-move-permissions)

<b>This package is still in development and does not have a test suite.</b>

Permissions for Laravel Move enables you to create grouped permissions and is a wrapper for [Spaties Laravel Permission](https://spatie.be/docs/laravel-permission/). This package was heavily inspired by this package https://github.com/eminiarts/nova-permissions, by [eminiarts](https://github.com/eminiarts).

## Support us
The best way to support us is by adding a test suite to this project and help build, give feedback and extend it :)

## Installation

You can install the package via composer:

```bash
composer require uteq/laravel-move-permissions
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Uteq\MovePermissions\PermissionsServiceProvider" --tag="migrations"
php artisan migrate
```


You can publish the seeders with:

```bash
php artisan vendor:publish --provider="Uteq\MovePermissions\PermissionsServiceProvider" --tag="seeders"
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Uteq\MovePermissions\PermissionsServiceProvider" --tag="config"
```

## Usage

Add one of the following (or all) to your User Resource:
``` php
use Uteq\MovePermissions\Fields\Role;
use Uteq\MovePermissions\Fields\Roles;
use Uteq\MovePermissions\Fields\Permissions;

public function fields()
{
    // Add a single role to your user
    Role::make('Rol', 'role'),

    // Add more than one role to your user
    Roles::make('Roles', 'roles'),

    // Add permissions to your user
    Permissions::make('Permissions', 'permissions'),
}
```
You are free to combine the Role/Roles and Permissions.
Don't use the Role and Roles Field on the same Resource.
Make sure you add a Policy for the User to make Permissions policy work. 

### Add the Role Resource to your Move folder

```php
<?php

namespace App\Admin\Users;

class Role extends \Uteq\MovePermissions\Resources\Role
{

}
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Nathan Jansen](https://github.com/nathanjansen)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
