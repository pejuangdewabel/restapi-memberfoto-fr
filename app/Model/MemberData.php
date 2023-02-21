<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MemberData extends Model
{
    protected $table = 'memberdata';
    protected $fillable = [
        'noTransaksi',
        'noForm',
        'idMember',
        'namaMember',
        'alamatMember',
        'emailMember',
        'telpMember',
        'tmpLhrMember',
        'pendMember',
        'tglLhrMember',
        'jnsKelamin',
        'akhirBerlaku',
        'idKategori',
        'lastUpdate',
        'statusBlokir',
        'ketBlokir',
        'kdUnit',
        'stsMember',
        'tglExt',
        'statusTrans',
        'ketBatal',
        'userBatal',
        'idSmart'
    ];
    public $timestamps = false;

    public function r_memberkategori()
    {
        return $this->belongsTo(MemberKategori::class, 'idKategori', 'idKategori');
    }

    public function r_memberfoto()
    {
        return $this->belongsTo(MemberFoto::class, 'idMember', 'idMember');
    }
}
