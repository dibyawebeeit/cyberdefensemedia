<?php

namespace Modules\Permission\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Permission\Database\factories\RolehaspermissionFactory;

class Rolehaspermission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table="role_has_permissions";
    protected $fillable = [
        'permission_id',
        'role_id'
    ];
    
    protected static function newFactory(): RolehaspermissionFactory
    {
        //return RolehaspermissionFactory::new();
    }
}
