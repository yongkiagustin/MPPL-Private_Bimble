<?php

namespace App\Imports;

use App\Model\Exam;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExamImport implements ToModel, WithHeadingRow
{
    private $courseId;

    public function __construct($courseId)
    {
        $this->courseId = $courseId;
    }

    /**
    * @param array $row
    *
    * @return Exam
    */
    public function model(array $row)
    {
        return new Exam([
            'question' => $row['pertanyaan'],
            'image' => $row['gambar'],
            'answer_a' => $row['a'],
            'answer_b' => $row['b'],
            'answer_c' => $row['c'],
            'answer_d' => $row['d'],
            'answer_e' => $row['e'],
            'course_id' => $this->courseId
        ]);
    }
}
