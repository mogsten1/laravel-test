<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Group;
use Validator;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $group = Group::all();
        return response()->json($group);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:group,name',
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        //
        $group = Group::create($request->all());

        return response()->json($group);
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
        $group = Group::find($id);
        return response()->json(['group' => $group]);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:group,name',
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        //
        $group = Group::find($id);
        if($group->update(json_encode($request->all()))){
            return response()->json(['message' => 'group updated']);
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
        $group = Group::find($id);
        if($group->delete()){
            return response()->json(['result' => 'success']);
        }
    }
}
