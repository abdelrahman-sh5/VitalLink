<?php
namespace App;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class MyRole extends Role
{
    use HasRoles;
    protected $fillable = ['name', 'guard_name'];

    public static function getAll()
    {
        return Role::all();
    }
}
