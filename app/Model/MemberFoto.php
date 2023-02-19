<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MemberFoto extends Model
{
    protected $table = 'memberfoto';
    protected $fillable = [
        'idMember',
        'foto',
        'updatedOn'
    ];
    public $timestamps = false;
}
