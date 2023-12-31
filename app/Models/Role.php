<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    use HasUuids;

    protected $fillable = [
        'id',
        'name',
        'guard_name',
    ];

    const ROOT = 'root';
    const ADMIN = 'admin';
    const USER = 'user';

    public static function defaultRoles()
    {
        return [
            'root', 'admin', 'user'
        ];
    }
}
