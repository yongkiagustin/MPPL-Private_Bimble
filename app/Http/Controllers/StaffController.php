<?php

namespace App\Http\Controllers;

use App\ModelStaff;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use MongoDB\Driver\Session;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;
use function Sodium\add;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        $credentials = $request ->only('username','password');
        try {
            if(! $token = JWTAuth::attempt($credentials)){
                return response()->json(['error'=>'invalid_credentials'],400);
            }
        }catch (JWTException $exception){
            return response()->json(['error'=>'could_not_create_token'],500);
        }
        return response()->json(compact('token'));
    }

    public function index()
    {
        $data = ModelStaff::all();
        return response(['data' => $data]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $result = ModelStaff::create($data);
        if ($result) {
            return response(['message' => 'Staff Berhasil Dibuat!']);
        }
        return response(['message' => 'Tidak dapat membuat staff'], 422);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = ModelStaff::find($id);
        return response(['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
