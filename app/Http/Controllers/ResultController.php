<?php

namespace App\Http\Controllers;

use App\Exports\ResultsExport;

use Maatwebsite\Excel\Facades\Excel;

use App\Models\Result;
use App\Models\User;
use App\Models\Question;

class ResultController extends Controller
{
    public function excelExport()
    {
        //Excel first row
        $sheet = [];

        $results = Result::all(['id', 'user_id', 'answers', 'score']);

        $questions_amount = Question::all()
            ->count();

        //Excel other rows
        $current_row = 0;

        foreach ($results as $result) {
            $user = User::find($result->user_id, ['last_try', 'email', 'full_name', 'iin', 'ict', 'speciality', 'educational_institution']);

            array_push($sheet, [
                $user->last_try,
                $result->id,
                $user->email,
                $result->score . ' / ' . $questions_amount,
                $user->full_name,
                $user->iin,
                $user->ict,
                $user->speciality,
                $user->educational_institution,
            ]);

            $answers = json_decode($result->answers);

            foreach ($answers as $answer) {
                foreach ($answer as $question_id => $user_answer) {
                    //Push answers to current row
                    switch ($user_answer) {
                        case null:
                            array_push($sheet[$current_row], "Вопрос не отвечен");
                            break;
                        case '0':
                            array_push($sheet[$current_row], "Нет");
                            break;
                        case '1':
                            array_push($sheet[$current_row], "Да");
                            break;
                    }
                }
            }

            $current_row++;
        }

        $export = new ResultsExport([$sheet]);

        $filename = 'Specexam_' . now();

        return Excel::download($export, $filename . '.xlsx');
    }
}
