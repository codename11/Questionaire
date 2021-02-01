<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PivotStatus;
use Illuminate\Support\Facades\Validator;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->isMethod("get")){

            $pivotStatus = PivotStatus::all()->paginate(5);
            $response = array(
                "pivotStatus" => $pivotStatus,
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
        $this->authorize('create', auth()->user());
        $validation = Validator::make(
            $request->all(),
            [
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

                $pivotStatus = new PivotStatus;
                $pivotStatus->name = $request->name;
                
                $pivotStatus->save();

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
                'status_id' => 'required|integer|numeric',
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

                $pivotStatus = PivotStatus::find($request->status_id);

                $response = array(
                    "pivotStatus" => $pivotStatus,
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
        $this->authorize('create', auth()->user());
        $validation = Validator::make(
            $request->all(),
            [
                "status_id" => 'required|integer',
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

                $pivotStatus = PivotStatus::find($request->status_id);
                $pivotStatus->name = $request->name;
                
                $pivotStatus->save();

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
        $this->authorize('create', auth()->user());
        $validation = Validator::make(
            $request->all(),
            [
                'status_id' => 'required|integer|numeric',
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

                $pivotStatus = PivotStatus::find($request->status_id);
                $pivotStatus->delete();
    
                $response = array(
                    "message" => "Deleted",
                    "request" => $request->all(),
                );
                
                return response()->json($response);

            }

        }
    
    }
    
}
