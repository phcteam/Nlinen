<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewLinen extends Model
{

    use HasFactory;
    protected $table = 'new_linen';
    protected $fillable = [
        'DocNo',
        'DocDate',
        'HptCode',
        'IsStatus',
        'FacCode',
        'SignFac',
        'SignNH',
        'SignFacTime',
        'SignNHTime'
    ];
}
