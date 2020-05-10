<?php

namespace App\Http\Controllers;

use App\StaffModel;
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //TODO : fix login JWT error
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $user = $this->model->auth($credentials)->toArray();
        if (!$user) return response(['message' => 'Email atau Password salah!'], 401);
        try {
            $payload = JWTFactory::make($user);
            dd($payload);
            $token = JWTAuth::encode($payload);

        }
        catch (JWTException $exception) {
            dd($exception);
            return response()->json(['error' => 'could_not_create_token'], 500);

        }
        return response()->json(compact('token'));
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
