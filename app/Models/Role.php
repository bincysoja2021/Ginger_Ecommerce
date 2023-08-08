<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Config;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'role';
    protected $fillable = [
        'name'
    ];
    public function Permissions() {
        return $this->belongsToMany("App\Models\Permission", "rolepermission", "role_id", "permission_id");
    }
}
