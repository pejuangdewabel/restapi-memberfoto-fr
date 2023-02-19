<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Model\MemberFoto;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function simpan(Request $request)
    {
        $data = array(
            'idMember'  =>  $request->idMember,
            'foto'      => file_get_contents($request->file('foto')),
            'updatedOn' =>  date('Y-m-d H:i:s')
        );
        MemberFoto::create($data);

        return redirect()->back();
    }
}
