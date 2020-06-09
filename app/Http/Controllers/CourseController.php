<?php

namespace App\Http\Controllers;

use App\Imports\ExamImport;
use App\Model\Course;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CourseController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = app(Course::class);
    }

    public function show($id)
    {
        $course = $this->model->with('exams')->find($id);

        return response([
            'data' => $course
        ]);
    }

    public function store($id, Request $request)
    {
        $name = $request->get('name');
        $file = $request->file('file');
        $result = $this->model->create([
            'name' => $name,
            'program_id' => $id
        ]);
        Excel::import(new ExamImport($result->id), $file);

        return response([
            'message' => 'Berhasil Menyimpan ujian'
        ]);
    }

    public function answers($id, Request $request)
    {
        dd($request);
    }
}
