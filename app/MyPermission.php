<?php
namespace App;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;

class MyPermission extends Permission
{
    protected $fillable = ['name'];

    public static function getAll()
    {
        return MyPermission::all();
    }

}
