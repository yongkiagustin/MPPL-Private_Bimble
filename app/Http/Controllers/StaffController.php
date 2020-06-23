<?php

namespace App\Http\Controllers;

use App\Model\StaffModel;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use MongoDB\Driver\Session;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use function Sodium\add;

class StaffController extends Controller
{
    private $model;

    public function __construct(StaffModel $staffModel)
    {
        $this->model = $staffModel;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $token = auth()->attempt($credentials);
        if (!$token)
            return response(['message' => 'Username atau Password salah!'], 401);

        return response([
            'message' => 'Login berhasil',
            'token' => $token
        ], 200, [
            'Authorization' => 'Bearer ' . $token
        ]);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }

    public function index()
    {
        $data = StaffModel::all();
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
        $result = StaffModel::create($data);
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
        $data = StaffModel::find($id);
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
        $name = $request->name;
        $email = $request->email;
        $username = $request->username;
        $password = $request->password;

        $data = StaffModel::find($id);
        $data->name = $name;
        $data->username = $username;
        $data->email = $email;
        $data->password = $password = Hash::make($data['password']);
        $result = $data->save();
        if ($result) {
            return response(['message' => 'Data User Berhasil Diubah!']);
        } else {
            return response(['message' => 'Data User Gagal Diubah']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = StaffModel::find($id);
        $result = $data->delete();
        if ($result) {
            return response(['message' => 'Akun Staff Berhasil Dihapus']);
        } else {
            return response(['message' => 'Akun Gagal Dihapus']);
        }

    }
}
