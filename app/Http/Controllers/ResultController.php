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
        $sheet = [[
            "Отметка времени",
            "ID",
            "Адрес электронной почты",
            "Баллы",
            "ТАӘ / ФИО",
            "ЖСН / ИИН",
            "ТЖК / ИКТ",
            "Мамандығы / Специальность:",
            "Соңғы бітірген оқу орныңыздың атауын көрсетіңіз / Укажите своё последнее оконченное образовательное учреждение",
        ]];

        //Push questions text to the first row
        $questions = Question::all();

        $question_number = 1;

        foreach ($questions as $question) {
            $text = $question_number . '. ' . $question->text_kk . ' / ' . $question->text_ru;
            array_push($sheet[0], $text);

            $question_number++;
        }

        $results = Result::all();

        $questions_amount = Question::all()
            ->count();

        //Excel other rows
        $current_row = 1;

        foreach ($results as $result) {
            $user = User::find($result->user_id);

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

        $filename = 'Pedexam_' . now();

        return Excel::download($export, $filename . '.xlsx');
    }
}
