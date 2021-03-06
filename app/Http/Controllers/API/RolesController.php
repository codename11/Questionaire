<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->isMethod("get")){

            $roles = Role::with("users")->paginate(5);
            $this->authorize('view', $roles->first());
            $response = array(
                "roles" => $roles,
                "request" => $request->all(),
            );
            
            return response()->json($response);

        }
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
        
        $validation = Validator::make(
            $request->all(),
            [
                'user_id' => 'required|integer|numeric',
                'name' => 'required|max:255',
            ]
        );
        $errors = $validation->errors();

        if($validation->fails()){

            $response = array(
                "message" => "Failed",
                "errors" => $errors,

            );
            return response()->json($response);

        }
        else{

            if($request->isMethod("post")){

                $role = new Role;
                $role->name = $request->name;
                $role->user_id = $request->user_id;
                $this->authorize('create', $role);
                $role->save();

                $response = array(
                    "message" => "bravo",
                    "request" => $request->all(),
                );
                
                return response()->json($response);

            }
            
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        
        $validation = Validator::make(
            $request->all(),
            [
                'role_id' => 'required|integer|numeric',
            ]
        );
        $errors = $validation->errors();

        if($validation->fails()){

            $response = array(
                "message" => "Failed",
                "errors" => $errors,

            );
            return response()->json($response);

        }
        else{

            if($request->isMethod("get")){

                $role = Role::with("users")->find($request->role_id);
                $this->authorize('view', $role);
                $response = array(
                    "role" => $role,
                    "request" => $request->all(),
                );
                
                return response()->json($response);

            }
            
        }

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
    public function update(Request $request)
    {
        
        $validation = Validator::make(
            $request->all(),
            [
                "role_id" => 'required|integer',
                'name' => 'required|max:255',
            ]
        );
        $errors = $validation->errors();

        if($validation->fails()){

            $response = array(
                "message" => "Failed",
                "errors" => $errors,

            );
            return response()->json($response);

        }
        else{

            if($request->isMethod("patch")){

                $role = Role::find($request->role_id);
                $role->name = $request->name;
                $this->authorize('update', $role);
                $role->save();

                $response = array(
                    "message" => "bravo",
                    "request" => $request->all(),
                );
                
                return response()->json($response);

            }
            
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        $validation = Validator::make(
            $request->all(),
            [
                'role_id' => 'required|integer|numeric',
            ]
        );
        $errors = $validation->errors();

        if($validation->fails()){

            $response = array(
                "message" => "Failed",
                "errors" => $errors,

            );
            return response()->json($response);

        }
        else{

            if($request->isMethod("delete")){

                $role = Role::find($request->role_id);
                $this->authorize('delete', $role);
                $role->delete();
    
                $response = array(
                    "message" => "Deleted",
                    "request" => $request->all(),
                );
                
                return response()->json($response);

            }

        }
    
    }

}
