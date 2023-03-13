<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MemberDocument extends Model
{
    protected $table = 'memberdocument';
    protected $fillable = [
        'idMember',
        'document',
        'updatedOn'
    ];
    public $timestamps = false;
}
