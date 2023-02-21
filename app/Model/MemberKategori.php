<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MemberKategori extends Model
{
    protected $table = 'memberkategori';
    protected $fillable = [
        'idKategori',
        'deskripsi',
        'kodeKat',
        'statusKat',
        'idca',
        'pgu',
        'kwitansi',
        'bulanBerlaku',
        'hariBerlaku',
        'kendaraanByr',
        'cetakFoto',
        'indexKat',
        'unit',
        'maxNmLength',
        'fingerCheck',
        'smartCheck',
        'editValidDate',
        'defaultDate',
        'GRM',
        'Alias',
        'eCard',
        'eCardTemplatePath',
        'BusinessUnit'
    ];
    public $timestamps = false;
}
