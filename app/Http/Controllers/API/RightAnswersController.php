<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RightAnswer;
use App\Question;
use App\User;
use Illuminate\Support\Facades\Validator;

class RightAnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->isMethod("get")){

            $rightAnswer = RightAnswer::with("user", "question")->paginate(5);
            $this->authorize('view', $rightAnswer->first());
            
            $response = array(
                "isadmin"=> auth()->user()->role->name==="admin",
                "rightAnswer" => $rightAnswer,
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
                'user_id' => 'required|numeric|integer',
                'question_id' => 'required|numeric|integer',
                'answer_id' => 'required|numeric|integer'
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

            $user_id = $request->user_id;
            $answer_id = $request->answer_id;
            $question_id = $request->question_id;

            if($request->isMethod("post")){

                $rightAnswer = new RightAnswer;
                $rightAnswer->user_id = $user_id;
                $rightAnswer->question_id = $question_id;
                $rightAnswer->answer_id = $answer_id;

                $this->authorize('create', $rightAnswer);
                $rightAnswer->save();

            }

            $response = array(
                "message" => "Stored",
                "request" => $request->all(),
            );
            
            return response()->json($response);

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
                'rightAnswer' => 'required|integer|numeric',
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

                $rightAnswer = RightAnswer::with("user", "question")->find($request->rightAnswer);
                $this->authorize('view', $rightAnswer);
                $response = array(
                    "rightAnswer" => $rightAnswer,
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
                'rightAnswer_id' => 'required|numeric|integer',
                'user_id' => 'required|integer|numeric',
                'question_id' => 'required|integer|numeric'
            ]
        );
        $errors = $validation->errors();

        $rightAnswer_id = $request->rightAnswer_id;
        $user_id = $request->user_id;
        $question_id = $request->question_id;

        if($validation->fails()){

            $response = array(
                "message" => "Failed",
                "errors" => $errors,

            );
            return response()->json($response);

        }
        else{

            if($request->isMethod("patch")){

                $rightAnswer = RightAnswer::find($rightAnswer_id);
                $rightAnswer->user_id = $request->user_id ? $request->user_id : $rightAnswer->user_id;
                $rightAnswer->question_id = $request->question_id ? $request->question_id : $rightAnswer->question_id;
                $this->authorize('update', $rightAnswer->first());
                $rightAnswer->save();

                $response = array(
                    "message" => "Updated",
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
                'rightAnswer' => 'required|integer|numeric',
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

                $rightAnswer = RightAnswer::find($request->rightAnswer);
                $this->authorize('delete', $rightAnswer);
                $rightAnswer->delete();
    
                $response = array(
                    "message" => "Deleted",
                    "request" => $request->all(),
                );
                
                return response()->json($response);

            }

        }

    }
    
}
