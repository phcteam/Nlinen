<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'HptCode',
        'FacCode',
        'FName',
        'userName',
        'password',
        'IsCancel',
        'permission_id',
        'Count',
        'Modify_Date',
        'TimeOut',
        'lang',
        'email',
        'IsActive',
        'chk_logoff',
        'pic',
        'Active_mail',
        'DepCode',
        'DocDate',
        'Modify_Code',
        'remask',
        'EngPerfix',
        'EngName',
        'EngLName',
        'ThPerfix',
        'ThName',
        'ThLName',
        'Lastmouse_Date',
    ];
    protected $hidden = [
        'Password',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['Password'] = md5($value);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id', 'id');
    }
}
