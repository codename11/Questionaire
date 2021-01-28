<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\PivotQuestionaire;
use App\Questionaire;
use App\Question;
use App\User;
use App\PivotStatus;

class QuestionairesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $questionaires = Questionaire::with("status", "user", "questions")->paginate(5);
        //$questionaires = Questionaire::all();
        $response = array(
            "questionaires" => $questionaires,
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

     /*
     {
        name: ime, 
        description: opis,
        user_id: brojka,
        status_id: brojka(free ili private),
        questions: [...], niz id-jeva pitanja,
     }
     */
    public function store(Request $request)
    {
        
        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255',
                'description' => 'required|max:255',
                'user_id' => 'required|numeric',
                'status_id' => 'required|numeric',
                'questions' => 'required|array',
                'questions.*' => 'required|integer',
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

            $name = $request->name;
            $description = $request->description;
            $user_id = $request->user_id;
            $status_id = $request->status_id;
            $questions = $request->questions;

            if($request->isMethod("post")){

                $questionaire = new Questionaire;
                $questionaire->name = $name;
                $questionaire->description = $description;
                $questionaire->user_id = $user_id;
                $questionaire->status_id = $status_id;
                $questionaire->save();

                for($i=0; $i<count($questions);$i++){

                    $pivotQuestionaire = new PivotQuestionaire;
                    $pivotQuestionaire->questionaire_id = $questionaire->id;
                    $pivotQuestionaire->question_id = $questions[$i];
                    $pivotQuestionaire->save();

                }

            }

            $response = array(
                "message" => "bravo",
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
    public function show($id)
    {
        //
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
                'questionaire_id' => 'required|numeric',
                'name' => 'max:255',
                'description' => 'max:255',
                'status_id' => 'numeric',
                'questions' => 'array',
                'questions.*' => 'required|integer|numeric',
            ]
        );
        $errors = $validation->errors();

        $questionaire_id = $request->questionaire_id;
        $name = $request->name;
        $description = $request->description;
        $status_id = $request->status_id;

        if($validation->fails()){

            $response = array(
                "message" => "Failed",
                "errors" => $errors,

            );
            return response()->json($response);

        }
        else{

            if($request->isMethod("patch")){

                $questionaire = Questionaire::find($request->questionaire_id);
                $questionaire->name = $request->name ? $request->name : $questionaire->name;
                $questionaire->description = $request->description ? $request->description : $questionaire->description;
                $questionaire->status_id = $request->status_id ? $request->status_id : $questionaire->status_id;
                $questionaire->save();

                $pivotQuestionaire = PivotQuestionaire::where("questionaire_id", "=", $request->questionaire_id)->get();

                $len1 = count($request->questions);
                $len2 = count(PivotQuestionaire::where("questionaire_id", "=", $request->questionaire_id)->get());
                $original = PivotQuestionaire::where("questionaire_id", "=", $request->questionaire_id)->get();

                $tmp = $len1 > $len2 ? $len1 : $len2;
                $ttt="";
                for($i=0;$i<$tmp;$i++){

                    if($len2>=$len1 && $i<$len2){

                        $pivotQuestionaire[$i]->questionaire_id = $request->questionaire_id;
                        $pivotQuestionaire[$i]->question_id = $request->questions[$i];
                        $pivotQuestionaire[$i]->save();

                    }

                    if($len2>=$len1 && $i>=$len2){
                        
                        $newPivotQuestionaire = new PivotQuestionaire;
                        $newPivotQuestionaire->questionaire_id = $request->questionaire_id;
                        $newPivotQuestionaire->question_id = $request->questions[$i];
                        $newPivotQuestionaire->save();

                    }

                    if($len1>=$len2){

                        $pivotQuestionaire[$i]->questionaire_id = $request->questionaire_id;
                        $pivotQuestionaire[$i]->question_id = $request->questions[$i];
                        $pivotQuestionaire[$i]->save();

                        if($len1>=$len2 && PivotQuestionaire::where("questionaire_id", "=", $request->questionaire_id)){
                            $pivotQuestionaire[$i]->delete();
                        }

                    }

                }

                $response = array(
                    "len1" => $len1,
                    "len2" => $len2,
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
    public function destroy($id)
    {
        //
    }
}
