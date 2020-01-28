<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Resources\User\User as UserResource;
use App\Http\Resources\User\UserCollection;
use App\Repositories\Eloquent\User\UserRepositoryInterface;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserRepositoryInterface $user)
    {
        // $this->middleware('isAdmin')->only(['store','update','destroy']);
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // UserCollection::withoutWrapping();
        // return new UserCollection(User::paginate(3));
        return response()->json(new UserCollection(User::paginate(3)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getUserDetails() {
        $id = auth('api')->user()->id;
        $user = $this->user->userDetails($id);
        return response()->json(new UserResource($user));
    }
}
