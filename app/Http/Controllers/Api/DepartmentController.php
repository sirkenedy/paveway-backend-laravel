<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Department\DepartmentStoreRequest;
use App\Http\Requests\Department\DepartmentUpdateRequest;
use App\Http\Resources\Department\Department as DepartmentResource;
use App\Http\Resources\Department\DepartmentCollection;
use App\Repositories\Eloquent\Department\DepartmentRepositoryInterface;

class DepartmentController extends Controller
{
    protected $department;

    public function __construct(DepartmentRepositoryInterface $department)
    {
        // $this->middleware('isAdmin')->only(['store','update','destroy']);
        $this->department = $department;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new DepartmentCollection($this->department->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentStoreRequest $request)
    {
        $data = $this->formatInputKey($request);
        if (!$this->department->store($data))
        {
            return response()->json(['error' => "An error occured. Please try again"]);
        }
        return response()->json(['success' => "department created successfully"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $department = $this->department->get($id);
        } catch (ModelNotFoundException $exception) {
            // return back()->withError($exception->getMessage())->withInput();
            return response()->json(['errors' => withError($exception->getMessage())->withInput()]);
        }
        return new DepartmentResource($department);
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
        $data = $this->formatInputKey($request);
        if (!$this->department->update($id, $data))
        {
            return response()->json(['error' => "An error occured. Please try again"]);
        }
        return response()->json(['success' => "department details updated successfully"], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($data = $this->department->delete($id))
        {
            return response()->json(['success' => "department deleted successfully"], 200);
        }
    }

    public function programs($id)
    {
        $programs = $this->department->getPrograms($id);
        return response()->json(['programs' => $programs], 200);
    }

    protected function formatInputKey($request)
    {
        return [
            'dep_title' => $request->title,
            'dep_key' => $request->key,
            'faculty_id'=> $request->facultyId
        ];
     }
}
