<?php

namespace App\Http\Controllers;

use App\Model\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = app(Program::class);
    }

    public function index()
    {
        $program = $this->model->withCount('students', 'courses')->get();
        return response([
            'data' => $program
        ]);
    }

    public function show($id)
    {
        $program = $this->model->find($id);
        return response([
            'data' => $program
        ]);
    }

    public function courses($programId)
    {
        $program = $this->model->find($programId);
        $courses = $program->courses()->get();

        return response([
            'data' => $courses
        ]);
    }

    public function students($programId)
    {
        $program = $this->model->find($programId);
        $students = $program->students()->with('classroom')->get();

        return response([
            'data' => $students
        ]);
    }
}
