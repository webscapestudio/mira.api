<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GeneralRequest;
use App\Models\ResumeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class ResumeRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res_request = ResumeRequest::all();
        return response()->json([
            "success" => true,
            "message" => "Request List",
            "data" => $res_request
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'comment' => 'nullable',
            'attachment' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $res_request = ResumeRequest::create($input);
        // if (isset($input['attachment'])) :
        //     $res_request->attachment = $input['attachment'];
        //     $input['attachment'] = Storage::disk('public')->put('/attachments',  $input['attachment']);
        // endif;
        return response()->json([
            "success" => true,
            "message" => "Created successfully.",
            "data" => $res_request,
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $res_request = ResumeRequest::where('id',$id)->firstOrFail();
        if (is_null($res_request)) {
            return $this->sendError('Not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "Retrieved successfully.",
            "data" => $res_request
        ]);
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
        $res_request = ResumeRequest::where('id',$id)->firstOrFail();
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'comment' => 'required',
            'attachment' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $res_request->name = $input['name'];
        $res_request->email = $input['email'];
        $res_request->phone = $input['phone'];
        $res_request->comment = $input['comment'];
        $res_request->attachment = $input['attachment'];
        $res_request->save();
        return response()->json([
            "success" => true,
            "message" => "Updated successfully.",
            "data" => $res_request
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res_request = ResumeRequest::where('id',$id)->firstOrFail();
        $res_request->delete();
        return response()->json([
            "success" => true,
            "message" => "Deleted successfully.",
            "data" => $res_request
        ]);
    }
}