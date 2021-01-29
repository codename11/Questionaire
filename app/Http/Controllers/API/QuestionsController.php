<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Question;
use App\PivotStatus;
use App\FieldType;
use App\Questionaire;
use App\PivotQuestionaire;
use Illuminate\Support\Facades\Validator;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->isMethod("get")){

            $questions = Question::with("status", "fieldType", "answer", "questionaires")->paginate(5);
            $response = array(
                "questions" => $questions,
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
        $name = $request->name;
        $description = $request->description;
        $status_id = $request->status_id;
        $field_type_id = $request->field_type;

        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255',
                'description' => 'required|max:255',
                'status_id' => 'required|integer',
                'field_type' => 'required|integer',
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

                $question = new Question;
                $question->name = $name;
                $question->description = $description;
                $question->status_id = $status_id;
                $question->field_type_id = $field_type_id;
                
                $question->save();

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
                'question_id' => 'required|integer|numeric',
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

                $question = Question::with("status", "answer", "questionaires")->find($request->question_id);

                $response = array(
                    "question" => $question,
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
        $question_id = $request->question_id;
        $name = $request->name;
        $description = $request->description;
        $status_id = $request->status_id;
        $field_type_id = $request->field_type;

        $validation = Validator::make(
            $request->all(),
            [
                "question_id" => 'integer',
                'name' => 'max:255',
                'description' => 'max:255',
                'status_id' => 'integer',
                'field_type' => 'integer',
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

                $question = Question::find($question_id);
                $question->name = $name;
                $question->description = $description;
                $question->status_id = $status_id;
                $question->field_type_id = $field_type_id;
                
                $question->save();

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
                'question_id' => 'required|integer|numeric',
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

                $question = Question::find($request->question_id);
                $question->delete();
    
                $response = array(
                    "message" => "Deleted",
                    "request" => $request->all(),
                );
                
                return response()->json($response);

            }

        }
    }
}
