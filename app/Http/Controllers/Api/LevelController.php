<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Level\Level as LevelResource;
use App\Http\Resources\Level\LevelCollection;
use App\Repositories\Eloquent\Level\LevelRepositoryInterface;

class LevelController extends Controller
{

    protected $level;

    public function __construct(LevelRepositoryInterface $level)
    {
        // $this->middleware('isAdmin')->only(['store','update','destroy']);
        $this->level = $level;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new LevelCollection($this->level->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$this->level->store($request->only(['year'])))
        {
            return response()->json(['error' => "An error occured. Please try again"]);
        }
        return response()->json(['success' => "new level created successfully"], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($data = $this->level->delete($id))
        {
            return response()->json(['success' => "level deleted successfully"], 200);
        }
    }
}
