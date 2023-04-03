<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GeneralRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class GeneralRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gen_request = GeneralRequest::all();
        return response()->json([
            "success" => true,
            "message" => "Request List",
            "data" => $gen_request
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
            'phone' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $gen_request = GeneralRequest::create($input);
        return response()->json([
            "success" => true,
            "message" => "Created successfully.",
            "data" => $gen_request,
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
        $gen_request = GeneralRequest::where('id',$id)->firstOrFail();
        if (is_null($gen_request)) {
            return $this->sendError('Not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "Retrieved successfully.",
            "data" => $gen_request
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
        $gen_request = GeneralRequest::where('id',$id)->firstOrFail();
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'phone' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $gen_request->name = $input['name'];
        $gen_request->phone = $input['phone'];
        $gen_request->save();
        return response()->json([
            "success" => true,
            "message" => "Updated successfully.",
            "data" => $gen_request
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
        $gen_request = GeneralRequest::where('id',$id)->firstOrFail();
        $gen_request->delete();
        return response()->json([
            "success" => true,
            "message" => "Deleted successfully.",
            "data" => $gen_request
        ]);
    }
}