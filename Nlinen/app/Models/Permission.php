<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $fillable = [
        'permission',
        'name_Th',
        'name_Eng',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'permission_id', 'id');
    }
}
