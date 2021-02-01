<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PivotQuestionaire;
use Illuminate\Support\Facades\Validator;

class PivotQuestionaireController extends Controller
{
    public function update(Request $request){

        $validation = Validator::make(
            $request->all(),
            [
                'questionaire_id' => 'required|numeric|integer',
                'question_id' => 'required|numeric|integer',
            ]
        );
        $errors = $validation->errors();

        $questionaire_id = $request->questionaire_id;
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
                
                $pivotQuestionaire = PivotQuestionaire::where("questionaire_id", "=", $questionaire_id)->first();
                $pivotQuestionaire->question_id = $question_id;
                $this->authorize('update', $pivotQuestionaire);
                $pivotQuestionaire->save();

                $response = array(
                    "pivotQuestionaire" => $pivotQuestionaire,
                    "message" => "bravo",
                    "request" => $request->all(),
                );
                
                return response()->json($response);

            }

        }

    }
}
