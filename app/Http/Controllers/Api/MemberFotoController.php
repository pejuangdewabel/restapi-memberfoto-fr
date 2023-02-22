<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\MemberFoto;
use Facade\FlareClient\Http\Response;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class MemberFotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return response()->json(MemberFoto::take(100)->select('idMember')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = 'FR23W7AN9H3K5RP8M4N6';

        $authorization = $request->authorization;

        if ($authorization ==  $token) {
            $rules = [
                'foto' => 'required|file|max:64',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return ResponseFormatter::error('The uploaded file exceeds the maximum allowed size', 422);
            }

            if ($request->id_member and $request->foto) {
                $data = MemberFoto::where('idMember', $request->id_member)->first();
                if ($data) {
                    $updateData = array(
                        'foto'      =>  file_get_contents($request->file('foto')),
                    );
                    MemberFoto::where('idMember', $request->id_member)->update($updateData);
                    return ResponseFormatter::success('Accepted');
                } else {
                    return ResponseFormatter::error('Data Not Found', 404);
                }
            } else {
                return ResponseFormatter::error('Bad Request', 400);
                // Kode ini menunjukkan bahwa server tidak memahami permintaan dikarenakan syntax yang invalid.
            }
        } else {
            return ResponseFormatter::error('Unauthorized', 401);
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

    public function getFoto($authorization, $id)
    {
        $token = 'FR23W7AN9H3K5RP8M4N6';

        try {
            $authorizationDecrypt = Crypt::decrypt($authorization);
            $idDecrypt = Crypt::decrypt($id);
            if ($idDecrypt and $authorizationDecrypt == $token) {
                $photo = MemberFoto::where('idMember', $idDecrypt)->first();

                if ($photo) {
                    return response($photo->foto, 200)->header('Content-Type', 'image/jpeg');
                } else {
                    return response()->json([
                        'code'      => 404,
                        'status'    => false,
                        'message'   => 'Data Not Found'
                    ]);
                }
            } else {
                return response()->json([
                    'code'      => 401,
                    'status'    => false,
                    'message'   => 'Unauthorized'
                ]);
            }
        } catch (DecryptException $e) {
            return response()->json([
                'code'      => 404,
                'status'    => false,
                'message'   => 'Data Not Found'
            ]);
        }
    }
}
