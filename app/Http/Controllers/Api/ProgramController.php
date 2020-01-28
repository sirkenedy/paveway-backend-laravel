<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Program\ProgramStoreRequest;
use App\Http\Requests\Program\ProgramUpdateRequest;
use App\Http\Resources\Program\Program as ProgramResource;
use App\Http\Resources\Program\ProgramCollection;
use App\Repositories\Eloquent\Program\ProgramRepositoryInterface;

class ProgramController extends Controller
{
    protected $program;

    public function __construct(ProgramRepositoryInterface $program)
    {
        // $this->middleware('isAdmin')->only(['store','update','destroy']);
        $this->program = $program;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ProgramCollection($this->program->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProgramStoreRequest $request)
    {
        if (!$this->program->store($request->only(['title','key','department_id'])))
        {
            return response()->json(['error' => "An error occured. Please try again"]);
        }
        return response()->json(['success' => "program created successfully"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $program = $this->program->get($id);
        return new ProgramResource($program);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProgramUpdateRequest $request, $id)
    {
        if (!$this->program->update($id, $request->only(['title','key','department_id'])))
        {
            return response()->json(['error' => "An error occured. Please try again"]);
        }
        return response()->json(['success' => "program details updated successfully"], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($data = $this->program->delete($id))
        {
            return response()->json(['success' => "program deleted successfully"], 200);
        }
    }
}
