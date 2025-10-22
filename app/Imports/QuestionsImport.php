<?php

namespace App\Imports;

use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; // supaya baris pertama dianggap header

class QuestionsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Question([
            'question' => $row['question'] ?? '',
            'option_a' => $row['option_a'] ?? '',
            'option_b' => $row['option_b'] ?? '',
            'option_c' => $row['option_c'] ?? '',
            'option_d' => $row['option_d'] ?? '',
            'option_e' => $row['option_e'] ?? '',
            'answer'   => strtolower($row['answer'] ?? 'a'),
        ]);
    }
}
