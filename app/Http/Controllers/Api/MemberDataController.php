<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\MemberData;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class MemberDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = "FR23W7AN9H3K5RP8M4N6";

        $authorization = $request->header('Authorization', '');

        if ($request->idMember and $authorization == $token) {
            $data = MemberData::with([
                'r_memberkategori',
                'r_memberfoto'
            ])->where('idMember', $request->idMember)->first();

            if ($data) {
                $result = array(
                    'id_member'     => $request->idMember,
                    'nama'          => $data->namaMember,
                    'kategori'      => $data->r_memberkategori->deskripsi,
                    'validThru'     => $data->akhirBerlaku,
                    'foto'          => route('api-getFoto', ['authorization' => Crypt::encrypt($authorization), 'id' => Crypt::encrypt($request->idMember)]),
                );
                return ResponseFormatterMemberData::success($result, true);
            } else {
                return ResponseFormatterMemberData::error(null, 'Data Not Found', 404);
            }
        } else {
            return ResponseFormatterMemberData::error(null, 'Unauthorized', 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
};
