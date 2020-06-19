<?php

namespace App\Http\Controllers;


use App\Model\StudentModel;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = StudentModel::all();
        return response(['data' => $data]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $result = StudentModel::create($data);
        if ($result) {
            return response(['message' => 'Akun Murid Berhasil Dibuat!']);
        }
        return response(['message' => 'Tidak dapat membuat akun staff'], 422);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = StudentModel::find($id);
        return response(['data' => $data]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $registration_number = $request->registration_number;
        $name = $request->name;
        $email = $request->email;
        $username = $request->username;
        $password = $request->password;
        $classroom_id = $request->classroom_id;
        $program_id = $request->program_id;

        $data = StudentModel::find($id);
        $data->registration_number = $registration_number;
        $data->name =$name;
        $data->email = $email;
        $data->username = $username;
        $data->password = $password;
        $data-> classroom_id = $classroom_id;
        $data-> program_id = $program_id;
        $result = $data->save();
        if ($result){
            return response(['message' => 'Akun Murid Berhasil Diubah!']);
        }
        return response(['message'=>'Akun Murid Gagal Diubah!'],22);

    }

    public function delete($id)
    {

        $data = StudentModel::find($id);
        $result = $data->delete();
        if ($result){
            return response(['message'=> 'Akun berhasil Dihapus!']);
        }
        return response(['message'=>'Akun Gagal Dihapus'],22);
    }
}
