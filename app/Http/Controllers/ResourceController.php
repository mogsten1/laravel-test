<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Resource;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $resource = Resource::all();
        return response()->json($resource);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:resource,name',
            'group_id' => 'exists:group,id'
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $resource = Resource::create($request->all());
        return response()->json($resource);

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
        $resource = Resource::find($id);
        return response()->json(['resource' => $resource]);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:group,name',
            'group_id' => 'exists:group,id'
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        //
        $resource = Resource::find($id);
        if($resource->update(json_encode($request->all()))){
            return response()->json(['message' => 'resource updated']);
        }
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
        $resource = Resource::find($id);
        if($resource->delete()){
            return response()->json(['result' => 'success']);
        }
    }
}
