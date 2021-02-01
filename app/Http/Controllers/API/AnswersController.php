<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Answer;
use App\Question;
use Illuminate\Support\Facades\Validator;

class AnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $answers = Answer::with("question", "user")->paginate(5);
        $this->authorize('view', $answers->first());
        
        $response = array(
            "answers" => $answers,
            "request" => $request->all(),
        );
        
        return response()->json($response);
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
        
        $name = $request->answer;
        $question_id = $request->question_id;
        $user_id = $request->user_id;

        $validation = Validator::make(
            $request->all(),
            [
                'answer' => 'required|max:255',
                'question_id' => 'required|integer',
                'user_id' => 'required|integer'
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

                $answer = new Answer;
                $answer->name = $name;
                $answer->question_id = $question_id;   
                $answer->user_id = $user_id;   
                $this->authorize('create', $answer);
                $answer->save();

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
        $answer = Answer::with("question", "user")->find($request->answer_id);
        $this->authorize('view', $answer);
        $response = array(
            "answer" => $answer,
            "request" => $request->all(),
        );
        
        return response()->json($response);
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
        $name = $request->answer;
        $answer_id = $request->answer_id;
        $question_id = $request->question_id;

        $validation = Validator::make(
            $request->all(),
            [
                'answer' => 'required|max:255',
                'answer_id' => 'required|integer',
                'question_id' => 'required|integer',
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

                $answer = Answer::find($request->answer_id);
                $answer->name = $name;
                $answer->question_id = $question_id; 
                $this->authorize('update', $answer);    
                $answer->save();

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
                'answer_id' => 'required|integer|numeric',
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

                $answer = Answer::find($request->answer_id);
                $this->authorize('delete', $answer);
                $answer->delete();
    
                $response = array(
                    "message" => "Deleted",
                    "request" => $request->all(),
                );
                
                return response()->json($response);

            }

        }
    }
}
