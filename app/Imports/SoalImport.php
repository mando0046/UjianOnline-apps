<?php

namespace App\Imports;

use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SoalImport implements ToModel, WithHeadingRow
{
    /**
     * Mapping tiap baris Excel ke Model Question
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    
       public function model(array $row)
    {
        return new Question([
            'question' => $row[0],
            'option_a' => $row[1],
            'option_b' => $row[2],
            'option_c' => $row[3],
            'option_d' => $row[4],
            'option_e' => $row[5],
            'answer'   => $row[6],
        ]);
    }
}