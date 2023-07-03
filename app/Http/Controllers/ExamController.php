<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Result;
use App\Models\Question;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ExamController extends Controller
{
    public function start(Request $request)
    {
        $user_id = auth()->user()->id;

        //Check if user already completed test
        $result_exists = Result::where('user_id', $user_id)
            ->exists();

        if ($result_exists) {
            $results = Result::where('user_id', $user_id)
                ->select('score')
                ->get();

            foreach ($results as $result) {
                //If user passed exam successfully (10 (> 9) is score needed)
                if ($result->score > 9) {
                    $resultIDs = Result::where('user_id', $user_id)
                        ->where('score', $result->score)
                        ->select('id', 'user_id')
                        ->first();

                    //Create link to PDF result
                    $PDF_link = URL::to('/PDFResult/' . $resultIDs->id . '/' . $resultIDs->user_id);

                    return redirect('/')->with('error', 'exam completed')->with('PDF_link', $PDF_link);
                }
            }

            //If user completed exam 2 or more times (2 is limit)
            if ($results->count() > 1) {
                return redirect('/')->with('error', 'exam failed');
            }

            $user_last_try = User::where('id', $user_id)
                ->select('last_try')
                ->first();

            $last_try  = strtotime($user_last_try->last_try);
            $now = strtotime(now());
            $one_day = 86400;

            //Time left to wait, after first attempt
            $time_left = $last_try + $one_day - $now;

            //Convert seconds to 17:22:59 format
            $time_left = gmdate('H:i:s', $time_left);

            //If one day is not passed after user completed exam for the first time
            if ($time_left > 0) {
                return redirect('/')->with('error', 'try later')->with('time_left', $time_left);
            }
        }
        //Continue normally

        $questions = Question::all();

        //Shuffle questions
        $questions = $questions->shuffle();

        //Check if user already started exam
        $exam_not_started = User::where('id', $user_id)
            ->where('exam_start', null)
            ->exists();

        if ($exam_not_started) {
            User::where('id', $user_id)
                ->update(['exam_start' => now()]);
        }

        $user_exam_start = User::where('id', $user_id)
            ->select('exam_start')
            ->first();

        //Get current locale
        $locale = app()->getLocale();
        //Depending on current locale, choose diffirent text
        $text = 'text_' . $locale;

        $exam_start  = strtotime($user_exam_start->exam_start);
        $time_diff_seconds = strtotime(now()) - $exam_start;

        //Time left from 2401 seconds (40 minutes for exam completion and 1 second more)
        $time_left = 2401 - $time_diff_seconds;

        //If time less than 1 second, end exam
        if ($time_left < 1) {
            return $this->end($request);
        }

        return view('Exam', [
            'questions' => $questions,
            'time_left' => $time_left,
            'text' => $text,
        ]);
    }

    public function end(Request $request)
    {
        $user_id = auth()->user()->id;

        //Check if user already completed test
        $result_exists = Result::where('user_id', $user_id)
            ->exists();

        if ($result_exists) {
            $results = Result::where('user_id', $user_id)
                ->select('score')
                ->get();

            foreach ($results as $result) {
                //If user passed exam successfully (10 (> 9) is score needed)
                if ($result->score > 9) {
                    return redirect('/')->with('error', 'exam completed');
                }
            }

            //If user completed exam 2 or more times (2 is limit)
            if ($results->count() > 1) {
                return redirect('/')->with('error', 'exam failed');
            }

            $user_last_try = User::where('id', $user_id)
                ->select('last_try')
                ->first();

            $last_try  = strtotime($user_last_try->last_try);
            $now = strtotime(now());
            $one_day = 86400;

            //Time left to wait, after first attempt
            $time_left = $last_try + $one_day - $now;

            //Convert seconds to 17:22:59 format
            $time_left = gmdate('H:i:s', $time_left);

            //If one day is not passed after user completed exam for the first time
            if ($time_left > 0) {
                return redirect('/')->with('error', 'try later')->with('time_left', $time_left);
            }
        }
        //Continue normally

        $score = 0;

        //Current answers key
        $answers_array_key = 0;

        $answers = array();

        $questions = Question::select('id', 'yes_is_valid_answer')
            ->get();

        foreach ($questions as $question) {
            //Null will show later, that user didn't answered this question
            array_push($answers, [$question->id => null]);

            //Check if user answered question
            if (isset($request->question_answer_)) {
                if (array_key_exists($question->id, $request->question_answer_)) {
                    $user_answer = $request->question_answer_[$question->id];

                    //If user answered correctly
                    if ($question->yes_is_valid_answer == $user_answer) {
                        $score++;
                    }

                    //Add to array user answer to this question
                    $answers[$answers_array_key] = [$question->id => $user_answer];
                }
            }

            $answers_array_key++;
        }

        //Encode answers to json
        $answers = json_encode($answers);

        Result::create([
            'user_id' => $user_id,
            'answers' => $answers,
            'score' => $score,
        ]);

        $result_id = DB::getPdo()->lastInsertId();;

        User::where('id', $user_id)
            ->update([
                'exam_start' => null,
                'last_try' => now(),
            ]);

        return redirect('PDFResult/' . $result_id . '/' . $user_id);
    }

    public function PDFResult($result_id, $user_id)
    {
        $result = Result::where('id', $result_id)
            ->where('user_id', $user_id)
            ->select('score', 'created_at')
            ->first();

        if ($result) {
            $date = $result->created_at->format('d.m.Y');

            $full_name = User::find($user_id, 'full_name')
                ->full_name;

            if ($result->score > 9) {
                $pass = __('<b>«допуск»</b> для поступления на платной основе.');
            } else {
                $pass = __('<b>«недопуск»</b> для поступления на платной основе.');
            }
            //QrCode generation
            $string = __('https://www.kaznpu.kz/ru/2404/page/');

            $qr = QrCode::size(120)
                ->encoding('UTF-8')
                ->generate($string);

            //To image (for PDF file)
            $qr_image = base64_encode($qr);

            $pdf_result = Pdf::loadView('Result', [
                'result_id' => $result_id,
                'date' => $date,
                'full_name' => $full_name,
                'pass' => $pass,
                'qr_image' => $qr_image,
            ]);

            return $pdf_result->stream();
        }

        abort(404);
    }
}
