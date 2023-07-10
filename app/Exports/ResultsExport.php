<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

use App\Models\Question;

class ResultsExport implements WithColumnFormatting, FromArray, ShouldAutoSize, WithHeadings
{
    protected $results;

    public function __construct(array $results)
    {
        $this->results = $results;
    }

    public function array(): array
    {
        return $this->results;
    }

    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_NUMBER,
            'G' => NumberFormat::FORMAT_NUMBER,
        ];
    }

    public function headings(): array
    {
        $headings = [
            "Отметка времени",
            "ID",
            "Адрес электронной почты",
            "Баллы",
            "ТАӘ / ФИО",
            "ЖСН / ИИН",
            "Мамандығы / Специальность:",
            "Соңғы бітірген оқу орныңыздың атауын көрсетіңіз / Укажите своё последнее оконченное образовательное учреждение",
        ];

        $questions = Question::all();

        $question_number = 1;

        foreach ($questions as $question) {
            $text = $question_number . '. ' . $question->text_kk . ' / ' . $question->text_ru;
            array_push($headings, $text);

            $question_number++;
        }

        return [$headings];
    }
}
