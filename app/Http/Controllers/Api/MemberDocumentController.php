<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\MemberData;
use App\Model\MemberDocument;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberDocumentController extends Controller
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
        $token = 'FR23W7AN9H3K5RP8M4N6';

        $authorization = $request->authorization;

        if ($authorization ==  $token) {
            $rules = [
                'document' => 'required|file|max:3000',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return ResponseFormatter::error('The uploaded file exceeds the maximum allowed size', 422);
            }

            $checkData = MemberData::where('idMember', $request->idMember)->first();
            if ($checkData) {
                $checkDataDocument = MemberDocument::where('idMember', $request->idMember)->first();
                if ($checkDataDocument) {
                    $updateData = array(
                        'document' => file_get_contents($request->file('document')),
                        'updatedOn' => now()
                    );
                    MemberDocument::where('idMember', $request->idMember)->update($updateData);
                    return ResponseFormatter::success('Accepted');
                } else {
                    $addData = array(
                        'idMember'  => $request->idMember,
                        'document'  => file_get_contents($request->file('document')),
                        'updatedOn' => now()
                    );
                    MemberDocument::create($addData);
                    return ResponseFormatter::success('Accepted');
                }
            } else {
                return ResponseFormatter::error('Data Not Found', 404);
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
        // $data = MemberDocument::where('idMember', $id)->first();
        // return response($data->document)
        //     ->header('Content-Type', 'application/pdf');
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
}
